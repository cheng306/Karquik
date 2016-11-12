
<?php
	session_start();
?>

<?php

	if (isset($_POST["submit"])){
		if (isset($_POST["carIDArray"])){
			
			include("database_connect.php");
			
			foreach($_POST["carIDArray"] as $carID){

				$sql = "SELECT Image FROM image WHERE image.CarID=$carID;";
				$result = $conn->query($sql);
				
				//this while loop is for remove the images
				while($row = $result->fetch_assoc()){
					$imgPath = "images/".$row["Image"].".jpg";
					unlink($imgPath); 
				}

				$sql = "DELETE FROM Car WHERE Car.CarID = $carID;";
				$result = $conn->query($sql);

				$sql = "DELETE FROM ID WHERE ID.CarID = $carID;";
				$result = $conn->query($sql);

				$sql = "DELETE FROM image WHERE image.CarID = $carID;";
				$result = $conn->query($sql);

			}
			$conn->close();
		}
	}
	
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
			.checkOption{height:30%; background-color:rgba(255,255,255,0.5);}
			.checkBox{ width:20%;float:left; text-align: center; background-color:red;}
			.car{height:100%; width:80%;float:right; text-align: center; background-color:yellow;}
			.carInfo{height:100%; width:50%; float:left; text-align: center; font-size: 20px; }
			.carImg{height:100%; width:50%; float:right; text-align: center;}

		</style>
	</head>
	<body>
		<div id="header">
			<div style="text-align:center;"><a href="sellerpage.php">Back to Manage Page</a><div>
			<p style="font-size:50px; text-align:center;"> Select Car(s) You wish to remove </p>
		</div>
		<form action="" method="POST">
			<?php
				include("database_connect.php");

				$sql = "SELECT c.*, m.Image FROM Car AS c 
					LEFT JOIN image as m ON c.CarID=m.CarID
					LEFT JOIN ID as i ON c.CarID=i.CarID
					LEFT JOIN Seller as s ON i.SellerID=s.SellerID
					WHERE i.SellerID = '".$_SESSION['userName']."';";
				$result = $conn->query($sql);
				while($row = $result->fetch_assoc()) {
					$imgpath="images/".$row["Image"].".jpg";
					$carID = $row["CarID"];
					$make=$row['Makes'];
					$model=$row['Models'];
					$year = $row["Year"];
					$mile = $row["Miles"];
					$color = $row["Color"];
					$price = $row["Price"];
					echo "<div class='checkOption'>
							<div class='checkBox'><input style='transform:scale(2);' type='checkbox' name='carIDArray[]' value='$carID' /></div>
							<div class='car'>
								<div class='carInfo'>Make: $make<br>Model: $model<br>Year: $year<br>Mileage: $mile<br>Color: $color<br>Price: $price</div>
								<div class='carImg'><img src='$imgpath' style='height:100%;'></div>
							</div>
						</div><br>";
				}

				echo "<div style='text-align:center;'> <input style='transform:scale(2);' type='submit' name='submit' value='Remove'> </div>";
				$conn->close();

			?>
		</form>

		<!--testing div-->
		<div>

		</div>

	</body>
</html>



