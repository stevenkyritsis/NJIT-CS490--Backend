<?php

$host = "sql2.njit.edu";
$user =  "sak76";
$table1  = "new_exam";
$table2 = "question";
$pwd = "############";
$db = mysqli_connect($host,$user, $pwd, $user);

//$indata = file_get_contents('php://input');

//$data = json_decode($indata);

//$exam_id = $data->exam_id;

if (mysqli_connect_errno())
  {	  
    echo "FAILED CONNECTION: " . mysqli_connect_error();
  }

mysqli_select_db($db,$table); 

//$sql = "SELECT question.questionid, exam_id, question.question, grade FROM $table1, $table2 WHERE exam_id = '$exam_id' AND $table1.questionid = $table2.questionid";
$sql = "SELECT question.questionid, exam_id, question.question, grade FROM $table1, $table2 WHERE $table1.questionid = $table2.questionid";
//$result = mysqli_query($db,$sql);
$result = $db->query($sql) or die($db->error);

while($row = $result->fetch_assoc()) {
    $result_arr[] = array('exam_id' => $row['exam_id'],
       'question_id' => $row['questionid'],
       'question' => $row['question'],
       'grade' => $row['grade']);  
  }

mysqli_close($db);

$json = json_encode($result_arr);

echo $json;
?>