<?php
session_start();
?>



<?php if (isset($_SESSION['message'])): ?>
<div class="alert alert-<?php echo $_SESSION['msg_type']?>">
	<?php
		echo $_SESSION['message'];
		unset($_SESSION['message']);
		?>
	</div>
<?php endif; ?>

<?php
$pagename = "Admin";
?>

<?php include('assets/inc/header.php') ?>
	<div class="myform">
		<div class="loginhead">
			<h1> Administrator Sign In</h1>
		</div>
	<div class="form">
		<form action="adminprocess.php" method="POST" class ="loginform">

				<div class="forminput form-group mb-4">
					<label>Username</label>
					<input class="form-control" type="text" name="username"placeholder="Username" required>
				</div>

				<div class="forminput form-group">
					<label>Password</label>
					<input type="password" name="password" placeholder="Password" class=" form-control" required>
				</div>

				<br>
				<br>
			<div class="lower">
					<input type="submit" name="signin" class="loginbutton btn btn-primary" value="Sign In">			
			</div>
		</form>
	</div>
	</div>
<?php include('assets/inc/footer.php') ?>