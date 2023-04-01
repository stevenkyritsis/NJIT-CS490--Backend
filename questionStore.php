<?php

$host = "sql2.njit.edu";
$user =  "sak76";
$table  = "question";
$pwd = "#############";

$indata = file_get_contents('php://input');
$data = json_decode($indata);

$db = mysqli_connect($host,$user, $pwd, $user);

$question = $data->question;
$test1 = $data->test1;
$test2 = $data->test2;
$test3 = $data->test3;
$test4 = $data->test4;
$test5 = $data->test5;
$topic = $data->topic;
$difficulty = $data->difficulty;
$constraint = $data->constraint;
$deduction = $data->deduction;

if (mysqli_connect_errno())
  {	  
    echo "FAILED CONNECTION: " . mysqli_connect_error();
  }

mysqli_select_db($db,$table); 

$sql = "INSERT INTO $table (question, test1, test2, test3, test4, test5, topic, difficulty, con, cPoints) VALUES ('$question', '$test1', '$test2', '$test3', '$test4', '$test5', '$topic', '$difficulty','$constraint','$deduction')";

$result = mysqli_query($db,$sql);
if(!($result)){
  echo mysqli_error($db);
}
//echo $result;

mysqli_close($db);

$result_arr = array('STATUS' => $result);

echo(json_encode($result_arr));

?>