<?php include('conn.php') ?>


<?php
$pagename = 'All Books';
//Connect to the DB

?>


<?php include('assets/inc/nav.php') ?>




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

//check for total no of books
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

	//Getting the Books And book Directly
	$name = $book['book'];
	$target_dir = "uploads/books/";
	$target_file = $target_dir . basename($name);
?>
<?php 

	//Display if book exists

if (file_exists($target_file)):?>
	<div class="book">
	<img class="book-cover" src="uploads/books/bookcover/<?php echo $book['thumbnail'];?>">
	<h4><?php echo $book['title'];?></h4>
	<h6>Added On <?php echo $book['date'];?></h6>




	<a class="btn btn-info" href="readbook.php?read=<?php echo $book['id']; ?> ">Read</a>
	

</div>

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
