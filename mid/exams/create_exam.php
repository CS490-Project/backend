<?php

$data = [
    "total" => 10,
    "title" => "Midterm 1",
    "teacher_id" => "tt001",
    "questions" => [
        ["q_id" => 1, "val" => 10],
    ]

];
$options = array(
    CURLOPT_URL => 'https://afsaccess4.njit.edu/~gc348/CS490/backend/exams/create_exam.php',
    CURLOPT_POST => true, 
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER, array('Content-Type:application/json'),
    CURLOPT_RETURNTRANSFER => true
);

$ch = curl_init();  //initialize curl session
curl_setopt_array($ch, $options); 


//decode json from db.php
$response = curl_exec($ch);
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);



//unhash password and compare to password gotten from post request, make sure username exists
//json to index.php
echo $response;
?>