<?php
	session_start();
	if (isset($_SESSION["userName"])&&!empty($_SESSION["userName"])){
		echo "<script type='text/javascript'>window.location.href = 'sellerpage.php';</script>";
	}
?>

<?php
	$usernameErr = $passwordErr="";
	$username = $password="";
	$noEmpty = TRUE;
	$afterValidation = FALSE;

	//After user click login, get both username and password
	
	if ($_SERVER['REQUEST_METHOD']=="POST"){
		
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);

		if(empty($username)){
			$usernameErr="Please enter Username";
			$noEmpty = FALSE;
		}

		if(empty($password)){
			$passwordErr="Please enter Password";
			$noEmpty = FALSE;
		}

		$afterValidation = TRUE;
		if ($noEmpty){
			
			include("database_connect.php");
			$sql = "SELECT SellerID, PassWord FROM Seller WHERE SellerID = '$username';";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			
			//case1: no such username
			if ($result->num_rows == 0){
				$usernameErr="No such Username";
				$passwordErr="";
			}
			//case2: username exists and password match
			else if ($row['PassWord']==$password){
				//start the session when you login sucessfully
				$_SESSION['userName']=$username;
				$conn->close();
				echo "<script type='text/javascript'>window.location.href = 'sellerpage.php';</script>";
			}
			//case3: username exist but password wrong
			else {
				$passwordErr="Username Password not match";
			}
					
	
		}
		
	}
	
	
?>

<html>
	<head>
		<link type="text/css" rel="stylesheet" href="loginstyle.css"/>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<meta charset="UTF-8">
	</head>
	
	<body>
	
		<ul>
			<li><a class="active" href="index.html">Home</a></li>
			<li><a href="contact.html">Contact</a></li>
			<li><a href="about.html">About</a></li>
		</ul>
		<div class="container">
			<form role="form" action="" method="post">
				<div class="form-group">
					<label for="userName">Username</label>
					<input class="form-control" type="text" name="username" value="<?php print($username)?>"><span style="color:red;"><?php print($usernameErr) ?></span>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input class="form-control" type="password" name="password"><span style="color:red;"><?php print($passwordErr) ?></span>		
				</div>
				<div class="checkbox">
					<input class="btn btn-default" type="submit" value="login">
				</div>
			</form>
			<a href="forget_password.php"><sup>forgot password/username?</sup></a>
		</div>

		<div class="checkbox">
		<a  href="signup.php"><button style="width:100%" class="btn btn-default"  type="button">Signup</button></a>
		</div>

		
		
	</body>
</html>
