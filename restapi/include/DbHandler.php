<?php

class DbHandler {
 
    private $conn;
 
    function __construct() {
        require_once dirname(__FILE__) . '/DbConnect.php';
        // opening db connection
        $db = new DbConnect();
        $this->conn = $db->connect();
    }
 
    public function createUser($array){
        try {
            $response = array();
            $comando = "INSERT INTO `user`(`name`, `last_name`, `phone`)" .
                " VALUES(?,?,?)";

            $sentencia = $this->conn->prepare($comando);

            $sentencia->bindParam(1, $array['name']);
            $sentencia->bindParam(2,$array['last_name']);
            $sentencia->bindParam(3, $array['phone']);

            $resultado = $sentencia->execute();

            if ($resultado) {
                $response["error"] = FALSE;
                $response["message"] = "The user was created";
            } else {
                $response["error"] = TRUE;
                $response["message"] = "Internal Server Error";
            }
            return $response;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function setWinner($winner){
        try {
            $response = array();
            $sentencia = $this->conn->prepare("CALL winner($winner)");
            $sentencia->execute();
            $result = $sentencia->fetch();

            if ($result) {
                $response["error"] = FALSE;
                $response["message"] = "WINNER";
                $response['name']  =  $result['name'];
                $response['last_name'] = $result['last_name'];
                $response['phone']  = $result['phone'];
            } else {
                $response["error"] = TRUE;
                $response["message"] = "Internal Server Error";
            }
            return $response;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function searchWinner($phone){
        try {
            $response = array();
            $sentencia = $this->conn->prepare("CALL searchWinner($phone)");
            $sentencia->execute();
            $result = $sentencia->fetch();

            if ($result & isset($result['name'])) {
                $response["error"] = FALSE;
                $response["message"] = "WINNER";
                $response['name']  =  $result['name'];
                $response['last_name'] = $result['last_name'];
                $response['winner ']  =  $result['winner'];
            } elseif ($result[0] == -1){
                $response["error"] = FALSE;
                $response["message"] = "NO WINNER";
                $response['winner ']  = -1;
            }else{
                $response["error"] = TRUE;
                $response["message"] = "NO WINNER";
                $response['winner ']  = 0;
            }
            return $response;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function deleteWinner($winner){
        try {
            $response = array();
            $sentencia = $this->conn->prepare("CALL  deleteWinner($winner)");
            $sentencia->execute();
            $result = $sentencia->fetch();

            if ($result) {
                $response["error"] = FALSE;
                $response["message"] = "PICK A WINNER";
            } else {
                $response["error"] = TRUE;
                $response["message"] = "Internal Server Error";
            }
            return $response;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
 
}
 
?>