<?php

$host = "sql2.njit.edu";
$user =  "sak76";
$table  = "question";
$pwd = "##############";

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
  $result_arr[] = array('index' => $row['questionid'],
     'question' => $row['question'],
     'test1' => $row['test1'],
     'test2' => $row['test2'],
     'test3' => $row['test3'],
     'test4' => $row['test4'],
     'test5' => $row['test5'],
     'topic' => $row['topic'], 
     'difficulty' => $row['difficulty'],
     'con' => $row['con'],
     'deduction' => $row['cPoints']);  
}

$json = json_encode($result_arr);

echo $json;

mysqli_close($db);
?>