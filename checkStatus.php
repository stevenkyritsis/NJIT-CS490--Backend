<?php

$host = "sql2.njit.edu";
$user =  "sak76";
$table  = "exam_status";
$pwd = "#############";
$db = mysqli_connect($host,$user, $pwd, $user);

$indata = file_get_contents('php://input');

$data = json_decode($indata);

$student = $data->student_id;

if (mysqli_connect_errno())
  {	  
    echo "FAILED CONNECTION: " . mysqli_connect_error();
  }

mysqli_select_db($db,$table); 

$sql = "SELECT * FROM $table WHERE student_id = '$student'";

$result = mysqli_query($db,$sql);
$result_arr = [];

while($row = $result->fetch_assoc()) {
    $result_arr[] = array('exam_id' => $row['exam_id'],
       'status' => $row['STATUS']);  
  }

$json = json_encode($result_arr);

echo $json;

mysqli_close($db);

?>
