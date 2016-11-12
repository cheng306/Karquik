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
div 1
		<a style="display:block; width:20%; margin:auto;" href="createAd.php"><img style="width:100%;" alt="Click to post" src="AddProduct.png"/></a>
		<a style="display:block; width:20%; margin:auto;" href="createAd.php"><img style="width:100%;" alt="Remove Product" src="RemoveProduct.png"></a>
		<a style="display:block; width:20%; margin:auto;" href="contact.html"><img style="width:100%;" alt="Contact Us" src="ContactUs.png"></a>
	</div>
	
	<div style="height:auto; content:""; display:table" >


	<a style="display:block; width:20%; float:left" href="createAd.php"><img style="max-width:20em; max-length:20em" src="2015-Nissan-Leaf-C.jpg"></a>

	<p style="float:center; color:Yellow; font-size:2em">
	&nbsp; &nbsp;Make:Nissan<br>
	&nbsp; &nbsp;Model:Leaf-C<br>
	&nbsp; &nbsp;Year:2015<br>
	&nbsp; &nbsp;Milage:5000<br>
	&nbsp; &nbsp;Price:$5,000<br>
	&nbsp; &nbsp;Color:Blue<br>
	</p>

	</div>

	</body>

</html>
