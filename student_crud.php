<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include "include/conn_db.php";

$request_method=$_SERVER["REQUEST_METHOD"];


switch($request_method){
  case 'GET':
    get_students();
    break;
  case 'POST':
    $data = json_decode(file_get_contents('php://input'), true);
    $studentid = $data['studentid'];
    $name = $data['name'];
    $password = $data['password'];

    insert_student($studentid, $name, $password);
    break;
  default:
    header("HTTP/1.0 405 Method not allowed");
    break;
}

function get_students(){
  global $conn;
  $sql = "SELECT no, studentid, name FROM student";
    
  $result = $conn->query($sql);

  $outp = "";
  while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"No":"'  . $rs["no"] . '",';
    $outp .= '"Studentid":"'   . $rs["studentid"]        . '",';
    $outp .= '"Name":"'. $rs["name"]     . '"}';
  }
  $outp ='{"records":['.$outp.']}';

  echo($outp);
}

function insert_student($studentid, $name, $password){
  global $conn;
  $stmt = $conn->prepare("INSERT INTO student (studentid,name, password) VALUE (?,?,?)");
  $stmt->bind_param("sss", $studentid, $name, $password);
  $stmt->execute();
}


?>