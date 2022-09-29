<?php require_once(__DIR__ . "/../config/db.php"); ?>
<?php

    $userId = NULL;

    if (isset($_POST['ucid'])){


        $db = getDB();

        $stmt = $db->prepare('SELECT * FROM cs490_users WHERE ucid=:ucid');
        $stmt->execute([
            ":ucid" => $_POST['ucid']
        ]);
    
        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        

        if($results){
            echo json_encode($results);
        } else{
            http_response_code(404);
            echo "User not found";
            die();
        }
        
    }
