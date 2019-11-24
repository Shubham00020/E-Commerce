<?php 
	require_once $_SERVER['DOCUMENT_ROOT'].'/web/core/init.php';
	include 'includes/head.php';
	$email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
	$email = trim($email);
	$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
	$password = trim($password);
	
	$errors = array();
?>

<body>
<div id="login-form">
	<div>

		<?php 
			if($_POST){
				//form validation
				if(empty($_POST['email']) || empty($_POST['password'])){
					$errors[] = 'You must provide email and password';
				}


				//validate email
				if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
					$errors[] = 'You must enter a valid email';
				}

				//password is more than 6 characters
				if(strlen($password) < 6){
					$errors[] = 'Password must be at least 6 charactes';
				}

				//check if email exist in the database
				$query = $db->query("SELECT * FROM users WHERE email = '$email'");
				$users = mysqli_fetch_assoc($query);
				$userCount = mysqli_num_rows($query);
				if($userCount < 1){
					$errors[] = 'That email is does\'t exist in our database';
				}

				if(!password_verify($password, $users['password'])){
					$errors[] = 'The password does not match..Please try again..';
				}

				//check for errors
				if(!empty($errors)){
					echo display_errors($errors);
				}else{
					//login user
					$user_id = $users['id'];
					login($user_id);
				}
			}
		?>
	</div>
	<h2 class="text-center">Login</h2><hr>
	<form action="login.php" method="post">
		<div class="form-group">
			<lable for="email">Email :</lable>
			<input type="email" name="email" id="email" class="form-control" value="<?=$email?>">
		</div>
		<div class="form-group">
			<lable for="password">Password :</lable>
			<input type="password" name="password" id="password" class="form-control" value="<?=$password?>">
		</div>
		<div class="form-group">
			<input class="btn btn-primary" type="submit" value="login">
		</div>		
	</form>
	<p class="text-right"><a href="/web/index.php" alt="home">Visit Site</a></p>
</div>	
<?php 
include 'includes/footer.php';
?>