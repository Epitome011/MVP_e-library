<?php include('conn.php') ?>



<?php if (isset($_SESSION['message'])): ?>
<div class="alert alert-<?php echo $_SESSION['msg_type']?>">
	<?php
		echo $_SESSION['message'];
		unset($_SESSION['message']);
		?>
	</div>
<?php endif; ?>

<?php include('assets/inc/nav.php') ?>

<h1 class="loginhead">Welcome</h1>

<form enctype="multipart/form-data" class="myform loginform" action="process.php" method="POST">
		<div class="form-group forminput">
			<label>Email</label>
			<input type="email" name="email"placeholder="Email" class="form-control" required>
		</div>

		<div class="form-group forminput">
			<label>ID Number</label>
			<input type="text" name="IDno"placeholder="ID Number" class="form-control" required>
		</div>

		<div class="form-group forminput">
			<label>Password</label>
			<input type="password" name="Password"placeholder="Password" class="form-control" required>
		</div>

		<div class="form-group forminput">
			<label>Confirm Password</label>
			<input type="password" name="Password2"placeholder="Confirm Password" class="form-control" required>
		</div>

		<div class="regbutton">
			<input type="submit" name="signup" class="regbutton btn btn-primary" value="Sign up">
		</div>
		<p class="haveaccount">Already Have an Account <a href="signin.php">Sign In</a></p>
</form>




<?php include('assets/inc/footer.php') ?>