<?php require_once(__DIR__ . "/../config/db.php"); ?>
<?php

    if (isset($_POST['user_id'])){


        $db = getDB();

        $stmt = $db->prepare('SELECT * FROM cs490_users WHERE id=:user_id');
        $stmt->execute([
            ":user_id" => $_POST['user_id']
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
