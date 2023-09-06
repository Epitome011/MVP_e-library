<?php
$pagename = "Home";
?>

<?php
require_once('process.php');
?>



<?php



if (isset($_SESSION['message'])): ?>
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
    <?php  
        if (isset($_GET['read'])) {
            $id = $_GET['read'];
            $thebook = $mysqli->query("SELECT * FROM books WHERE id = $id");
        }
    ?>

    <?php while($book = $thebook->fetch_assoc()): ?>

        <iframe width="100%" height="500px" src="uploads/books/<?php echo $book['book']; ?>#toolbar=0" class="reading"> </iframe>

    <?php endwhile; ?> 
	
	</div>

<?php include('assets/inc/footer.php') ?>