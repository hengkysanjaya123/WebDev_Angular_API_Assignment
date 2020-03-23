<!DOCTYPE html>
<html lang="en">
<head>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


</head>
<body>

  <?php
  include "include/conn_db.php";
  include "include/header.php";
  // include "include/student_crud_01_insert.php";

  // if($_REQUEST['submitbtn'] == 'Save'){
  //     student_insert($_REQUEST['studentid'], $_REQUEST['name'], $_REQUEST['password']);
  //     $message = 'Data Saved';
  // }

  ?>
<div class="container-fluid">
  <h1>Manage Student Data</h1>
  <?php
      // echo $message;
  ?>
  <div ng-app="myApp" ng-controller="studentCtrl">
  <!-- ng-submit="submit()" -->
  <form >
      <div class="form-group row">
        <label for="studentid" class="col-sm-2 col-form-label">Student ID</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="studentid" name="studentid" placeholder="Student ID" ng-model="studentid" value="<?php echo $studentid?>">
        </div>
      </div>
      <div class="form-group row">
        <label for="studentname" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="studentname" name="studentname" placeholder="Student Name" ng-model="studentname" value="<?php echo $name?>">
        </div>
      </div>
      <div class="form-group row">
        <label for="studentpassword" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="studentpassword" name="studentpassword" placeholder="Password" ng-model="studentpassword" value="">
          <input type="hidden" ng-model="no" value="<?php echo $no?>">
        </div>
      </div>
      <div class="form-group row">
        <div class="offset-sm-2 col-sm-10">
          <input type="submit" ng-click="submit($event)" value="<?php echo isset($_GET['no']) ? 'Update' : 'Submit' ?>" class="btn btn-primary btn-lg" ng-model="submitbtn"/>
        </div>
      </div>
    </form>
  </div>

<a class="btn btn-secondary" href="student_list_separate.php" role="button">Return to Homepage</a>
</div>

  <!-- <div ng-app="myApp" ng-controller="studentCtrl">
      <h3 ng-value="message"></h3>
  	<form ng-submit="submit()">
  		<label for="studentid">Student ID</label>
  		<input type="text" id="studentid" ng-model="studentid">

  		<label for="studentname">Student Name</label>
  		<input type="text" id="studentname" ng-model="studentname">

          <label for="studentname">Password</label>
  		<input type="password" id="password" ng-model="studentpassword">

  		<input type="submit"  value="submit">
  	</form>
  </div> -->
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
    $scope.studentid = "<?php echo isset($_GET['studentid']) ? $_GET['studentid'] : '' ?>";
    $scope.studentname = "<?php echo isset($_GET['name']) ? $_GET['name'] : '' ?>";
    $scope.no = "<?php echo isset($_GET['no']) ? $_GET['no'] : '' ?>";

     $scope.submit = function(event){

        var btnText = event.target.value;


        if(btnText == "Submit"){
        var data = {
  			studentid : $scope.studentid,
              name : $scope.studentname,
              password: $scope.studentpassword == undefined ? "" : $scope.studentpassword
  		};
          
          console.log(data);
          $http.post("student_crud.php",JSON.stringify(data))
  			.then(function (response) {
                      console.log("data added successfully");
                      alert("data added successfully");
                      // $scope.message = "data added successfully";
  				})
  			.catch(function (err) {
  					console.log("error while requesting to insert data to server" + err)
  				});
        }
        else{
            var data = {
                studentid : $scope.studentid,
                name : $scope.studentname,
                password: $scope.studentpassword == undefined ? "" : $scope.studentpassword,
                no: $scope.no
            };
            $http.post("student_crud.php",JSON.stringify(data))
  			.then(function (response) {
                      console.log("data updated successfully");
                      location.href = 'student_manage.php';
                      alert("data updated successfully");
                      // $scope.message = "data added successfully";
  				})
  			.catch(function (err) {
  					console.log("error while requesting to update data to server" + err)
  				});
        }
     }

  });



</script>
 <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>




</html>
