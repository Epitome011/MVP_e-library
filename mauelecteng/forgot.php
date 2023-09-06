<?php
require_once('process.php');
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
$pagename = "Sign In";
?>

<?php



?>

<?php include('assets/inc/nav.php') ?>
	<div class="myform">
		<div class="loginhead">
			<h1>Sign In</h1>
		</div>
	<div class="form">
		<form action="process.php" method="POST" class ="loginform">

				<div class="forminput form-group mb-4">
					<label>Email</label>
					<input class="form-control" type="email" name="email"placeholder="Email" required>
				</div>


			<div class="lower">
					<input type="submit" name="forgot" class="loginbutton btn btn-primary" value="Forgot Password">	


			

			<div class="createacc">
				<p>Dont have an Account <a href="signup.php">Sign Up</a></p>
			</div>
		</form>
	</div>
	</div>
<?php include('assets/inc/footer.php') ?>