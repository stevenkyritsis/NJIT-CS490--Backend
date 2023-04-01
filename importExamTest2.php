<?php

$host = "sql2.njit.edu";
$user =  "sak76";
$table  = "new_exam";
$pwd = "#########";
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
  }
  $i++;
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