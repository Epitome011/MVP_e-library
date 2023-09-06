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
<a href="uploads/profile_photos/<?php echo $row['profilepic'];?>"><img class="profilepicpreview" src="uploads/profile_photos/<?php echo $row['profilepic'];?>"></a>


<form enctype="multipart/form-data" action="process.php" method="POST">
			
			<input type="file" name="fileToUpload" id="fileToUpload">
	<br/>
    <input class="btn btn-primary" type="submit" name="publish" value="Change Photo" />
	</div>
</form>

</div>


	

<?php include('assets/inc/footer.php') ?>

	<?php else:
		header("location:signin.php");
		?>

<?php endif; ?>