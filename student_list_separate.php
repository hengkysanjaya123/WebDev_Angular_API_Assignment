<?php
include "include/header.php";
?>
<div ng-app="myApp" ng-controller="studentCtrl">

	<h1>Student List</h1>

	<a href="student_manage.php">
		+ New Student
	</a>

	<table>
		<tr>
			<th>Student ID</th>
			<th>Student Name</th>
			<th colspan="2">Action</th>
		</tr>
		<tr ng-repeat="student in students">
			<td>{{ student.Studentid }}</td>
			<td>{{ student.Name }}</td>
			<td><input type="button" value="Delete" id={{student.Studentid}} ng-click="delete($event)"></td>
			<td><input type="button" value="Update" id={{student}} ng-click="update($event)"></td>
		</tr>
	</table>

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
	   location.href = "student_manage.php?studentid=" + obj['Studentid'] + "&name=" + obj['Name'] + + "&no=" + obj['No'];
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