<?php require_once(__DIR__ . "/../config/db.php"); ?>
<?php

    $json = file_get_contents('php://input');
  
    if ($json){

        $data = json_decode($json, true);

        $db = getDB();

        $stmt = $db->prepare('SELECT * FROM cs490_questions WHERE teacher_id=:t_id');
        
        $stmt->execute([
            ":t_id" => $data['teacher_id']
        ]);

    
        $r = $stmt->fetchAll(PDO::FETCH_ASSOC);


        if($r){
            echo json_encode($r);
        } else{
            http_response_code(404);
            echo "Questions for not found for this teacher";
            die();
        }
       
        
        
    }
