
<?php include('conn.php') ?>



<?php if (isset($_SESSION['message'])): ?>
<div class="alert alert-<?php echo $_SESSION['msg_type']?>">
	<?php
		echo $_SESSION['message'];
		unset($_SESSION['message']);
		?>
	</div>
<?php endif; ?>

<?php if (isset($_SESSION['exists'])): ?>
<?php include('assets/inc/nav.php') ?>

<h1 class="loginhead">Sign Up</h1>

<form enctype="multipart/form-data" class="myform loginform" action="process.php" method="POST">
		<div class="form-group forminput">
			<label>Password</label>
			<input type="password" name="Password"placeholder="Password" class="form-control" required>
		</div>

		<div class="form-group forminput">
			<label>Confirm Password</label>
			<input type="password" name="Password2"placeholder="Confirm Password" class="form-control" required>
		</div>

        <div class="form-group forminput">
			<label>Secret Token</label>
			<input type="text" name="token" placeholder="Secret Token" class="form-control" required>
		</div>
        <input type="submit" name="changepassword" class="loginbutton btn btn-primary" value="Update">	

</form>




<?php include('assets/inc/footer.php') ?>
<?php else: echo "Not Allowed" ?>
<?php endif;?>
