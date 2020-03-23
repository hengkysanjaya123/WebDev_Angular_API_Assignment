<?php
include "include/conn_db.php";
include "include/header.php";
// include "include/student_crud_01_insert.php";

// if($_REQUEST['submitbtn'] == 'Save'){
//     student_insert($_REQUEST['studentid'], $_REQUEST['name'], $_REQUEST['password']);
//     $message = 'Data Saved';
// }
?>

<h1>Manage Student Data</h1>
<?php
    // echo $message;
?>

<div ng-app="myApp" ng-controller="studentCtrl">
    <h3 ng-value="message"></h3>
	<form ng-submit="submit()">
		<label for="studentid">Student ID</label>
		<input type="text" id="studentid" ng-model="studentid">

		<label for="studentname">Student Name</label>
		<input type="text" id="studentname" ng-model="studentname">

        <label for="studentname">Password</label>
		<input type="password" id="studentname" ng-model="studentpassword">

		<input type="submit"  value="submit">
	</form>
</div>
<!-- <form method="post">
    <input type="text" name="studentid" placeholder="Student ID">
    <br><br>

    <input type="text" name="name" placeholder="Student Name">
    <br><br>

    <input type="password" name="password" placeholder="Password">
    <br><br>

    <input type="submit" name="submitbtn" value="Save">
    <input type="reset" value="Reset">
</form> -->

<br>

<script>
var app = angular.module('myApp', []);
app.controller('studentCtrl', function($scope, $http) {

   $scope.submit = function(event){
        var data = {
			studentid : $scope.studentid,
            name : $scope.studentname,
            password: $scope.studentpassword
		};

        console.log(data);
        $http.post("student_crud.php",JSON.stringify(data))
			.then(function (response) {
                    console.log("data added successfully");
                    alert("data added successfully");
                    $window.location.href = "../student_list_separate.php";
				})
			.catch(function (err) { 
					console.log("error while requesting to insert data to server" + err)
				});
   }

});


</script>

<?php
// include "include/footer.php";
?>

