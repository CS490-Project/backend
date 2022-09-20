<?php
#turn error reporting on
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//pull in db.php so we can access the variables from it
require_once (__DIR__ . "/../config/db.php");
$count = 0;

try{
    foreach(glob(__DIR__ . "/*.sql") as $filename){
        $sql[$filename] = file_get_contents($filename);
    }

    if(isset($sql) && $sql && count($sql) > 0){
   
    
        echo "<br><pre>" . var_export($sql, true) . "</pre><br>";

        //connect to DB
        $db = getDB();
        $stmt = $db->prepare("show tables");
        $stmt->execute();
        $count++;
        
        foreach($sql as $key => $value){
            echo "<br>Running: " . $key;
    
            $stmt = $db->prepare($value);
            $result = $stmt->execute();
            $count++;
            $error = $stmt->errorInfo();
            if($error && $error[0] !== '00000'){
                echo "<br>Error:<pre>" . var_export($error,true) . "</pre><br>";
            }
            echo "<br>$key result: " . ($result>0?"Success":"Fail") . "<br>";
        }
        echo "<br> Init complete, used approximately $count db calls.<br>";
    }
    else{
        echo "Didn't find any files, please check the directory/directory contents/permissions";
    }
    $db = null;
}
catch(Exception $e){
    echo $e->getMessage();
    exit("Something went wrong");
}
?>