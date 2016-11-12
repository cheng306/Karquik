<?php
	//session_start();
	$order="DESC";
	$column="Year";
	$sortOption = array ('Highest Price','Lowest Price','Newest','Oldest','Highest Mileage','Lowest Mileage');
	$validYearMin = 1990;
	$validYearMax = date("Y");
	$validPriceMin = 500;
	$validPriceMax = 10000;
	$yearErr = $priceErr = "";

?>

<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST"){

		if ($_POST["sort"]==="Highest Price"){
			$order="DESC";
			$column="Price";
		}
		else if ($_POST["sort"]==="Lowest Price"){
			$order="ASC";
			$column="Price";
		}
		else if ($_POST["sort"]==="Newest"){
			$order="DESC";
			$column="Year";
		}
		else if ($_POST["sort"]==="Oldest"){
			$order="ASC";
			$column="Year";
		}
		else if ($_POST["sort"]==="Highest Mileage"){
			$order="DESC";
			$column="Miles";
		}
		//last option i.e Lowest Mileage
		else{
			$order="ASC";
			$column="Miles";
		}

		$yearMin=trim($_POST['yearMin']);
		$yearMax=trim($_POST['yearMax']);
		if ($yearMin===""){
			$yearErr="Year not provided";
		}
		else if (!preg_match("/^[0-9]*$/",$yearMin)){
			$yearErr="Invalid Year";
		}
		else if (empty($yearMax)){
			$yearErr="Year not provided";
		}
		else if (!preg_match("/^[0-9]*$/",$yearMax)){
			$yearErr="Invalid Year";
		}
		else if ($yearMin>$yearMax){
			$yearErr='Invalid year range';
		}
		else{
			$validYearMin=$yearMin;
			$validYearMax=$yearMax;
		}

		$priceMin=trim($_POST['priceMin']);
		$priceMax=trim($_POST['priceMax']);
		if ($priceMin===""){
			$priceErr="price not provided";
		}
		else if (!preg_match("/^[0-9]*$/",$priceMin)){
			$priceErr="Invalid Price";
		}
		else if (empty($priceMax)){
			$priceErr="Price not provided";
		}
		else if (!preg_match("/^[0-9]*$/",$priceMax)){
			$priceErr="Invalid Price";
		}
		else if ($priceMin>$priceMax){
			$priceErr='Invalid price range';
		}
		else{
			$validPriceMin=$priceMin;
			$validPriceMax=$priceMax;
		}
	}
?>

<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link type="text/css" rel="stylesheet" href="carstyles.css"/>
<style>
	.car{height:30%; background-color:rgba(255,255,255,0.5);}
	.carInfo{height:100%; width:50%; float:left; text-align: center; font-size: 20px;}
	.carImg{height:100%; width:50%; float:right; text-align: center;}
	.error{color:red;}
</style>
<title>Cars homepage</title>
</head>
<body>
	<center>
		<div class="container-fluid ">
		<div class="jumbotron">
			<h1>
				Buyers Page
			</h1>
		</div>
		</div>

	</center>
	

	<!--This div is the criteria(range setting part)-->
	<div>
		<form action="" method="POST">
			<div style="display:inline-block; width:15%; text-align:center;">
				<label for="sort">Sort Option</label><br>
				<select name="sort">
					<?php
						//list all option in select
						foreach($sortOption as $option){
							if ($_POST["sort"]===$option){
								$selected = "selected";
							}
							else{
								$selected="";
							}
							echo "<option value='$option' $selected>$option</option>";
						}
					?>
				</select>
			</div>
			<div style="display:inline-block; width:30%; text-align:center;">
				<label for="year">Year Range:</label><span class="error"><?php echo" *$yearErr"; ?></span><br>
				<input type="text" value="<?php echo($validYearMin) ?>" name="yearMin"/>
				<input type="text" value="<?php echo($validYearMax) ?>" name="yearMax"/>
			</div>
			<div style="display:inline-block; width:30%; text-align:center;">
				<label for="year">Price Range:</label><span class="error"><?php echo" *$priceErr"; ?></span><br>
				<input type="text" value="<?php echo($validPriceMin) ?>" name="priceMin"/>
				<input type="text" value="<?php echo($validPriceMax) ?>" name="priceMax"/>
			</div>
			<div style="display:inline-block; width:15%; text-align:center;">
				<input type="submit">
			</div>
		</form>
	</div>

		
<?php
	//This php display all available car in database
	include("database_connect.php");
	$sql = "SELECT Car.*, image.Image, Seller.Contact FROM Car 
		LEFT JOIN image ON Car.CarID=image.CarID 
		LEFT JOIN ID ON Car.CarID=ID.CarID
		LEFT JOIN Seller ON ID.SellerID = Seller.SellerID 
		WHERE (Year BETWEEN $validYearMin AND $validYearMax) AND (Price BETWEEN $validPriceMin AND $validPriceMax)
		ORDER BY ".$column. " ".$order.";";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {

	// output data of each row
		while($row = $result->fetch_assoc()) {
			//image path
			$imgpath="images/".$row["Image"].".jpg";

			echo "<div class='car'>";

			echo "<div class='carImg'>";
			echo "<img src='$imgpath' style='height:100%;'>";
			echo "</div>";

			echo "<div class='carInfo'>";
			echo "Make: ".$row['Makes']."<br> Model: ".$row['Models']."<br>Year:".$row["Year"]."<br>Mileage: ".$row["Miles"]."<br>Color: ".$row["Color"]."<br>Price: ".$row["Price"]."<br>Seller Contact: ".$row["Contact"];
			echo "</div>";

			echo "</div>";
			echo "<br>";
		}
	}
	$conn->close();
?>

<!-- Testing area-->
<div>
	<?php 


	?>
</div>




</body>
