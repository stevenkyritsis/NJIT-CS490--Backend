<?php

$host = "sql2.njit.edu";
$user =  "sak76";
$table  = "new_exam";
$pwd = "############";
$db = mysqli_connect($host,$user, $pwd, $user);

$indata = file_get_contents('php://input');

$data = json_decode($indata);

$exam_id = $data->eID;
$question_id = $data->index;
$grade = $data->points;

if (mysqli_connect_errno())
  {	  
    echo "FAILED CONNECTION: " . mysqli_connect_error();
  }

mysqli_select_db($db,$table); 

$sql = "INSERT INTO $table (`exam_id`, `questionid`, `grade`) VALUES ('$exam_id', '$question_id', '$grade')";

$result = mysqli_query($db,$sql);
if(!($result)){
  echo mysqli_error($db);
}

mysqli_close($db);

?>
