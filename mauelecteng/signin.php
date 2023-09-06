<?php include('conn.php') ?>





<?php if (isset($_SESSION['message'])): ?>
<div class="alert alert-<?php echo $_SESSION['msg_type']?>">
	<?php
		echo $_SESSION['message'];
		unset($_SESSION['message']);
		?>
	</div>
<?php endif; ?>

<?php
$pagename = "Sign In";
?>

<?php include('assets/inc/nav.php') ?>
	<div class="myform">
		<div class="loginhead">
			<h1>Hello Again</h1>
		</div>
	<div class="form">
		<form action="process.php" method="POST" class ="loginform">

				<div class="forminput form-group mb-4">
					<label>ID Number</label>
					<input class="form-control" type="text" name="IDno"placeholder="ID Number" required>
				</div>

				<div class="forminput form-group">
					<label>Password</label>
					<input type="password" name="password" placeholder="Password" class=" form-control" required>
				</div>

				<br>
				<br>
			<div class="lower">
					<input type="submit" name="signin" class="loginbutton btn btn-light" value="Sign In">	

			</div>

			

			<div class="createacc">
				<p>Dont have an Account <a href="signup.php">Sign Up</a></p>
			</div>
		</form>
	</div>
	</div>
<?php include('assets/inc/footer.php') ?>