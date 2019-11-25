<!DOCTYPE html>
<html lang="en">
<head>
	<title>Employee Data</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
	<div class="row">
		<div class="sticky-top flex-grow-1">
			<div class="nav nav-stacked">
				<a href="insert_form.html" class="nav-link">New Entry</a>
				<a href="search.php" class="nav-link">View Entries</a>
			</div>
		</div>
		
		<div class="content col-md-12">
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
			<h1> Welcome! </h1>
			<p> Please use the navbar above to navigate to the data entry or search pages. </p>
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>