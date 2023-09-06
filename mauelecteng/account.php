<?php include('conn.php') ?>



<?php
$pagename = $_SESSION['username'];
//Connect to the DB


//get username
$username = $_SESSION['username'];

//Get user Table
$result = $mysqli->query("SELECT * FROM users WHERE idnumber = '$username' ") or die($mysqli->error);
$row = $result->fetch_assoc();
?>


<!--Session Messge -->
<?php if (isset($_SESSION['message'])): ?>
<div class="alert alert-<?php echo $_SESSION['msg_type']?>">
	<?php
		echo $_SESSION['message'];
		unset($_SESSION['message']);
		?>
	</div>
<?php endif; ?>



<?php
	//Checking If User is logged in
if (isset($_SESSION['success'])): ?>
<?php include('assets/inc/navauth.php') ?>
<div class="users mb-5">
	<div>
		<br/>
	<h5><?php echo($row['idnumber']); ?></h5>
	<h5><?php echo($row['email']); ?></h5>
	<a class="btn btn-primary mt-4" href="passwordchange.php">Edit Password</a>
	</div>
</div>

<!-- Selecting User Books -->
<?php

$username  = $_SESSION['username'];
$userbooks = $mysqli->query("SELECT * FROM books WHERE idnumber = '$username' ");

//No of results per page
$resultsperpage = 8;

//check for set page
isset($_GET['page']) ? $page =  $_GET['page'] : $page = 0;

//Check if we are on page 1
if ($page > 1) {
	$start = ($page * $resultsperpage) - $resultsperpage;
}else{
	$start = 0;
}

//check for total no of posts
$resultset = $mysqli->query("SELECT id FROM books") or die($mysqli->error);
$numrows = $resultset->num_rows;

//Find the total no of pages needed
$value = ($numrows / $resultsperpage);
$totalpages = ceil ( $value );


$resultset = $mysqli->query("SELECT * FROM books WHERE idnumber = '$username' ORDER BY `date` DESC LIMIT $start, $resultsperpage") or die($mysqli->error);	
?>

<div class="bookdisplay">

<?php
	// Display the Books if Found
while ($book = $resultset->fetch_assoc()):?>
<?php 
	$name = $book['book'];
	$target_dir = "uploads/books/";
	$target_file = $target_dir . basename($name);
?>
<?php  if (file_exists($target_file)):?>
	<div class="mt-5 book">
	<img class="book-cover" src="uploads/books/bookcover/<?php echo $book['thumbnail'];?>">
	<h4><?php echo $book['title'];?></h4>
	
	<h6>Added On <?php echo $book['date'];?></h6>
</div>

<?php else: echo "The Book Titled " . $book['title'] . " is Under Review"?>
<?php endif ?>
	
<?php endwhile; ?>
</div>


<?php include('assets/inc/footer.php') ?>

	<?php else:
	//Re-Direct if User Not Logged in
		header("location:signin.php");
		?>

<?php endif; ?>