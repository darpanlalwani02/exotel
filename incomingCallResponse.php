<?php
//content type must be set to text/plain
header('Content-Type: text/plain');
//exotel sends a HEAD request to verify the headers
if ($_SERVER['REQUEST_METHOD'] == 'HEAD') {
	exit();
}	
//Fetching the GET params
$SmsSid = $_GET["CallSid"];
$From = $_GET["From"];

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

$sql = "INSERT INTO incomingcall(callSid, FromNo) VALUES ('".$SmsSid."','".$From."')";

if ($conn->query($sql) === TRUE) {
	header("HTTP/1.1 200 OK");
    echo "Registered for the Twilio session successfully";
} else {
	header("HTTP/1.1 501 NOTOK");
    echo "Some error occured while registering"; 
}

$conn->close();
?>