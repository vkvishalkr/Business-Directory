<?php require_once("../include/connect.php"); 
session_start();

if(isset($_SESSION['admin_log'])){
	redirect('index');
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
			<div class="col-lg-3 mx-auto">
			<form action="login.php" method="post">
				<div class="mb-3">
					<label>Username</label>
					<input type="text" class="form-control" name="username">
				</div>
				<div class="mb-3">
					<label>Password</label>
					<input type="password" class="form-control" name="password">
				</div>
				<div class="mb-3">
					<input type="submit" class="btn btn-success btn-block" value="submit" name="admin_login">
				</div>
				
			</form>		
			</div>	

			<?php
			if(isset($_POST['admin_login'])){
				$username = $_POST['username'];
				$password = $_POST['password'];

				$query = "select * from admin where username='$username' AND password='$password'";
				if(checkquery($query)){
					$_SESSION['admin_log'] = $username;
					redirect('index');
				}
				else{
					echo "fail";
				}
			}
			?>		
        </div>	
	</div>
</body>
</html>