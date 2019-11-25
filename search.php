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
			<h1> View Employee Data </h1>
			<div class="row">
				<form action="search.php" method="get">
					<div class="form-group">
						<div class="row">
							<div class="col-md-4">
								<label for="search_name">Name:</label>
								<input id="search_name" class="form-control" type="text" name="name" placeholder="Name" 
								<?php
									if(isset($_GET["name"])) echo "value=\"".$_GET["name"]."\"";
								?>>
							</div>
							<div class="col-md-4">
								<label for="search_email">E-mail:</label>
								<input id="search_email" class="form-control" type="email" name="email" placeholder="E-mail"
								<?php
									if(isset($_GET["email"])) echo "value=\"".$_GET["email"]."\"";
								?>>
							</div>
							<div class="col-md-4">
								<label for="search_position">Position:</label>
								<input id="search_position" class="form-control" type="text" name="position" placeholder="Position"
								<?php
									if(isset($_GET["position"])) echo "value=\"".$_GET["position"]."\"";
								?>>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<label for="search_phone">Phone Number:</label>
								<input id="search_phone" class="form-control" type="tel" name="phone" placeholder="Phone Number"
								<?php
									if(isset($_GET["phone"])) echo "value=\"".$_GET["phone"]."\"";
								?>>
							</div>
							<div class="col-md-4">
								<label for="search_salary">Salary:</label>
								<div class="row" id="search_salary">
									<div class="col-md-6">
									<input class="form-control" type="number" name="salary_min" placeholder="Min." min="0"
									<?php
										if(isset($_GET["salary_min"])) echo "value=\"".$_GET["salary_min"]."\"";
									?>> 
									</div>
									<div class="col-md-6">
									<input class="form-control" type="number" name="salary_max" placeholder="Max." min="0"
									<?php
										if(isset($_GET["salary_max"])) echo "value=\"".$_GET["salary_max"]."\"";
									?>>
									</div>
								</div>
							</div>
							<div class="col-md-5">
							<label for="search_date">Date Hired (Range):</label>
								<div class="row" id="search_date">
									<div class="col-md-6">
										<input class="form-control" type="date" name="from_date" 
										<?php
											if(isset($_GET["from_date"])) echo "value=\"".$_GET["from_date"]."\"";
										?>> 
									</div>
									<div class="col-md-6">
										<input class="form-control" type="date" name="to_date" 
										<?php
											if(isset($_GET["to_date"])) echo "value=\"".$_GET["to_date"]."\"";
										?>>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-11"></div>
							<div class="col-md-1">
							<input class="btn btn-primary" type="submit" value="Search">
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-10">
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
	
	$firstCond = true;
	
	// Check for existence all search conditions
	if(isset($_GET["name"])){
		if($_GET["name"] != ""){
			$firstCond = false;
			$sql = $sql . " WHERE name LIKE '%" . $_GET["name"] . "%'";
		}
	}
	if(isset($_GET["email"])){
		if($_GET["email"] != ""){
			if($firstCond){
				$firstCond = false;
				$sql = $sql . " WHERE ";
			}else{
				$sql = $sql . " AND ";
			}
			
			$sql = $sql . "email LIKE '%" . $_GET["email"] . "%'";
		}
	}
	if(isset($_GET["position"])){
		if($_GET["position"] != ""){
			if($firstCond){
				$firstCond = false;
				$sql = $sql . " WHERE ";
			}else{
				$sql = $sql . " AND ";
			}
			
			$sql = $sql . "position LIKE '%" . $_GET["position"] . "%'";
		}
	}
	if(isset($_GET["phone"])){
		if($_GET["phone"] != ""){
			if($firstCond){
				$firstCond = false;
				$sql = $sql . " WHERE ";
			}else{
				$sql = $sql . " AND ";
			}
			
			$sql = $sql . "phone LIKE '%" . $_GET["phone"] . "%'";
		}
	}
	if(isset($_GET["salary_min"])){
		if($_GET["salary_min"] != ""){
			if($firstCond){
				$firstCond = false;
				$sql = $sql . " WHERE ";
			}else{
				$sql = $sql . " AND ";
			}
			
			$sql = $sql . "salary >= " . $_GET["salary_min"];
		}
	}
	if(isset($_GET["salary_max"])){
		if($_GET["salary_max"] != ""){
			if($firstCond){
				$firstCond = false;
				$sql = $sql . " WHERE ";
			}else{
				$sql = $sql . " AND ";
			}
			
			$sql = $sql . "salary <= " . $_GET["salary_max"];
		}
	}
	if(isset($_GET["from_date"])){
		if($_GET["from_date"] != ""){
			if($firstCond){
				$firstCond = false;
				$sql = $sql . " WHERE ";
			}else{
				$sql = $sql . " AND ";
			}
			$sql = $sql . "hire_date >= '" . $_GET["from_date"] . "'";
		}
	}
	if(isset($_GET["to_date"])){
		if($_GET["to_date"] != ""){
			if($firstCond){
				$firstCond = false;
				$sql = $sql . " WHERE ";
			}else{
				$sql = $sql . " AND ";
			}
			
			$sql = $sql . "hire_date <= '" . $_GET["to_date"] . "'";
		}
	}
	
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// Create table & headers
		echo "<table class=\"table\">";
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
				</div>
				<div class="col-md-1"></div>
			</div>
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>