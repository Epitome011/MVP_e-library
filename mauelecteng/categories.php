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



<?php

 if (isset($_GET['category'])){
        $category = $_GET["category"];
        $result = $mysqli->query("SELECT * FROM books WHERE category='$category'")or die(mysql_error($mysqli));
        $numrows = $result->num_rows;
    }
    unset($_SESSION['category']);
?>

            <section class="jumbotron">
            <div class="bookdisplay">
                <?php if ($numrows >=1): ?>
                <?php  while ($book = $result->fetch_assoc()): ?>
   
                    <div class="book">
                        <img class="book-cover" src="uploads/books/bookcover/<?php echo $book['thumbnail'];?>">
                        <h4><?php echo $book['title'];?></h4>
                        <h6>Added On <?php echo $book['date'];?></h6>
                        <a class="btn btn-primary" href="uploads/books/<?php echo $book['book']; ?>" download>Download</a>
	                    <a class="btn btn-info" href="readbook.php?read=<?php echo $book['id']; ?> ">Read</a>
	                </div>

                <?php endwhile; ?>
                <?php else: echo  '<h4 class="bg-danger p-5 m-5 text-warning">SORRY NO RESULTS FOUND FOR '. $category . '</h4>' ?> 
                <?php endif; ?>
            </div>
            </section>

   
            <?php include('assets/inc/footer.php') ?>

<?php else:
    header("location:signin.php");
    ?>

<?php endif; ?>