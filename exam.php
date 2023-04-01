<?php
//Don't know if i need this file just yet. may just use the status table
$host = "sql2.njit.edu";
$user =  "sak76";
$table  = "exam_status";
$pwd = "################";

$db = mysqli_connect($host,$user, $pwd, $user);

if (mysqli_connect_errno())
  {	  
    echo "FAILED CONNECTION: " . mysqli_connect_error();
  }

mysqli_select_db($db,$table); 

$sql = "SELECT `exam_id` FROM $table";

$result = mysqli_query($db,$sql);

if((!$result)){
  echo mysqli_error($db);
}

//$row = mysqli_fetch_array($result);
$result_arr = [];

while($row = $result->fetch_assoc()) {
  $result_arr[] = array('examid' => $row['exam_id']);  
}

$json = json_encode($result_arr);

echo $json;

mysqli_close($db);

?>
