<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Sign Up Page</title>
  <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
<?php include('errors.php'); ?>
  <div class="sign">
  	<h2>Sign Up</h2>
 
	
  <form autocomplete="off"method="post" action="register.php">
  	
  	<div class="TB">
  	  <input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>">
  	</div>
  	<div class="TB">
  	  <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="TB">
  	  <input type="password" placeholder="password" name="password_1">
  	</div>
  	<div class="TB">
  	  <input type="password" placeholder="Confirmpassword"name="password_2">
  	</div>
	  <div class="Login">
  	  <button type="submit" class="btn" name="reg_user"><span></span>Register</button>
  	
	<div>
		<div class="signin">
		<p>Already a member? <a href="login.php">Sign in</a></p>
</div>
</div>
  </form>
</body>
</html>