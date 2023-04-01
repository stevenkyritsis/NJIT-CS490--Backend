<?php
session_start();
$url = "https://afsaccess4.njit.edu/~sak76/answerView.php";
$ch = curl_init($url);                                                                                                                       
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                             
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$examView = curl_exec($ch);
//echo $examView;
$arr=json_decode($examView, true);

$examlist=[];
for($i=0; $i<sizeof($arr);$i++){
  $examlist[]=$arr[$i]['exam_id'];
}
echo json_encode($examlist);
$idList=[];
$idList=array_filter(array_unique($examlist));
?>

<!DOCTYPE html>

<table>
    <th>Question</th>
    <th>Answer</th>
    <th>Points</th>

    <tb></tb>

</table>

</html>