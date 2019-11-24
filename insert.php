<!DOCTYPE html>
<html>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testDB";
$tabname = "EmployeeInfo";

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error) {
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
}

$sql = "INSERT INTO " . $tabname . 
" (name, email, position, phone, salary, hire_date)
VALUES ('" . $_POST["name"] . "', '" . $_POST["email"] . "', '" 
. $_POST["position"] . "', '" . $_POST["phone"] . "', " 
. $_POST["salary"] . ", '" . $_POST["hire_date"] . "')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully<br>";
	echo "<a href=\"insert_form.html\"><button type=\"button\">Back to Entry Form</button></a>";
	
} else {
	echo "Record insertion failed.<br>";
    echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
	echo "<a href=\"insert_form.html\"><button type=\"button\">Back to Entry Form</button></a>";
}

echo "<a href=\"search.php\"><button type=\"button\">View Entries</button></a>";
?> 

</body>
</html>