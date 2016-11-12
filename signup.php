<?php
	session_start();
	if (isset($_SESSION["userName"])&&!empty($_SESSION["userName"])){
		echo "<script type='text/javascript'>window.location.href = 'sellerpage.php';</script>";
	}
?>


<?php
	// Set all error to be "" at the beginning
	$userNameErr = $firstNameErr = $lastNameErr = $contactErr = $passwordErr = $confpassErr = $emailErr= "";
	$userName = $firstName = $lastName = $address = $city = $state = $email = $contact = $password = $confpass = "";
	$valid = TRUE;
	$finishValidation = FALSE;
	if ($_SERVER['REQUEST_METHOD']=="POST"){

		if (empty($userName=trim($_POST["username"]))){
			$userNameErr = "UserName is required";
			$valid = FALSE;
		}
		else if (!preg_match("/^[a-zA-Z0-9]*$/",$userName)){
			$userNameErr = "Only Numbers and Letters in UserName (No Space)";
			$valid = FALSE;
		}
		
		include("database_connect.php");
		$sql = "SELECT SellerID FROM Seller WHERE SellerID = \"$userName\";";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$userNameErr = "Username already in use";
			$valid = FALSE;
		}
		$conn->close();


		if (empty($firstName=trim($_POST["firstname"]))){
			$firstNameErr = "First Name is required";
			$valid = FALSE;
		}
		else if (!preg_match("/^[a-zA-Z ]*$/",$firstName)){
			$firstNameErr = "Only Letters in First Name";
			$valid = FALSE;
		}

		if (empty($lastName=trim($_POST["lastname"]))){
			$lastNameErr = "Last Name is required";
			$valid = FALSE;
		}
		else if (!preg_match("/^[a-zA-Z ]*$/",$lastName)){
			$lastNameErr = "Only Letters in Last Name";
			$valid = FALSE;
		}

		if (empty($contact=trim($_POST["phone"]))){
			$contactErr = "Contact Number is required";
			$valid = FALSE;
		}
		else if (!preg_match("/^[0-9]*$/",$contact)){
			$contactErr = "Only Numbers in Contact";
			$valid = FALSE;
		}

		$email = trim($_POST["email"]);
		if (!empty($email)&&!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$emailErr = "Invalid email";
			$valid = FALSE;
		}

		if (empty($password=$_POST["password"])){
			$passwordErr = "Password is required";
			$valid = FALSE;
		}
		else if(empty($confpass=trim($_POST["confpass"]))){
			$confpassErr = "Confrim Password is required";
			$valid = FALSE;
		}
		else if ($password!=$confpass){
			$confpassErr = "Confrim Password not consistent";
			$valid = FALSE;
		}

		$address=$_POST["address"];
		$city=$_POST["city"];
		$state=$_POST["state"];

		$finishValidation = TRUE;
		
		if ($valid&&$finishValidation){
			
			
			include("database_connect.php");
			$sql = "INSERT INTO  Seller (SellerID, FirstName, LastName, PassWord, Contact, Address, City, State, Email) 
			VALUES (\"$userName\", \"$firstName\", \"$lastName\", \"$password\", $contact, \"$address\", \"$city\", \"$state\", \"$email\" );";
			$conn->query($sql);
			$conn->close();
			$_SESSION['userName']=$userName;
			echo "<script type='text/javascript'>window.location.href = 'sellerpage.php';</script>";

			 
			
		}
	} 

?>

<html>
	<head>
		<link type="text/css" rel="stylesheet" href="signupstyle.css"/>
		<meta charset="UTF-8">

	</head>
	
	<body>


	

		<ul>
			<li class="menu"><a class="active" href="index.html">Home</a></li>
			<li class="menu"><a href="contact.html">Contact</a></li>
			<li class="menu"><a href="#about">About</a></li>
		</ul>
		
		
		<form action="" method="post">
			<ol type = "1" style="list-style-type:none">
					
				<div>
					<div class="left"><li>UserName:</li></div>
					<div class="right"><input class="text" type="text" name="username" value="<?php print $userName; ?>">
						<span> * <?php print $userNameErr ?></span></div>
				</div>
				
				<div>
					<div class="left"><li>First Name:</li></div>
					<div class="right"><input class="text" type="text" name="firstname" value="<?php print $firstName; ?>">
						<span> *  <?php print $firstNameErr ?> </span></div>
				</div>
				
				<div>
					<div class="left"><li>Last Name:</li></div>
					<div class="right"><input class="text" type="text" name="lastname" value="<?php print $lastName; ?>">
						<span> * <?php print $lastNameErr ?></span></div>
				</div>
				
				<div>
					<div class="left"><li>Address:</li></div>
					<div class="right"><input class="text" type="text" name="address" value="<?php print $address; ?>"></div>
				</div>
				
				<div>				
					<div class="left"><li>City:</li></div>
					<div class="right"><input class="text" type="text" name="city" value="<?php print $city; ?>"></div>
				</div>
					
				<div>	
					<div class="left"><li>State:</li></div>
					<div class="right"><input class="text" type="text" name="state" value="<?php print($state) ?>"></div>
				</div>
			
				<div>
					<div class="left"><li>e-mail:</li></div>
					<div class="right"><input class="text" type="text" name="email" value="<?php print($email) ?>">
						<span><?php print($emailErr)?></span></div>
				</div>
				
				<div>
					<div class="left"><li>Conact number:</li></div>
					<div class="right"><input class="text" type="text" name="phone" value="<?php print($contact) ?>">
						<span> * <?php print $contactErr ?></span></div>
				</div>
				
				<div>
					<div class="left"><li>Password:</li></div>
					<div class="right"><input class="text" type="password" name="password" value="<?php print($password) ?>">
						<span> * <?php print($passwordErr) ?></span></div>
				</div>
				
				<div>
					<div class="left"><li>Confirm Password:</li></div>
					<div class="right"><input class="text" type="password" name="confpass">
						<span> * <?php print($confpassErr) ?></span></div>
				</div>
				
			
			</ol>

			<div>
				<div class="left"><input class="finish" type="submit" value="Finish" style="text-align:center;"></div>
				<div class="right"><input type="reset" value="Cancel"></div>
			</div>
		</form>

		<div>
			<?php 
			//testing php

			?>
		</div>


	</body>	

</html>
