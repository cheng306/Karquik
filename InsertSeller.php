
$username=$_POST[username];
$firstname=$_POST[firstname];
$lastname=$_POST[lastname];
$address=$_POST[address];
$city=$_POST[city];
$state=$_POST[state];
$email=$_POST[email];
$phone=$_POST[phone];
$password=$_POST[password];
$confpass=$_POST[confpass];

if($password==$confpass){

$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO Seller (SellerID, Password, Firstname, Lastname, Address, City, State, Email, Phone )
    VALUES ('$username', '$password', '$firstname', '$lastname', '$address', '$city', '$state', '$email', '$phone')";
    

    $conn->exec($sql);
    echo "New user created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;




}