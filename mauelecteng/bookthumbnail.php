<?php include('conn.php') ?>



<?php
$pagename = $_SESSION['username'];
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
//Connect to the DB

$username = $_SESSION['username'];
$result = $mysqli->query("SELECT * FROM users WHERE idnumber = '$username' ") or die($mysqli->error);
$row = $result->fetch_assoc();
?>

<?php if (isset($_SESSION['success'])): ?>
<?php include('assets/inc/navauth.php') ?>

<div class="dp">
<h1 class="loginhead">Upload Your Book Cover</h1>
<form enctype="multipart/form-data" action="process.php" method="POST" class="myform loginform">
		
		<div class="form-group forminput">
			<label><strong>Select An Image For The Cover of Your Book</strong></label>
			<hr/>
			<input type="file" name="fileToUpload" id="fileToUpload" required>
		<br/>
		<hr/>
    <input class="btn btn-primary" type="submit" name="addcover" value="Add Cover" />
		</div>
		
</form>
</div>



	<?php include('assets/inc/footer.php') ?>

	<?php else:
		header("location:signin.php");
		?>

<?php endif; ?>