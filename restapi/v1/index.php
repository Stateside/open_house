<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: text/html; charset=utf-8');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"'); 

include_once '../include/Config.php';
require_once '../include/DbHandler.php'; 

require '../libs/Slim/Slim.php'; 
\Slim\Slim::registerAutoloader(); 
$app = new \Slim\Slim();


$app->get('/users', function() use ($app) {
    $db = new DbHandler();
    $users = $db->listUsers();
    echoResponse(201, $users);
});


$app->get('/winner', function() use ($app) {
    $db = new DbHandler();
    $winner = $db->setWinner($app->request->get('win'));
    echoResponse(201, $winner);
});


$app->get('/delete_winner', function() use ($app) {
    $db = new DbHandler();
    $winner = $db->deleteWinner($app->request->get('win'));
    echoResponse(201, $winner);
});


/* POST: Create a new User*/
$app->post('/user', 'authenticate', function() use ($app) {
    // check for required params
    verifyRequiredParams(array('name', 'last_name', 'phone'));
    
    $response = array();
    $param['name']  = $app->request->post('name');
    $param['last_name'] = $app->request->post('last_name');
    $param['phone']  = $app->request->post('phone');
    
    $db = new DbHandler();
    $user = $db->createUser($param);

    echoResponse(201, $user);
});


$app->post('/searchwinner', 'authenticate', function() use ($app) {
    // check for required params
    verifyRequiredParams(array('phone'));

    $db = new DbHandler();
    $winner = $db->searchWinner($app->request->post('phone'));

    echoResponse(201, $winner);
});

/* Run aplication */
$app->run();

/*********************** USEFULL FUNCTIONS **************************************/

/**
 * Validation of parameters to endpoint
 */
function verifyRequiredParams($required_fields) {
    $error = false;
    $error_fields = "";
    $request_params = array();
    $request_params = $_REQUEST;
    // Handling PUT request params
    if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
        $app = \Slim\Slim::getInstance();
        parse_str($app->request()->getBody(), $request_params);
    }
    foreach ($required_fields as $field) {
        if (!isset($request_params[$field]) || strlen(trim($request_params[$field])) <= 0) {
            $error = true;
            $error_fields .= $field . ', ';
        }
    }
 
    if ($error) {
        // Required field(s) are missing or empty
        // echo error json and stop the app
        $response = array();
        $app = \Slim\Slim::getInstance();
        $response["error"] = true;
        $response["message"] = 'Required field(s) ' . substr($error_fields, 0, -2) . ' is missing or empty';
        echoResponse(400, $response);
        
        $app->stop();
    }
}

function validateEmail($email) {
    $app = \Slim\Slim::getInstance();
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response["error"] = true;
        $response["message"] = 'Email address is not valid';
        echoResponse(400, $response);
        
        $app->stop();
    }
}
 
/**
 * @param String $status_code Http response code
 * @param Int $response Json response
 */
function echoResponse($status_code, $response) {
    $app = \Slim\Slim::getInstance();
    // Http response code
    $app->status($status_code);
    // setting response content type to json
    $app->contentType('application/json');
    echo json_encode($response);
}

/**
 * 
 * 
 */
function authenticate(\Slim\Route $route) {
    // Getting request headers
    $headers = apache_request_headers();
    $response = array();
    $app = \Slim\Slim::getInstance();
 
    // Verifying Authorization Header
    if (isset($headers['Authorization'])) {
        //$db = new DbHandler(); //utilizar para manejar autenticacion contra base de datos
 
        // get the api key
        $token = $headers['Authorization'];
        
        // validating api key
        if (!($token == API_KEY)) { //API_KEY declarada en Config.php
            
            // api key is not present in users table
            $response["error"] = true;
            $response["message"] = "Acceso denegado. Token inválido";
            echoResponse(401, $response);
            
            $app->stop(); //Detenemos la ejecución del programa al no validar
            
        }
    } else {
        // api key is missing in header
        $response["error"] = true;
        $response["message"] = "Falta token de autorización";
        echoResponse(400, $response);
        
        $app->stop();
    }
}
?>