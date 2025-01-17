<?php
//connect to the database
require("configuration.php");
//initialize session
session_start(); 

//login and operation
$error="";
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
   // extract form request inputs and sanitize
   $email = mysqli_real_escape_string($db,$_POST['email']);
   $password = mysqli_real_escape_string($db,$_POST['password']);
   $rank = mysqli_real_escape_string($db,$_POST['emp_rank']);

   // encrypted password hash
   $hash = md5($password); 

   // query database
   $sql = "SELECT * FROM users WHERE email = '". $email ."' AND password = '". $hash ."' AND emp_rank = '". $rank . "'";
   $user = mysqli_fetch_array(mysqli_query($db,$sql), MYSQLI_ASSOC);

   if (!$user) $error = "Your Login credentials are incorrect!";
   else {
      // set session variable
      $_SESSION['login_user'] = $user['email'];
      $_SESSION['emp_rank'] = $user['emp_rank'];

      // conditional page redirects based on rank 
      if ($user['emp_rank'] == 'admin') header("location: addUser.php");
      elseif ($user['emp_rank'] == 'project manager') header("location: home.php");
      else  header("location: home.php");
   }
}
?>

<!DOCTYPE html>
<html>
<html>
   <head>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <style>
         body {
            background-color: #767c82;
         }
         .container {
            margin-top: 3%;
         }
         button:hover {
            opacity: 0.8;
         }
      </style>
      <title>User Login</title>
   </head>

<body>
      <div class="container">
         <h3>User Login</h3>
         <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <div class="row mb-4">
               <label for="inputemail" class="col-sm-1 col-form-label">Email:</label>
               <div class="col-sm-3">
                  <input type="email" class="form-control"  name="email" required>
               </div>
            </div>
            <div class="row mb-4">
               <label for="inputPassword" class="col-sm-1 col-form-label">Password:</label>
               <div class="col-sm-3">
                  <input type="password" class="form-control" name="password" required>
               </div>
            </div>
            <div class="row mb-4">
               <label for="emp_rank" class="col-sm-1 col-form-label">Rank:</label>
               <div class="col-sm-3">
                  <select name="emp_rank" class="form-control" required>
                     <option value="">-- Select Rank --</option>
                     <?php foreach(["admin", "project manager", "user"] as $rank): ?>
                        <option value="<?= $rank ?>">
                           <?= $rank ?>
                        </option>
                     <?php endforeach; ?>  
                  </select>
               </div>
               <p class="text-danger"> <?= $error?: $error; ?> </p>
            </div>
            <button type="submit" class="btn btn-dark col-sm-1" name="login" style="margin-left:50";>Sign in</button>
            <div><a href="passwordReset.php">Forgot Password?</a></div>
         </form>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
   </body>
</html>