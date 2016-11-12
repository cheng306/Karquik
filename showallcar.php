<?php
$con=mysql_connect('localhost','root','password');//connect db
if(!$con){die('connect failed ' . mysql_error());}

mysql_select_db('comp380');//select db


$sql="SELECT * FROM Car";
$result=mysql_query($sql);

echo"<table border='1'>
<tr>
<th> ID </th>
<th> price </th>
<th> makes </th>
<th> models </th>
<th> miles </th>
<th> color </th>
<th> year </th>
<th> MPG </th>
<th> location </th>

</tr>";

while($row=mysql_fetch_assoc($result)){
	echo"<tr>";
	echo"<td>" . $row['CarID'] . "</td>";
	echo"<td>" . $row['Price'] . "</td>";
	echo"<td>" . $row['Makes'] . "</td>";
	echo"<td>" . $row['Models'] . "</td>";
	echo"<td>" . $row['Miles'] . "</td>";
	echo"<td>" . $row['Color'] . "</td>";
	echo"<td>" . $row['Year'] . "</td>";
	echo"<td>" . $row['MPG'] . "</td>";
	echo"<td>" . $row['Location'] . "</td>";
	echo"</tr>";
}

echo"</table>";
mysql_close($con);

?>