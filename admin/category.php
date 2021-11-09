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

	<div class="navbar navbar-expand-lg navbar-dark bg-dark">

	<div class="container">
	<a href="" class="navbar-brand">Admin Panel | Find Biz</a>

	<ul class="navbar-nav ml-auto">

		

	<?php
		if(isset($_SESSION['admin_log'])):
		?>
		<li class="nav-item">
			<a href="logout.php" class="btn btn-danger">Logout</a>
		</li>
		<?php else: ?>
		<li class="nav-item">
			<a href="login.php" class="btn btn-danger">Login</a>
		</li>
	<?php endif;?>

	</ul>
    </div>
    </div>

    <div class="container mt-5">
    	<div class="row">
    	<div class="col-lg-3">
			<!-- categories-->
			  <?php include "side.php";?>	
		</div>

		<div class="col-lg-9">
			<div class="row">
				<div class="col-lg-8">
					
					<table class="table table-striped">
						<tr>
							<th>Id</th>
							<th>Title</th>
							<th>Description</th>
							<th>Action</th>
						</tr>
						<?php
						$cat_caling = callingquery("select * from categories");
						foreach($cat_caling as $cat):
						?>
						<tr>
							<td><?= $cat['cat_id'];?></td>
							<td><?= $cat['cat_title'];?></td>
							<td><?= $cat['cat_description'];?></td>
							<td>
								<a href="" class="btn btn-info btn-sm">Edit</a>
								<a href="Category_delete.php?delete_cat=<?= $cat['cat_id'];?>" class="btn btn-danger btn-sm">Delete</a>
							</td>
						</tr>
					<?php endforeach;?>
					</table>
				</div>
				<div class="col-lg-4">
					<form action="category.php" method="post">
						<div class="mb-3">
							<label>Category title</label>
							<input type="text" class="form-control" name="cat_title">
						</div>
						<div class="mb-3">
							<label>Category Description</label>
							<textarea rows="5" class="form-control" name="cat_description"></textarea>
						</div>
						<div class="mb-3">
							
							<input type="submit" class="btn btn-success btn-block" name="cat_insert">
						</div>
					</form>
					<?php

					if(isset($_POST['cat_insert'])){
						$cat_title =$_POST['cat_title'];
						$cat_description =$_POST['cat_description'];
						
						$query = "INSERT INTO categories(cat_title,cat_description) value ('$cat_title','$cat_description')";

						if(runquery($query)){
							redirect('category');
						}
						else "fail";
					}
					?>
				</div>
			</div>

		</div>
	    </div>
    	
    </div>


    </body>
    </html>