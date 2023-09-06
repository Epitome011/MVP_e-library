<?php include('conn.php') ?>



<?php if (isset($_SESSION['message'])): ?>
<div class="alert alert-<?php echo $_SESSION['msg_type']?>">
	<?php
		echo $_SESSION['message'];
		unset($_SESSION['message']);
		?>
	</div>
<?php endif; ?>

<?php if (isset($_SESSION['success'])): ?>
<?php include('assets/inc/navauth.php') ?>

<h1 class="loginhead">Change Password</h1>

<form enctype="multipart/form-data" class="myform loginform" action="process.php" method="POST">
        <div class="form-group forminput">
			<label>Old Password</label>
			<input type="password" name="oldpassword"placeholder="Old Password" class="form-control" required>
		</div>

		<div class="form-group forminput">
			<label>New Password</label>
			<input type="password" name="Password"placeholder="New Password" class="form-control" required>
		</div>

		<div class="form-group forminput">
			<label>Confirm Password</label>
			<input type="password" name="Password2"placeholder="Confirm Password" class="form-control" required>
		</div>

        <br/>
        <div class="lower">
            <input type="submit" name="passwordchange" class="loginbutton btn btn-primary" value="Update">	
        </div>
</form>




<?php include('assets/inc/footer.php') ?>
<?php else:
		header("location:signin.php");
		?>

<?php endif; ?>