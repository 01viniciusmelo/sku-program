  <?php
 /* 
 Created by Harman Kang
 May 5th, 2016
 
 */
 
 // connect to database 

 /* enter your details here */
$servername = "";
$username = "";
$password = "";
$database = ""; */

	// create the connection
	$connect = mysqli_connect($servername, $username, $password, $database);
	
	// disable connection if error occurs
	if (!$connect) {
		die("The connection could not be established: " . mysqli_connect_error());
	}
	
?>



<html>
<head>
	<title>Stock Keeping System - Demo</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../jumbovelvet/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>

	
	<div class="container-fluid" style="width: 90%; margin: 0 auto;">
	<h1>Stock Keeping Dashboard: Overview</h1>
	<p style="color: gray;">Get an overview of your inventory</p>
	<br>
	<!-- Minified Menu -->
	<div class="row">
		<div class="col-md-4"><a href="overview.php">Overview</a></div>
		<div class="col-md-4"><a href="add.php">Add new unit</a></div>
		
	</div>
	<Br><Br>
	<div class="row">
		<div class="col-lg-8">
			<div class="panel panel-default">
			<div class="panel-heading">
			Inventory List
			</div>
			<div class="panel-body">
			<ul class="list-group" style="height: 400px; overflow-y: scroll;">
				<?php 
				// FIND ALL ROWS
				$sql = "SELECT * FROM `skusystem`";
				$result = $connect->query($sql);
				
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
					?>
						
							<li class="list-group-item">
							<div class="row">
								<div class="col-md-12"><h3><?php echo $row['name']; ?></h3></div>
							</div>
							<br>
							<div class="row"><div class="col-md-4"><b>SKU:</b> <?php echo $row['sku_number']; ?></div></div>
							<div class="row"><div class="col-md-4"><b>Price:</b> $<?php echo $row['price']; ?> per unit</div></div>
							<div class="row"><div class="col-md-4"><b>Units:</b> <?php echo $row['units']; ?></div></div>
							<div class="row"><div class="col-md-4"><b>Total value:</b> $<?php echo $row['units'] * $row['price']; ?></div></div>
							
							<br>
							<div class="row">
								<div class="col-md-12">
								<b>Additional Notes:</b><br> 
								<?php echo nl2br($row['notes']); ?></div>
							</div>
							</li>
					
					<?php
					}
				}
				?>
				</ul>
			</div>			
			</div>
		</div>
		
		
		<div class="col-lg-4">
			<div class="panel panel-default">
			<div class="panel-heading">
			Details
			</div>
			<div class="panel-body">
				
				<p>SKUs in inventory: <b><?php $sql = "SELECT * FROM `skusystem`"; if ($result = mysqli_query($connect, $sql)) {$rowCount = mysqli_num_rows($result); printf($rowCount);} ?> </b></p>
				<p>Total units (all SKUs): <b><?php 				$sql = "SELECT SUM(units) FROM skusystem"; $result = mysqli_query($connect, $sql); while($row = $result->fetch_assoc()) {echo $row['SUM(units)'];}
 ?></b></p>
				<p>Value of inventory: <b>$<?php $sql = "SELECT SUM(units*price) FROM skusystem"; 
				$result = mysqli_query($connect, $sql); 
				while($row = $result->fetch_assoc()) {echo $row['SUM(units*price)'];} ?></b> </p>
			</div>			
			</div>
		</div>
	</div>
		
	</div>

</body>
</html> 