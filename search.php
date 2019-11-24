<!DOCTYPE html>
<html>
<body>
<a href="insert_form.html"><button type="button">Insert New Entry</button></a><br><br><br>

<form action="search.php" method="get">
	Name:<br>
	<input type="text" name="name" placeholder="Name" 
	<?php
		if(isset($_GET["name"])) echo "value=\"".$_GET["name"]."\"";
	?>><br>
	E-mail:<br>
	<input type="email" name="email" placeholder="E-mail"
	<?php
		if(isset($_GET["email"])) echo "value=\"".$_GET["email"]."\"";
	?>><br>
	Position:<br>
	<input type="text" name="position" placeholder="Position"
	<?php
		if(isset($_GET["position"])) echo "value=\"".$_GET["position"]."\"";
	?>><br>
	Phone Number:<br>
	<input type="tel" name="phone" placeholder="Phone Number"
	<?php
		if(isset($_GET["phone"])) echo "value=\"".$_GET["phone"]."\"";
	?>><br>
	Salary:<br>
	Min: <input type="number" name="salary_min" placeholder="Min." min="0"
	<?php
		if(isset($_GET["salary_min"])) echo "value=\"".$_GET["salary_min"]."\"";
	?>> 
	Max: <input type="number" name="salary_max" placeholder="Max." min="0"
	<?php
		if(isset($_GET["salary_max"])) echo "value=\"".$_GET["salary_max"]."\"";
	?>><br>
	Date Hired:<br>
	From:
	<input type="date" name="from_date" 
	<?php
		if(isset($_GET["from_date"])) echo "value=\"".$_GET["from_date"]."\"";
	?>> 
	To:
	<input type="date" name="to_date" 
	<?php
		if(isset($_GET["to_date"])) echo "value=\"".$_GET["to_date"]."\"";
	?>><br><br>
	<input type="submit" value="Search">
</form>
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
</body>
</html>