<?php 
  
  $exam = NULL;
  if( isset($_GET["id"]) ){
    
    
    $data = ["exam_id" => $_GET['id']];
    
    $options = array(
        CURLOPT_URL => 'https://afsaccess4.njit.edu/~jc262/CS490/mid_request_exam.php',
        CURLOPT_POST => true, 
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array('Content-Type:application/json'),
        CURLOPT_RETURNTRANSFER => true
    );
    
    $ch = curl_init();  //initialize curl session
    curl_setopt_array($ch, $options); 
    
    
    //decode json from db.php
    $response = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    
    if($status == 200){
      $exam = json_decode($response, true);
    }
  
  }
  
  
?>

<html>
  <head></head>
  <body>
    <?= print_r($exam); ?>
  </body>
</html>