<?php require_once(__DIR__ . "/../config/db.php"); ?>

<?php

    $userId = NULL;

    if (isset($_POST['userId'])){


        $db = getDB();

        $stmt = $db->prepare('SELECT * FROM cs490_users WHERE userId=:userId');
        $stmt->execute([
            ":userId" => $_POST['userId']
        ]);
    
        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        echo $results;
    }
