<?php require_once(__DIR__ . "/../config/db.php"); ?>
<?php
  
    if (isset($_POST['description'])  && isset($_POST['difficulty']) 
        && isset($_POST['category'])  && isset($_POST['teacher_id'])
        && isset($_POST['teacher_id']) && isset($_POST['fname']) ){


        $db = getDB();
        

        $stmt = $db->prepare('INSERT INTO cs490_questions (description, difficulty, fname, category, teacher_id) VALUES(:desc, :diff, :fn, :cat, :t_id)');
        $r = $stmt->execute([
            ":desc" => $_POST['description'],
            ":diff" => $_POST['difficulty'],
            ":fn" => $_POST['fname'],
            ":cat" => $_POST['category'],
            ":t_id" => $_POST['teacher_id']
        ]);
    

        if($r){
            echo $db->lastInsertId();
        } else{
            echo "Failed to Create Question";
        }
        
    } 
