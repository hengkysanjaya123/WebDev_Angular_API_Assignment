<!DOCTYPE html>
<html lang="en">
<head>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


</head>
<body>

<?php
include "include/header.php";
?>
<div ng-app="myApp" ng-controller="studentCtrl" class="container-fluid">

	<h1>Student List</h1>

	<!-- <a href="student_manage.php">
		+ New Student
	</a> -->

	<table class="table table-striped table-light">
		<tr>
			<th>Student ID</th>
			<th>Student Name</th>
			<th colspan="2">Action</th>
		</tr>
		<tr ng-repeat="student in students">
			<td>{{ student.Studentid }}</td>
			<td>{{ student.Name }}</td>
			<!-- <td><input type="button" value="Delete" id={{student.Studentid}} ng-click="delete($event)"></td>
			<td><input type="button" value="Update" id={{student}} ng-click="update($event)"></td> -->
			<td><input type="button" value="Delete" id={{student.Studentid}} class="btn btn-danger btn-lg btn-block"ng-click="delete($event)"></td>
			<td><input type="button" value="Update" id={{student}} class="btn btn-info btn-lg btn-block" ng-click="update($event)"></td>
		</tr>
	</table>
	<a class="btn btn-primary" href="student_manage.php" role="button">Add New Student</a>

</div>

<script>
var app = angular.module('myApp', []);
app.controller('studentCtrl', function($scope, $http) {
    $scope.refresh = function(){
		$http.get("student_crud.php")
			.then(function (response) {$scope.students = response.data.records;});
   }

   $scope.update = function(event){
	   var data = event.target.id;
		var obj = JSON.parse(data);
    	// console.log(obj);
	//    console.log(data.Studentid);
	   location.href = "student_manage.php?studentid=" + obj['Studentid'] + "&name=" + obj['Name'] + "&no=" + obj['No'];
   }

   $scope.delete = function(event){
		var studentid = event.target.id;
		console.log(studentid);

		$http.delete("student_crud.php?studentid=" + studentid)
			.then(function (response) {
					console.log(response);
					$scope.refresh();
				})
			.catch(function (err) {
					console.log("error while requesting to delete data to server" + err)
				});
   };


	$scope.refresh();
});
</script>

<?php
// include "include/footer.php";
?>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>




</html>
