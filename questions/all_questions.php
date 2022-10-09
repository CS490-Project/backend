<?php require_once(__DIR__ . "/../config/db.php"); ?>
<?php
  
    if (isset($_POST['teacher_id'])){

        $db = getDB();

        $stmt = $db->prepare('SELECT * FROM cs490_questions WHERE teacher_id=:t_id');
        $stmt->execute([
            ":t_id" => $_POST['teacher_id']
        ]);
    
        $r = $stmt->fetch(PDO::FETCH_ASSOC);


        if($r){
            echo json_encode($r);
        } else{
            http_response_code(404);
            echo "Questions for not found for this teacher";
            die();
        }
       
        
        
    }
