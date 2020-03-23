<?php
include "include/conn_db.php";
include "include/header.php";
include "include/student_crud_01_insert.php";

if($_REQUEST['submitbtn'] == 'Save'){
    student_insert($_REQUEST['studentid'], $_REQUEST['name'], $_REQUEST['password']);
    $message = 'Data Saved';
}
?>

<h1>Manage Student Data</h1>
<?php
    echo $message;
?>

<form method="post">
    <input type="text" name="studentid" placeholder="Student ID">
    <br><br>

    <input type="text" name="name" placeholder="Student Name">
    <br><br>

    <input type="password" name="password" placeholder="Password">
    <br><br>

    <input type="submit" name="submitbtn" value="Save">
    <input type="reset" value="Reset">
</form>

<br>

<a href="student_list_separate_01_insert.php">Back</a>

<?php
include "include/footer.php";
?>

