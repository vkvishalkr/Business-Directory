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
				<table class="table table-striped">
					<tr>
						<th>Id</th>
						<th>Title</th>
						<th>Owner</th>
						<th>Contact</th>
						<th>category</th>
						<th>address</th>
						<th>Action</th>
					</tr>

					<?php
					$biz_calling = callingQuery("SELECT * from records");
					foreach($biz_calling as $biz):
				    ?>
				    <tr>
				    	<td><?= $biz['b_id'];?></td>
				    	<td><?= $biz['title'];?></td>
				    	<td><?= $biz['owner'];?></td>
				    	<td><?= $biz['primary_contact'];?></td>
				    	<td><?= $biz['category'];?></td>
				    	<td><?= $biz['street'] . "," . $biz['city'] . "(" . $biz['state'].")" ;?></td>
				    	<td>
							<a href="" class="btn btn-info btn-sm">Edit</a>
							<a href="delete_biz.php?delete_biz=<?=$biz['b_id'];?>" class="btn btn-danger btn-sm">Delete</a>
							<a href="" class="btn btn-success btn-sm">View</a>
						</td>
				    	
				    </tr>
				<?php endforeach;?>
				</table>
			</div> 
		</div>
	</div>
</body>
</html>