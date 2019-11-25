<!DOCTYPE html>
<html>
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
				echo "<p>New record created successfully<br></p>";
				
			} else {
				echo "<p>Record insertion failed.<br>";
				echo "Error: " . $sql . "<br>" . $conn->error . "<br></p>";
				
			}
			echo "<a href=\"insert_form.html\"><button class=\"btn btn-primary\" type=\"button\">Back to Entry Form</button></a>";
			echo "<a href=\"search.php\"><button class=\"btn btn-secondary\" type=\"button\">View Entries</button></a>";
			?> 
		</div>
	</div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>