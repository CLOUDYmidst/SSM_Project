<!DOCTYPE html>
<html lang="en">
<head>
	<title>Employee Data</title>
</head>
<body>

 <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testDB";
$tabname = "EmployeeInfo";

// Attempt initial connection
$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error) {
	
	// Create connection
	$conn = new mysqli($servername, $username, $password);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	// echo "Connected successfully";

	// Create database
	$sql = "CREATE DATABASE " . $dbname;
	
	/*
	if ($conn->query($sql) === TRUE) {
		echo "Database created successfully";
	} else {
		echo "Error creating database: " . $conn->error;
	}
	*/
	$conn->close();
	
	// Reconnect with new database specified
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
}


// Attempt to create table
// Will not create duplicate table if already exists
$sql = "CREATE TABLE ".$tabname." (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(50) NOT NULL,
email VARCHAR(50),
position VARCHAR(30),
phone VARCHAR(20),
salary INT,
hire_date DATE
)";

/*
if ($conn->query($sql) === TRUE) {
    echo "Table EmployeeInfo created successfully";
} else {
	echo "Table creation failed";
}
*/

$conn->close();

?> 

	<a href="insert_form.html">Insert Form</a><br>
	<a href="search.php">View Data</a>
</body>
</html>