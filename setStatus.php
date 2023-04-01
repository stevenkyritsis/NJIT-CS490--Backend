<?php 
$host = "sql2.njit.edu";
$user =  "sak76";
$table  = "exam_status";
$pwd = "#############";
$db = mysqli_connect($host,$user, $pwd, $user);

$indata = file_get_contents('php://input');

$data = json_decode($indata);

$exam = $data->eID;
$newStatus = $data->status;
$student = $data->student;

$nice = false;

if (mysqli_connect_errno())
  {	  
    echo "FAILED CONNECTION: " . mysqli_connect_error();
  }

//mysqli_select_db($db,$table);
mysqli_select_db($db,"users");
$getStudents_sql = "SELECT * FROM `users` WHERE `ROLE`= 'STUDENT'";
$resultStudent = mysqli_query($db,$getStudents_sql);

if(!($resultStudent)){
  echo mysqli_error($db);
}

while($row = $resultStudent->fetch_assoc()) {
  $result_arr[] = array('student_id' => $row['UNAME']);
}

$i = 0;
if ($student == "ALL"){  
  while($i < count($result_arr)){
    $sID = $result_arr[$i]['student_id'];
    $newStatus_sql = "INSERT INTO $table (STATUS,exam_id,student_id,grade) VALUES('$newStatus','$exam', '$sID', 0)";
    $result_new = mysqli_query($db,$newStatus_sql);
    $nice = true;
    if(!($result_new)){
      echo mysqli_error($db);
    }
    $i++;
  }
}
else{
  while($i < count($result_arr)){
    if($student == $result_arr[$i]['student_id']){
      //SQL to update the database
      $sqlUpdate = "UPDATE $table SET `STATUS`= '$newStatus' WHERE `exam_id`= '$exam' AND `student_id`= '$student'";
      //Query 
      $result = mysqli_query($db,$sqlUpdate);
      if(!($result)){
        echo mysqli_error($db);
      }
      //LOL this is to just return a true or false value to show that it was run okay
      $nice = true;
      //breaking out of the loop because there was a match
      break;
    }
    $i++; 
  }
}

mysqli_close($db);

$result_arr = array('STATUS' => $nice);

echo(json_encode($result_arr));
?>