<?php
$pagename = "Home";
?>

<?php
require_once('process.php');
?>



<?php if (isset($_SESSION['message'])): ?>
<div class="alert alert-<?php echo $_SESSION['msg_type']?>">
	<?php
		echo "Welcome"." ".$_SESSION['username']." ".$_SESSION['message'];
		unset($_SESSION['message']);
		?>
	</div>
<?php endif; ?>

<?php if (isset($_SESSION['success'])): ?>
<?php include('assets/inc/navauth.php') ?>
<?php else:include('assets/inc/nav.php')?>
<?php endif; ?>
	<div class="content">
		<div class="jumbotron intro">
			<h2>WELCOME TO</h2>
			<h2>Electrical Engineering Department</h2>
			<h2> E-library</h2>
			<br/>
			<div class="eeeimg">
				<img src="./assets/images/eee.jpeg">
			</div>
			<br/>
			<?php if (isset($_SESSION['success'])): ?>
			<a class="btn btn-info btn-sm" href="allbooks.php"> Start Reading </a>
			<?php else:echo '<a class="btn btn-info" href="signup.php"> Sign Up </a>
			 <a class="btn btn-info" href="signin.php"> Sign In </a>'?>
			<?php endif; ?>
			
		</div>

<div class="jumbotron">
	<h2 class="font-weight-bolder text-center text-light">About the Department</h2>
	<br/>
		<div class="about">
			<h2>ACADEMIC INFORMATION</h2>
				<p>
					Our mission is to train engineers in the fields of electrical and electronics engineering, to acquire scientific and professional skills, and become professionally competent, contributing to national development.
					<br/>
					<br/>
					<br/>
					Our vision is "Technology for Development".
					<br/>
					<br/>
					<br/>
					Our objectives is to produce graduates in Electrical and Electronics Engineering with sound academic background coupled with sufficient practical skills. Such graduates are expected to be resourceful, creative, and able to perform the following functions:
					<br/>
					<br/>
					<br/>
					* To solve practical problems in electrical and electronics engineering by analyses and experimentation.
					<br/>
					* To design, assemble, install, commission and operate electrical and electronic equipment.
					<br/>
					* To prepare quantities and specifications related to electrical and electronic works.
					<br/>
					* To understand and use the basic principles of management applied to engineering industries in general.
				</p>
		</div>
</div>



<?php if (isset($_SESSION['success'])): ?>
	<div class="jumbotron">
		<h2 class="font-weight-bolder text-center text-light">Latest Books</h2>
		<br/>
			<div class="bookdisplay">
			<?php
			
			$userbooks = $mysqli->query("SELECT * FROM books");

				//No of results per page
		$resultsperpage = 4;



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

					<?php while ($book = $resultset->fetch_assoc()):?>
			<?php 
				$name = $book['book'];
				$target_dir = "uploads/books/";
				$target_file = $target_dir . basename($name);
			?>
			<?php  if (file_exists($target_file)):?>
			<div id="allbooks" class="book">
				<img class="book-cover" src="uploads/books/bookcover/<?php echo $book['thumbnail'];?>">
				<h4><?php echo $book['title'];?></h4>
				<h6><?php echo "By " . $book['author'];?></h4>
				<h5><?php echo $book['level'];?></h5>
				<a class="btn btn-primary" href="uploads/books/<?php echo $book['book']; ?>" download>Download</a>
				<a class="btn btn-success" href="readbook.php?read=<?php echo $book['id']; ?>#toolbar=0">Read</a> 
			</div>

			<?php endif ?>
				
			<?php endwhile; ?>
		</div>
	<?php endif; ?>
</div>
<?php include('assets/inc/footer.php') ?>