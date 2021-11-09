<?php require_once("../include/connect.php"); 
session_start();

if(!isset($_SESSION['admin_log'])){
	redirect('login');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Find Biz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>

	<?php include "nav.php";?>

	<div class="container mt-5">
		<div class="row">
			<div class="col-lg-3">
			<!-- categories-->
			   <?php include "side.php";?>	
			</div>

			<div class="col-lg-9">
				<div class="bg-light text-dark p-5 rounded">
					<h2 class="mb-4">Welcome in Biz finder! Admin panel!</h2>

					<a href="insert_biz.php" class="btn btn-success btn-lg">Insert Business Record</a>
					<a href="category.php" class="btn btn-warning btn-lg">Insert Categories</a>
				</div>

			</div>

					
        </div>	
	</div>
	

</body>
</html>