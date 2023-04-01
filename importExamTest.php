<?php

$host = "sql2.njit.edu";
$user =  "sak76";
$table  = "new_exam";
$pwd = "############";
$db = mysqli_connect($host,$user, $pwd, $user);

if (mysqli_connect_errno())
{	  
  echo "FAILED CONNECTION: " . mysqli_connect_error();
}

$indata = file_get_contents('php://input');

$arr = json_decode($indata);

$i = 0; 
foreach($arr as $row){ 
  $exam_id = $arr[$i]->eID;
  $question_id = $arr[$i]->index;
  $grade = $arr[$i]->points;


  $sql = "INSERT INTO $table (`exam_id`,`questionid`,`grade`) VALUES ('$exam_id',$question_id,'$grade')";

  mysqli_select_db($db,$table); 
  $result = mysqli_query($db,$sql);
  if(!($result)){
    echo mysqli_error($db);
  } else{
    if ($i == 0){
      $url = "https://afsaccess4.njit.edu/~sak76/setStatus.php";
      $ch = curl_init($url);
      $json = array('eID' => $exam_id, 'status' => 'HIDDEN', 'student' => 'all');
      // Will return the response, if false it print the response
      curl_setopt($ch, CURLOPT_POST, true);
      //Payload
      $payload = json_encode($json);
      //Setting the headers
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
      //Return
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   
      // Execute
      $curlResult=curl_exec($ch);
    }
    $i++;
  } 
}

echo $result;

/*
$sql = "INSERT INTO $table (`exam_id`, `questionid`, `grade`) VALUES ('$exam_id', '$question_id', '$grade')";

$result = mysqli_query($db,$sql);
if(!($result)){
  echo mysqli_error($db);
}
*/
mysqli_close($db);

?>