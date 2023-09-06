<?php
	require_once('adminprocess.php');
?>


<?php if (isset($_SESSION['content'])): ?>
<div class="alert alert-<?php echo $_SESSION['type']?>">
	<?php
		echo "Welcome"." ".$_SESSION['admin']." ".$_SESSION['content'];
		unset($_SESSION['content']);
		?>
	</div>
<?php endif; ?>

<?php if(isset($_SESSION['connect'])): ?>

<?php include('assets/inc/nav.php') ?>

<?php
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $results = $mysqli->query("SELECT * FROM books WHERE id = '$id'") or die($mysqli->error);

$rows = $results->fetch_assoc();
    $path = "../uploads/books/" . $rows['book'];
    $imgpath = "../uploads/books/bookcover/" . $rows['thumbnail'];
    if(!unlink($path)){
        echo "An Error Occured";
    }else{
    	if (!unlink($imgpath)) {
    		 echo "An Error Occured";
    	}else{
    $mysqli->query("DELETE FROM books WHERE id = $id") or die($mysqli->error);
    $_SESSION['message'] = "Book Deleted";
    $_SESSION['msg_type'] = "success";
    header("location: allbooks.php"); }  
    }

}

?>



<!-- Selecting User Books -->
<?php


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


$resultset = $mysqli->query("SELECT * FROM books ORDER BY `date` DESC LIMIT $start, $resultsperpage") or die($mysqli->error);


?>

<div class="bookdisplay">

<?php while ($book = $resultset->fetch_assoc()):?>
<?php 
	$name = $book['book'];
	$target_dir = "../uploads/books/";
	$target_file = $target_dir . basename($name);
?>
<?php  if (file_exists($target_file)):?>
	<div class="book">
	<img class="book-cover" src="../uploads/books/bookcover/<?php echo $book['thumbnail'];?>">
	<h4><?php echo $book['title'];?></h4>
	<h5><?php echo $book['level'];?></h5>
	<h6>Added On <?php echo $book['date'];?></h6>
	<a class="btn btn-primary" href="../uploads/books/<?php echo $book['book']; ?>" download>Download</a>
	<a class="btn btn-success" href="readbook.php?read=<?php echo $book['id']; ?>#toolbar=0">Read</a> 
	<a class="btn btn-danger" href="allbooks.php?delete=<?php echo $book['id'];?>">Delete</a>
</div>

<?php else: echo "The Book Titled " . $book['title'] . " is Under Review"?>
<?php endif ?>
	
<?php endwhile; ?>
</div>

		<?php
		//Display the page lnks
			for ($i=1; $i <= $totalpages; $i++) { 
				echo "<a class='btn btn-primary ml-2' href='?page=$i'>$i</a>";
			}
		
		?>

<?php include('assets/inc/footer.php') ?>

<?php else: header("location: login.php"); ?>

<?php endif; ?>