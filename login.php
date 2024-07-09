<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <link rel="stylesheet" type="text/css" href="login.css">
  
</head>

<body>
<?php include('errors.php'); ?>
 <div class="blur">
  	<h2>Login</h2>
  <form autocomplete="off" method="post" action="login.php">
  

  	<div class="TB">
  		<input type="text" name="username" placeholder="Username" >
  	</div>
  	<div class="TB">
  		<input type="password" name="password" id="password" placeholder="Password">
  	</div>
	<div class="Show">
		<input type="checkbox" id="showPassword">
		<label for="showPassword">Show Password</label>
	</div>
  	<div class="Login">
  		<button type="submit" class="btn" name="login_user"><span></span>Login</button>
  	</div>
	 
	<div class="signup">
  	<p>
  		Don't have Account?click <a href="register.php">Sign up</a>
  	</p>
</div>
</div>
	  <script src= "script.js"></script>
  </form>
 
</body>
</html>
