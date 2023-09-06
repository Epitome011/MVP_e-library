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
			<h1>Add Administrator</h1>
		</div>
	<div class="form">

	<form action="adminprocess.php" method="POST" class ="loginform">

		<div class="form-group forminput">
			<label>Email</label>
			<input type="email" name="email"placeholder="Email" class="form-control" required>
		</div>

		<div class="form-group forminput">
			<label>Full Name</label>
			<input type="text" name="full-name"placeholder="Full-name" class="form-control" required>
		</div>

		<div class="form-group forminput">
			<label>Username</label>
			<input type="text" name="Username"placeholder="Username" class="form-control" required>
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
			<input type="submit" name="adduser" class="regbutton btn btn-primary" value="Add User">
		</div>


	</form>
	</div>
	</div>
<?php include('assets/inc/footer.php') ?>