
<?php
//content type must be set to text/plain
header('Content-Type: text/plain');
//exotel sends a HEAD request to verify the headers
if ($_SERVER['REQUEST_METHOD'] == 'HEAD') {
	exit();
}	
//Fetching the GET params
$SmsSid = $_GET["SmsSid"];
$From = $_GET["From"];
$To = $_GET["To"];
$Date = $_GET["Date"];
$Body = $_GET["Body"];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "exotel";
//Create connection

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$sql = sprintf("insert into incomingRegistrationForExotel values ('%s', '%s', '%s', %s, '%s')", $SmsSid, $From, $To, $Date, $Body);

if ($conn->query($sql) === TRUE) {
    echo "Registered for the Exotel session successfully";
} else {
    echo "Some error occured while registering. Please try again later or contact your administrator."; 
}

$conn->close();


?>
