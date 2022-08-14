<?php
//Using database connection file here
include('configuration.php');

//Save form data
if (!empty($_POST['first_name']))
   {
      $first_name =  $_POST['first_name'];
      $last_name =  $_POST['last_name'];
      $email = $_POST['email'];
      $emp_rank = $_POST['emp_rank'];
      $password = $_POST['password'];

      $stmt = $db->prepare("INSERT INTO users (first_name, last_name, email, emp_rank, password) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("sssss", $fname, $lname, $email, $erank, $pass);

//Set parameters and execute
      $fname = $first_name;
      $lname = $last_name;
      $email = $email;
      $erank = $emp_rank;
      $pass = MD5($password);
	
	   if(!$stmt->execute())
      echo "<span style='color:red'>Error while adding new user</span>";
      else 
      $stmt->close();
      $db->close();
      
      //header("location:addUser.php"); 
      echo "User added successfully";
      exit;
   }
?>

<!DOCTYPE html>
<html>
<head>
<title>Add User</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<div class="container">
<h3>Add a New User</h3>
<style>
   body{background-color:#767c82;}
   .container{margin-top:3%;}
</style>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
      
<div class="row mb-4">
   <label for="inputFirstName" class="col-sm-2 col-form-label">First Name:</label>
   <div class="col-sm-3">
   <input type="first_name" id="inputFirstName" name="first_name" class="form-control">
   </div>
</div>
<div class="row mb-4">
   <label for="inputLastName" class="col-sm-2 col-form-label">Last Name:</label>
   <div class="col-sm-3">
   <input type="last_name" id="inputLastName" name="last_name" class="form-control" >
   </div>
</div>
<div class="row mb-4">
   <label for="inputEmail" class="col-sm-2 col-form-label">Email:</label>
   <div class="col-sm-3">
   <input type="email" id="inputEmail" name="email" class="form-control" >
   </div>
</div>
<div class="row mb-4">
   <label for="inputRank" class="col-sm-2 col-form-label">Rank:</label>
   <div class="col-sm-3">
   <input type="emp_rank" id="inputRank" name="emp_rank" class="form-control" >
   </div>
</div>
<div class="row mb-4">
   <label for="inputPassword" class="col-sm-2 col-form-label">Password:</label>
   <div class="col-sm-3">
   <input type="password" id="inputPassword" name="password" class="form-control" >
   </div>
</div>

	<button type="submit" class="btn btn-primary col-sm-1" name="submit">Submit</button>

</form>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>