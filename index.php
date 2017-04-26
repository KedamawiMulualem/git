<?php // K.
session_start();
require_once 'dbconnect.php';

//If already logged in. Show success page.
if (isset($_SESSION['userSession'])!="") {
 header("Location: aboutme.html");
 exit;
}


//If user click button login. Get username and password.
if (isset($_POST['btn-login'])) {
 
 $userName = strip_tags($_POST['username']);
 $userPass = strip_tags($_POST['password']);
 
 $userName = $DBcon->real_escape_string($userName);
 $userPass = $DBcon->real_escape_string($userPass);
 
 
 //Getting user information by using username. Then compare password.
 $query = $DBcon->query("SELECT studentID, studentUser, studentPass FROM students WHERE studentUser='$userName'");
 $row=$query->fetch_array();
 
 //If user exists. $count must = 1.
 $count = $query->num_rows; 
 
 //Check if password is correct or not. If match, show success page.
 if ($userPass == $row['studentPass']) {
  $_SESSION['userSession'] = $row['studentID'];
  header("Location: aboutme.html");
 }
 
 
 //If password not match, show error.
 else {
  $msg = "<div>
          <h3 style=\"color: #383838\"> &nbsp; Invalid Username or Password !</h3>
          </div>";
 }
 $DBcon->close();
}
?>


<!DOCTYPE html>
<html>
<head>
 <link href="sa_styles.css" rel="stylesheet" type="text/css" />
</head>
<body  background="10.jpg">
<center>
       <form method="post" id="login-form">
      
        <h2>Sign In.</h2>
        
       

        
      <?php
           if(isset($msg)) {
                 echo $msg;
           }
      ?>
        <div>
        <input style="width: 25%; height: 5%; border-radius: 5px;" type="text" class="form-control" placeholder="Enter your username" name="username" required />
        <span></span>
        </div>
        

        <div>
        <input style="width: 25%; height: 5%; border-radius: 5px;" type="password" class="form-control" placeholder="Enter your password" name="password" required />
        </div>
       


            <br>
            <button style="width: 25%; height: 3%" type="submit" class="btn btn-default" name="btn-login" id="btn-login">
            <span></span> &nbsp; Log In
            </button> 
            
            <br>
            <br>
			<hr/>
            <a id="signup" href="register.php" class="btn btn-default"><h3>Do not have an account? Click here to sign up!</h3></a>
			<hr/>
      </form>

</center>
</body>
</html>