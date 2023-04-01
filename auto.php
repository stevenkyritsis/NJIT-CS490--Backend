<?php

$host = "sql2.njit.edu";
$user =  "sak76";
$table1  = "answers";
$table2 = "question";
$pwd = "###########";

$db = mysqli_connect($host,$user, $pwd, $user);

$indata = file_get_contents('php://input');

$data = json_decode($indata);

$student = $data->student_id;
$exam = $data->exam_id;

/*{"exam_id":"MidtermWithStatus1",
  "question_id":"1",
  "test1":"hwkjberw","test2":"hjbwerheee","test3":"","test4":"","test5":"",
  "con":"","cPoints":"0"} */

//going to use curl to get the exam answers and questions
$json = array('exam_id' => $exam);
$payload = json_encode($json);
$url = "https://afsaccess4.njit.edu/~sak76/viewExamAuto.php";
$ch = curl_init($url);                                                                      
curl_setopt($ch, CURLOPT_POST, true);                                                   
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                             
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$examView = curl_exec($ch);
echo $examView;

if (mysqli_connect_errno())
{	  
  echo "FAILED CONNECTION: " . mysqli_connect_error();
}

mysqli_select_db($db,$table); 

$answers_sql = "SELECT * FROM $table1 WHERE `student_id`= '$student' AND `exam_id`= '$exam'";

$answerResult = mysqli_query($db,$answers_sql);

if((!$answerResult)){
  echo mysqli_error($db);
}



?>
