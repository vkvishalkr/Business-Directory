<?php require_once("include/connect.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Find Biz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
	<?php include_once("include/navbar.php");?>
	<div class="container mt-5">
		<div class="row">
			<div class="col-lg-3">
			<!-- categories-->
			   <?php include "side.php";?>
			</div>

			<div class="col-lg-9">
				<!-- business list-->

				<div class="row">
					<?php

					if (isset($_GET['biz_id'])) {
						$id = $_GET['biz_id'];
					$calling =callingQuery("SELECT * FROM records JOIN categories ON records.category = categories.cat_id WHERE records.b_id='$id'");
					foreach($calling as $data);
					?>
					<div class="col-lg-12">
						<div class="row">
								 <div class="col-lg-12">
								    <h4 class="text-uppercase font-weight-bolder"><?= $data['title'];?></h4>
								 </div>
							</div>
						<div class="card mb-2 bg-light">	
							<div class="row">
								<div class="col-lg-4">
									<!-- carasouel here-->
									<img src="photo/<?=$data['image1'];?>" class="w-100" style = "object-fit: cover;height: 260px;">
								</div>
								<div class="col-lg-8">
									<table class="table table-striped">
										<tr>
											<td>Category</td>
											<td><?= $data['cat_title'];?></td>
										</tr>
									    <tr>
											<td>Contact</td>
											<td><?= $data['primary_contact'];?></td>
										</tr>
										<tr>
											<td>Secondary Contact</td>
											<td><?= $data['secondary_contact'];?></td>
										</tr>
										<tr>
											<td>E-mail</td>
											<td><?= $data['email'];?></td>
										</tr>
										<tr>
											<td>Address</td>
											<td><?= $data['street'] . ", " . $data['city'] . " (". $data['state'] . ")";?></td>
										</tr>
										<tr>
											<td>Pin code</td>
											<td><?= $data['pincode'];?></td>
										</tr>
									</table>
								</div>
							</div>
							    <div class="row">
							    	<div class="col-lg-12">
							    		<div class="card border-primary">
							    		<div class="card-header bg-primary text-white">Description</div>
							    		<div class="card-body">
							    		<p class="small text-justify"><?= $data['description'];?></p>
							    		</div>
							    	</div>
							    	</div>
							    </div>
								
						</div>
					</div>
				    <?php }?>
				</div>

				  <!-- related business-->

					<div class="row">
						<div class="col-lg-12">
							<h2>Related business</h2>
						</div>
					<?php

					$id = $_GET['biz_id'];
					

						$calling =callingQuery("SELECT * FROM records JOIN categories ON records.category = categories.cat_id where records.b_id !='$id'");

					
					foreach($calling as $data):

					?>
					<div class="col-lg-6">
						<div class="card mb-2 bg-light">
							<div class="row">
								<div class="col-lg-4">
									<img src="photo/<?=$data['image1'];?>" class="w-100" style = "object-fit: cover;height: 220px;">
								</div>
								<div class="col-lg-8">
									<div class="card-body">
								    <h5 class="text-uppercase text-truncate"><?=$data['title'];?></h5>
								    <span class="badge bg-primary"><?= $data['cat_title'];?></span>
								    <p class="small text-justify"><?= substr($data['description'],0,150,);?></p>
								    <h5 class="text-muted float-left"><?php echo $data['primary_contact']; if($data['secondary_contact']!=''){echo ", " .$data['secondary_contact'];}?></h5>
								    
								    <div class="clearfix"></div>
								    <a href="biz.php?biz_id=<?=$data['b_id'];?>" class="btn btn-success float-right">Read More</a>
							        </div>
								</div>
							</div>
								
						</div>
					</div>
				    <?php endforeach;?>
				</div>
			</div>
					
        </div>	
	</div>
</body>
</html>