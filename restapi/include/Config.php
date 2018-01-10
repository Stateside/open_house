<?php
/**
 * Database configuration
 */
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_HOST', 'localhost');
define('DB_NAME', 'open_house');

//referencia generado con MD5(uniqueid(<some_string>, true))
define('API_KEY','d7e2b639fdfc4cfdfad5f6ba3d7dcdca');

/**
 * API Response HTTP CODE
 * Used as reference for API REST Response Header
 *
 */
/*
200 	OK
201 	Created
304 	Not Modified
400 	Bad Request
401 	Unauthorized
403 	Forbidden
404 	Not Found
422 	Unprocessable Entity
500 	Internal Server Error
*/

?>