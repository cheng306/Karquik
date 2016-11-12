
<html>
	<head>
		<link type="text/css" rel="stylesheet" href="loginstyle.css"/>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<meta charset="UTF-8">
	</head>
	
	<body>

	<div>
<?php
	$username = $email = "";
	$usernameErr = $email = "";
	if ($_SERVER['REQUEST_METHOD']=="POST"){
		include("database_connect.php");
		$username=trim($_POST['username']);
		$email=trim($_POST['email']);
		//user provide only username
		if ($username!==""&&$email===""){
			$sql ="SELECT PassWord, Email FROM Seller WHERE Seller.SellerID = '$username'";
			$result = $conn->query($sql);
			
			if ($result->num_rows===0){
				$usernameErr = "* No such Username";
			}
			else{
				$row = $result->fetch_assoc();
				if ($row["Email"]===""){
					$usernameErr = "* There is no Email registered with this Username. Maybe you can signup a new account";
				}
				else{
					$email=$row['Email'];
					$password=$row['PassWord'];
					mail("$email","Password Recovery","Username: $username\nPassword: $password");
					$conn->close();
					echo "<script type='text/javascript'>window.location.href = 'back_login.html';</script>";
				}

			}
		}
		//user provide only email
		else if ($username===""&&$email!==""){
			$sql ="SELECT SellerID, PassWord FROM Seller WHERE Seller.Email = '$email';";
			$result = $conn->query($sql);
		
			if ($result->num_rows===0){
				$emailErr = "* No such Email";
			}
			else{
				while ($row = $result->fetch_assoc()){
					var_dump($row);
					$username=$row['SellerID'];
					$password=$row['PassWord'];
					mail("$email","Password Recovery","Username: $username\nPassword: $password");
				}
			$conn->close();
			echo "<script type='text/javascript'>window.location.href = 'back_login.html';</script>";
			}
		}
		else if ($username===""&&$email===""){
			$usernameErr="* Either Username or Email is required";
			$emailErr="* Either Username or Email is required";
		}
		//both username or email are given 
		//in this case send email that match either username or email field
		else{

			$sql ="SELECT SellerID, PassWord, Email FROM Seller WHERE Seller.SellerID = '$username' OR Seller.Email = '$email';";
			$result = $conn->query($sql);
			
			if ($result->num_rows===0){
				$usernameErr="* Both Username and Email invalid";
				$emailErr="* Both Username and Email invalid";
			}
			
			else{
				while ($row = $result->fetch_assoc()){
					$username = $row['SellerID'];
					$email = $row['Email'];
					$password = $row['PassWord'];
					echo $email;
					mail("$email","Password Recovery","Username: $username\nPassword: $password");
				}
				$conn->close();
				echo "<script type='text/javascript'>window.location.href = 'back_login.html';</script>";
			}
			

		}
		
	}

?>

	</div>
		
	
		<ul>
			<li><a class="active" href="index.html">Home</a></li>
			<li><a href="contact.html">Contact</a></li>
			<li><a href="about.html">About</a></li>
		</ul>
		<div style="text-align:center;"><a href="login.php">Back to Login Page</a></div>

		<div class="container">
			<form role="form" action="" method="post">
				<label for="title">Please enter your Username OR Email</label>
				<div style="height:5%"></div>
				<div class="form-group">
					<label for="userName">Username</label>
					<input class="form-control" type="text" name="username" value="<?php print($username)?>"><span style="color:red;"><?php print($usernameErr) ?></span>
				</div>
				<label for="title">--OR--</label>
				<div class="form-group">
					<label for="password">Email</label>
					<input class="form-control" type="text" name="email" value="<?php print($email)?>"><span style="color:red;"><?php print($emailErr) ?></span>		
				</div>
				<div class="checkbox">
					<input class="btn btn-default" type="submit" value="Submit">
				</div>
			</form>
		</div>
		

		<!--testing div-->
		<div>

		</div>
		
	</body>
</html>
