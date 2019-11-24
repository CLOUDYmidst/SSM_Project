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

$sql = "SELECT name, email, position, phone, salary, hire_date
FROM " . $tabname ;

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// Create table & headers
	echo "<table>";
	echo "<tr>
	<th>Name</th>
	<th>E-mail</th>
	<th>Position</th>
	<th>Phone Number</th>
	<th>Salary</th>
	<th>Date Hired</th>
	</tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
		echo "<tr>";
        // $row["id"]
		echo "<td>" . $row["name"] ."</td>";
		echo "<td>" . $row["email"] ."</td>";
		echo "<td>" . $row["position"] ."</td>";
		echo "<td>" . $row["phone"] ."</td>";
		echo "<td>" . $row["salary"] ."</td>";
		echo "<td>" . $row["hire_date"] ."</td>";
		echo "</tr>";
    }
	
	// End table tag
	echo "</table>";
} else {
    echo "No results";
}
?>