<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dbhost = NULL;
$dbname = NULL;
$dbpass = NULL;
$dbuser = NULL;

function getDB(){
    global $db, $dbhost, $dbname, $dbpass, $dbuser;
    //this function returns an existing connection or creates a new one if needed
    if(!isset($db)) {
        try{
            // pull in db credentials from configuration file 
            // config file Includes UCID and db password so I don't upload it neither to github nor to canvas for security reasons
            require_once(__DIR__. "/conf.php");
            $connection_string = "mysql:host=$dbhost;dbname=$dbname;charset=utf8mb4";
            //using the PDO connector create a new connect to the DB
            //if no error occurs we're connected
            $db = new PDO($connection_string, $dbuser, $dbpass);
        }
    catch(Exception $e){
            var_export($e);
            $db = null;
        }
    }
    return $db;
}

?>