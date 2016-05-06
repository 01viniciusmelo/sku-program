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
	<h1>Stock Keeping Dashboard: Add units</h1>
	<p style="color: gray;">Add new SKU's here</p>
	<br>
	
	<div class="row">
		<div class="col-md-4"><a href="overview.php">Overview</a></div>
		<div class="col-md-4"><a href="add.php">Add new unit</a></div>
	
	</div>
	<!-- Add to Inventory -->
		<div class="add_new">
			<div class="row" style="width: 90%; margin: 5%;">
				<div class="col-md-8">
				<?php 
				if (isset($_GET['added']) === true && empty($_GET['added']) === true) {
				echo '<h2 style="color: green;">Added!</h2>';
				} else if (isset($_GET['err1']) === true) {
				echo '<h2 style="color: red;">Name this product</h2>';
				} else if (isset($_GET['err2']) === true) {
				echo '<h2 style="color: red;">Include a SKU number</h2>';
				}
				
				
				
				
				?>
					<div class="panel panel-default" style="background-color: white; border: 0px solid white;">
					<div class="panel-heading" style="background-color: white;"><h2>Enter new unit</h2></div>
					<div class="panel-body">
						<form action="add.php" method="POST">
							<p>Enter unit name</p>
							<input type="text" class="form-control" name="unit_name" placeholder="Blue table cloth" value="<?php if (isset($_POST['unit_name'])) { echo $_POST['unit_name']; }?>"> <br>
							
							<p>Enter SKU number</p>
							<input type="text" class="form-control" name="sku_num" placeholder="123456" value="<?php if (isset($_POST['sku_num'])) { echo $_POST['sku_num']; }?>"> <br>
							
							<p>Retail Price</p>
							<input class="form-control" type="number" name="retail_price" placeholder="100" value="<?php  if (isset($_POST['retail_price'])) { echo $_POST['retail_price']; }?>"> <br>

							<p>Total number of units</p>
							<input type="number" class="form-control" name="total_num" placeholder="50" value="<?php  if (isset($_POST['total_num'])) { echo $_POST['total_num']; }?>"> <br>

							<p>Additional notes</p>
							<textarea class="form-control" name="unit_notes" style="width: 100%;"><?php  if (isset($_POST['unit_notes'])) { echo $_POST['unit_notes']; }?></textarea> <br>
							
							<button class="btn btn-primary" name="submit">Add!</button>
						</form>
						
						<?php
						if (isset($_POST['submit']) === true) {
						
							if (empty($_POST['unit_name']) === true) {
								header('Location: ?err1');
							} else if (empty($_POST['sku_num']) === true) {
								header('Location: ?err2');
							} else {
						
						// Set variables 
							$name = $_POST['unit_name'];
							$sku_num = $_POST['sku_num'];
							$price = $_POST['retail_price'];
							$total_units = $_POST['total_num'];
							$notes = $_POST['unit_notes'];
							
							
						// Submit to database
						$sql = "INSERT INTO `skusystem` (`name`, `sku_number`, `price`, `units`, `notes`) VALUES ('$name', '$sku_num', '$price', '$total_units', '$notes')";
							if ($connect->query($sql) === TRUE) {
								header('Location: ?added');
							}
							
							}
						}
						
										
						?>
					</div>
					</div>
					
				</div>
			</div>
		</div>
		
		
	</div>
	
	
	
	
	
	
	
	
	
	

	
</body>
</html>