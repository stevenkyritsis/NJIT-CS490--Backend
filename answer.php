<?php

$host = "sql2.njit.edu";
$user =  "sak76";
$table  = "answers";
$pwd = "#########";
$db = mysqli_connect($host,$user, $pwd, $user);

$indata = file_get_contents('php://input');

$data = json_decode($indata);

$exam_id = $data->eID;
$student_id = $data->student_id;
$question_id = $data->qID;
$answer = $data->answer;

if (mysqli_connect_errno())
  {	  
    echo "FAILED CONNECTION: " . mysqli_connect_error();
  }

mysqli_select_db($db,$table); 

$sql = "INSERT INTO $table (`exam_id`, `question_id`, `student_id`, `answer`, `grade`, `comments`) VALUES ('$exam_id', '$question_id', '$student_id', '$answer', 0, '')";

$result = mysqli_query($db,$sql);
if(!($result)){
  echo mysqli_error($db);
}

mysqli_close($db);

echo json_encode($result);

?>
