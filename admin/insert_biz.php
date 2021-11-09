<?php require_once("../include/connect.php"); 
session_start();

if(!isset($_SESSION['admin_log'])){
	redirect('login');
}

$titleError = $ownerError = $primary_contactError = $secondary_contactError = $emailError = $descriptionError = $streetError = $cityError = $stateError = $pincodeError = $imageError = "";

?>
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
				<?php

				if(isset($_POST['insert'])){
					$title = $_POST['title'];
					$owner = $_POST['owner'];
					$primary_contact = $_POST['primary_contact'];
					$secondary_contact = $_POST['secondary_contact'];
					$email = $_POST['email'];
					$category = $_POST['category'];
					$description = $_POST['description'];
					$street = $_POST['street'];
					$city = $_POST['city'];
					$state = $_POST['state'];
					$pincode = $_POST['pincode'];

					if(!preg_match('/^[A-z ]+$/', $title)){
						$titleError = "Please check Title its only contain Aplhabet";
				    }

				    elseif (!preg_match('/^[A-z ]{3,}$/', $owner)) {
				    	$ownerError = "please type valid owner";
				    }

				    elseif(!preg_match('/^[0-9]{10}$/', $primary_contact)){
					    $primary_contactError = "Contact no. must be in 10 digits.";
				    }

				    elseif(!preg_match('/^[0-9]{10}$/', $secondary_contact)) {
				    	$secondary_contactError = "Contact no. must be in 10 digits.";
				    }

				    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				    	$emailError = "please type valid email address";
				    }

				    elseif (!preg_match('/^[A-z 0-9 ]{10,}$/', $description)) {
				    	$descriptionError = "description is too short";
				    }

				    elseif (!preg_match('/^[0-9 A-z]{3,}$/', $street)) {
				    	$streetError = "plesae type valid street";
				    }

				    elseif (!preg_match('/^[A-z]{3,}$/', $city)) {
				    	$cityError ="city must be in a string";
				    }

				    elseif (!preg_match('/^[A-z]{3,}$/', $state)) {
				    	$stateError ="state must be in a string";
				    }

				    elseif (!preg_match('/^[0-9]{6}$/', $pincode)) {
				    	$pincodeError ="PINCODE must be in 6 digits";
				    }

					else{
					//image work

					$image1 = $_FILES['image1']['name'];
					$image2 = $_FILES['image2']['name'];

					$tmp_image1 = $_FILES['image1']['tmp_name'];
					$tmp_image2 = $_FILES['image2']['tmp_name'];

					$allow_extension = array(
						"jpg",
						"png",
						"jpeg"
					);

					$file_extension = pathinfo($image1,PATHINFO_EXTENSION);

					if(!file_exists($tmp_image1)){
						$imageError = "please upload image first";
					}
					elseif(!in_array($file_extension,$allow_extension)){
						$imageError = "This is not a a vlid image file please try another in jpg,png,&jpeg";
					}
					else{


					move_uploaded_file($tmp_image1,"../photo/$image1");
					move_uploaded_file($tmp_image2,"../photo/$image2");

					$query = "INSERT INTO records (title,owner,primary_contact,secondary_contact,email,category,description,street,city,state,pincode,image1,image2)value('$title','$owner','$primary_contact','$secondary_contact','$email','$category','$description','$street','$city','$state','$pincode','$image1','$image2')";

					if(runQuery($query)){
						redirect('biz');
					}
					else{
						echo "fail";
					}
				    }

				}

				}
				?>

				<!-- form-->


				<form action="insert_biz.php" method="post" enctype="multipart/form-data">
					
					<div class="mb-3">
						<label>Title</label>
						<input type="text" name="title" class="form-control" value="<?php if(isset($_POST['insert'])){echo $_POST['title'];}?>">

						<?php
						if($titleError != ""){
							echo "<p class='small text-danger'>$titleError</p>";
					    }
						?>

					</div>
					<div class="mb-3">
						<label>Owner</label>
						<input type="text" name="owner" class="form-control">

						<?php
						if ($ownerError !="") {
							echo "<p class='small text-danger'>$ownerError</p>";
						}
						?>

					</div>
					<div class="row">
						<div class="mb-3 col-6">
						<label>primary_contact</label>
						<input type="text" name="primary_contact" class="form-control">

						<?php
						if ($primary_contactError !="") {
						 	echo "<p class='small text-danger'>$primary_contactError</p>";
						} 
						?>

					</div>
					<div class="mb-3 col-6">
						<label>secondary_contact</label>
						<input type="text" name="secondary_contact" class="form-control">

						<?php
						if ($secondary_contactError !="") {
						 	echo "<p class='small text-danger'>$secondary_contactError</p>";
						} 
						?>
					</div>
					</div>
					<div class="mb-3">
						<label>email</label>
						<input type="text" name="email" class="form-control">

						<?php 
					    if($emailError != ""){
						   echo "<p class='small text-danger'>$emailError</p>";
					    }
					    ?>

					</div>
					<div class="mb-3">
						<label>category</label>
						<select name="category" class="form-control">
							<?php
							$cat_calling = callingquery("select * from categories");
							foreach($cat_calling as $cat):
							?>
							<option value="<?= $cat['cat_id'];?>"><?=$cat['cat_title'];?></option>
						    <?php endforeach;?>
						</select>
					</div>
					<div class="mb-3">
						<label>description</label>
						<textarea rows="5" name="description" class="form-control"></textarea>

						<?php
						if ($descriptionError !="") {
							echo "<p class ='small text-danger'>$descriptionError</p>"; 
						}
						?>
					</div>
					<div class="row">
						<div class="mb-3 col-3">
						<label>street</label>
						<input type="text" name="street" class="form-control">

						<?php
						if ($streetError !="") {
							echo "<p class ='small text-danger'>$streetError</p>";
						}
						?>
					</div>
					<div class="mb-3 col-3">
						<label>city</label>
						<input type="text" name="city" class="form-control">

						<?php
						if ($cityError !="") {
							echo "<p class ='small text-danger'>$cityError</p>";
						}
						?>
					</div>
					<div class="mb-3 col-3">
						<label>state</label>
						<input type="text" name="state" class="form-control">

						<?php
						if ($stateError !="") {
							echo "<p class ='small text-danger'>$stateError</p>";
						}
						?>
					</div>
					<div class="mb-3 col-3">
						<label>pincode</label>
						<input type="text" name="pincode" class="form-control">

						<?php
						if ($pincodeError !="") {
							echo "<p class ='small text-danger'>$pincodeError</p>";
						}
						?>
					</div>
					</div>
					<div class="row">
						<div class="mb-3 col-6">
						<label>image1</label>
						<input type="file" name="image1" class="form-control">
						<?php
						if($imageError !=""){
							echo "<p class ='small text-danger'>$imageError</p>";
						}
						?>
					</div>
					<div class="mb-3 col-6">
						<label>image2</label>
						<input type="file" name="image2" class="form-control">
					</div>
					</div>
					
					<div class="mb-3">
						<input type="submit" name="insert" class="btn btn-success btn-block" >
					</div>

				</form>

				

			</div> 
		</div>
	</div>
</body>
</html>