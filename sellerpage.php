<?php
	session_start();
?> 

<html>
	<head>
		<link type="text/css" rel="stylesheet" href="carstyles.css"/>
		<!--style overwrite-->
		<style>
		#header{
				height: 150px;
				background: white; /* For browsers that do not support gradients */
				background: -webkit-linear-gradient(bottom,rgba(255,255,255,0),rgba(255,255,255,1)); /*Safari 5.1-6*/
				background: -o-linear-gradient(bottom,rgba(255,255,255,0),rgba(255,255,255,1)); /*Opera 11.1-12*/
				background: -moz-linear-gradient(bottom,rgba(255,255,255,0),rgba(255,255,255,1)); /*Fx 3.6-15*/
				background: linear-gradient(bottom, rgba(255,255,255,0), rgba(255,255,255,1)); /*Standard*/
			
		}
		.car{height:30%; background-color:rgba(255,255,255,0.5);}
		.carInfo{height:100%; width:50%; float:left; text-align: center; font-size: 20px;}
		.carImg{height:100%; width:50%; float:right; text-align: center;}
		</style>
		<title>Sellers page</title>
	</head>

	<body>
	<div id="header">
	<form action="logout.php">
		<input type="submit" value="logout"/>
	</form>
	<p style="font-size:50px; text-align:center;"> Welcome <?php echo($_SESSION["userName"]); ?> </p>
	</div>

	

	<div style="height:auto; content:""; display:table">

		<a style="display:block; width:20%; margin:auto;" href="createAd.php"><img style="width:100%;" alt="Click to post" src="AddProduct.png"/></a>
		<a style="display:block; width:20%; margin:auto;" href="removeProduct.php"><img style="width:100%;" alt="Remove Product" src="RemoveProduct.png"></a>
		<a style="display:block; width:20%; margin:auto;" href="contact.html"><img style="width:100%;" alt="Contact Us" src="ContactUs.png"></a>
	</div>
	<div style="font-size:50px; text-align:center; background-color:rgba(255,255,255,0.5);">
		Your Listed Car(s):
	</div>
	<br>
<?php
	include("database_connect.php");
	$sql = "SELECT c.*, m.Image FROM Car AS c 
		LEFT JOIN image as m ON c.CarID=m.CarID
		LEFT JOIN ID as i ON c.CarID=i.CarID
		LEFT JOIN Seller as s ON i.SellerID=s.SellerID
		WHERE i.SellerID = '".$_SESSION['userName']."';";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	// output data of each row
    	while($row = $result->fetch_assoc()) {

			$imgpath="images/".$row["Image"].".jpg";

			echo "<div class='car'>";

			echo "<div class='carImg'>";
			echo "<img src='$imgpath' style='height:100%;'>";
			echo "</div>";

			echo "<div class='carInfo'>";
			echo "Make: ".$row['Makes']."<br> Model: ".$row['Models']."<br>Year:".$row["Year"]."<br>Mileage: ".$row["Miles"]."<br>Color: ".$row["Color"]."<br>Price: ".$row["Price"];
			echo "</div>";

			echo "</div>";
			echo "<br>";
    	}
	}

	$conn->close();
?>
		<div>
			<?php
				echo $_SESSION["userName"];
			?>
		</div>


	</body>

</html>
