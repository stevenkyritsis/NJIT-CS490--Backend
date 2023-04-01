<?php

$host = "sql2.njit.edu";
$user =  "sak76";
$table1  = "new_exam";
$table2 = "question";
$pwd = "############";
$db = mysqli_connect($host,$user, $pwd, $user);

$indata = file_get_contents('php://input');

$data = json_decode($indata);

$exam_id = $data->exam_id;

if (mysqli_connect_errno())
  {	  
    echo "FAILED CONNECTION: " . mysqli_connect_error();
  }

mysqli_select_db($db,$table); 
/*question.questionid, 
               exam_id, 
               question.question, 
               new_exam.grade, 
               question.test1,
               question.test2,
               question.test3,
               question.test4,
               question.test5,
               question.con,
               question.cPoints*/
$sql = "SELECT *
               FROM $table1, $table2 
               WHERE $table1.exam_id = '$exam_id' 
               AND $table1.questionid = $table2.questionid";
//$result = mysqli_query($db,$sql);
$result = $db->query($sql) or die($db->error);

while($row = $result->fetch_assoc()) {
  $result_arr[] = array('exam_id' => $row['exam_id'],
      'question_id' => $row['questionid'],
      'test1' => $row['test1'],
      'test2' => $row['test2'],
      'test3' => $row['test3'],
      'test4' => $row['test4'],
      'test5' => $row['test5'],
      'con' => $row['con'],
      'cPoints' => $row['cPoints']);  
}

mysqli_close($db);

$json = json_encode($result_arr);

echo $json;
?>