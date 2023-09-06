<?php include('conn.php') ?>



<?php
$pagename = $_SESSION['username'];
?>

<?php
//Connect to the DB

$username = $_SESSION['username'];
$result = $mysqli->query("SELECT * FROM users WHERE idnumber = '$username' ") or die($mysqli->error);
$row = $result->fetch_assoc();
?>

<?php if (isset($_SESSION['success'])): ?>
<?php include('assets/inc/navauth.php') ?>

<div class="dp">
<h1 class="loginhead">Edit Profile</h1>
<form enctype="multipart/form-data" action="process.php" method="POST" class="myform loginform">
		
		<div class="form-group forminput">
			<label>Edit your Bio</label>
			<textarea name="bio" class="form-control"  cols="10" rows="10"><?php echo $row['bio']; ?> </textarea>
		</div>
		<div class="form-group forminput">
			<label>Phone Number</label>
			<input type="text" name="phonenumber" class="form-control" value="<?php echo $row['phonenumber']; ?>">
		</div>

			<br/>
			<a class="btn btn-outline-primary" href="passwordchange.php">Change Password</a>
			<br/>
			<br/>
    <input class="btn btn-primary" type="submit" name="editprofile" value="Update Profile" />
</form>
</div>



	<?php include('assets/inc/footer.php') ?>

	<?php else:
		header("location:signin.php");
		?>

<?php endif; ?>