<?php require_once(__DIR__ . "/../config/db.php"); ?>
<?php

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    
    if ($data["question_id"]){

        $db = getDB();
    
        $stmt_test_case = $db->prepare('SELECT * FROM cs490_test_cases WHERE question_id=:q_id');
                                
        $stmt_test_case->execute([
            ":q_id" => $data['question_id']
        ]);
        
        $test_cases = $stmt_test_case->fetchAll(PDO::FETCH_ASSOC);

        if($test_cases){
            echo json_encode($test_cases);
        } else{
            http_response_code(404);
            echo "Test cases not found\n";
            die();
        } 
        
        
    }

        
