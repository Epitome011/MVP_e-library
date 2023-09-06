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
//Connect to the DB

$username = $_SESSION['username'];
$result = $mysqli->query("SELECT * FROM users WHERE idnumber = '$username' ") or die($mysqli->error);
$row = $result->fetch_assoc();
?>

<?php if (isset($_SESSION['success'])): ?>
<?php include('assets/inc/navauth.php') ?>

<div class="dp">
<h1 class="loginhead">Add a New Book</h1>
<form enctype="multipart/form-data" action="process.php" method="POST" class="myform loginform">
			<div class="form-group forminput">
			<label>Title</label>
			<input type="text" name="title"placeholder="The Book Title" class="form-control" required>
		</div>
		<br/>
		<div class="form-group forminput">
			<label>Category</label>
			<select class="form-control" name="category">
			   	<option>E-Materials</option>
			   	<option>Textbooks</option>
			   	<option>Past Questions</option>
			   	<option>Lecture Notes</option>	
			   	<option>Past Projects</option>
		   </select>
		</div>
		<br>
		<div class="form-group forminput">
			<label>Level</label>
			<select class="form-control" name="level">
				<option>General</option>
			   	<option>100L</option>
			   	<option>200L</option>
			   	<option>300L</option>
			   	<option>400L</option>	
			   	<option>500L</option>
				<option>Masters</option>
		   </select>
		</div>
		<br>
		<div class="form-group forminput">
			<label>Author</label>
			<h6 class="text-danger">Leave empty if there's no Author</h6>
			<input type="text" name="author" placeholder="Author`s Name" class="form-control">
		</div>
		<br>	
			<input type="file" name="fileToUpload" id="fileToUpload" required>
		<br>
    <input class="btn btn-primary mt-4" type="submit" name="addbook" value="Add Book" />
</form>
</div>

	<?php include('assets/inc/footer.php') ?>

	<?php else:
		header("location:signin.php");
		?>

<?php endif; ?>