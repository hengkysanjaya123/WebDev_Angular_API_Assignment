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
		</tr>
		<tr ng-repeat="x in names">
			<td>{{ x.Studentid }}</td>
			<td>{{ x.Name }}</td>
		</tr>
	</table>

</div>

<script>
var app = angular.module('myApp', []);
app.controller('studentCtrl', function($scope, $http) {
   $http.get("student_crud.php")
   .then(function (response) {$scope.names = response.data.records;});
});
</script>

<?php
include "include/footer.php";
?>