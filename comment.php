<?php

$host = "sql2.njit.edu";
$user =  "sak76";
$table  = "answers";
$pwd = "##############";
$db = mysqli_connect($host,$user, $pwd, $user);

$indata = file_get_contents('php://input');

$data = json_decode($indata);

$comment = $data->comment;
$student_id = $data->student_id;
$index = $data->index;

$sql = "UPDATE $table SET `comments`= '$comment' WHERE `INDEX`= '$index' AND `student_id`= '$student'";


//Query 
$result = mysqli_query($db,$sql);
if(!($result)){
    echo mysqli_error($db);
}

mysqli_close($db);

echo json_encode($result);

?>
