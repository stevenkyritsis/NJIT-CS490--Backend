<?php

$host = "sql2.njit.edu";
$user =  "sak76";
$table  = "answers";
$pwd = "############";

$db = mysqli_connect($host,$user, $pwd, $user);

if (mysqli_connect_errno())
  {	  
    echo "FAILED CONNECTION: " . mysqli_connect_error();
  }

mysqli_select_db($db,$table); 

$sql = "SELECT * FROM $table";

$result = mysqli_query($db,$sql);

if((!$result)){
  echo mysqli_error($db);
}

//$row = mysqli_fetch_array($result);
$result_arr = [];

while($row = $result->fetch_assoc()) {
  $result_arr[] = array('index' => $row['INDEX'],
     'student_id' => $row['student_id'],
     'exam_id' => $row['exam_id'],
     'question_id' => $row['question_id'],
     'answer' => $row['answer'], 
     'grade' => $row['grade'],
     'comments' => $row['comments']);  
}

echo json_encode($result_arr);

?>
