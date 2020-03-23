<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include "include/conn_db.php";

$request_method=$_SERVER["REQUEST_METHOD"];


// checking the request method -> GET, POST, PUT, DELETE
switch($request_method){
  case 'GET':
    get_students();
    break;
  case 'POST':
    $data = json_decode(file_get_contents('php://input'), true);
    $studentid = $data['studentid'];
    $name = $data['name'];
    $password = $data['password'];

    // insert ke database
    insert_student($studentid, $name, $password);

    get_students($studentid);
    break;
  case 'DELETE':
    $studentid = $_GET['studentid'];
    delete_student($studentid);

    echo '{ "Message" : "Data Deleted Successfully" }';
    break;
  default:
    header("HTTP/1.0 405 Method not allowed");
    break;
}

// function to retrieve students data
function get_students($studentid = ''){
  global $conn;
  $sql = "SELECT no, studentid, name FROM student";
  
  if($studentid != ''){
    $sql .= " WHERE studentid = '".$studentid."'";
  }

  $result = $conn->query($sql);

  $outp = "";
  while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"No":"'  . $rs["no"] . '",';
    $outp .= '"Studentid":"'   . $rs["studentid"]        . '",';
    $outp .= '"Name":"'. $rs["name"]     . '"}';
  }

  if($studentid == ''){
    $outp ='{"records":['.$outp.']}';
  }

  echo($outp);
}

// function to insert new student 
function insert_student($studentid, $name, $password){
  global $conn;
  $stmt = $conn->prepare("INSERT INTO student (studentid,name, password) VALUE (?,?,?)");
  $stmt->bind_param("sss", $studentid, $name, $password);
  $stmt->execute();
}

function delete_student($studentid){
  global $conn;
  $sql = "DELETE FROM student WHERE studentid = '" . $studentid . "'";
  $result = $conn->query($sql);
}


?>