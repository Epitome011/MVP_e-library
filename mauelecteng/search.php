<?php
$pagename = "Home";
?>

<?php
require_once('process.php');
?>

<?php if (isset($_SESSION['success'])): ?>
<?php include('assets/inc/navauth.php') ?>
<?php else:include('assets/inc/nav.php')?>
<?php endif; ?>


<?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['msg_type']?>">
        <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>
    </div>
<?php endif; ?>


<?php

 if (isset($_GET['search'])){
        


        $keyword = $_GET['searchword'];
        $result = $mysqli->query("SELECT * FROM books WHERE title LIKE '%$keyword%' OR author LIKE '%$keyword%' ")or die(mysql_error($mysqli));
        $numrows = $result->num_rows;
    }
?>

		     
                <?php if ($numrows >=1): ?>
              <?php  while ($book = $result->fetch_assoc()): ?>

                        <section id="allbooks" class="book">
                            <img class="book-cover" src="uploads/books/bookcover/<?php echo $book['thumbnail'];?>">
                            <h4><?php echo $book['title'];?></h4>
                            <h6><?php echo "By " . $book['author'];?></h6>
                            <h5><?php echo $book['level'];?></h5>

                            <a class="btn btn-primary" href="uploads/books/<?php echo $book['book']; ?>" download>Download</a>
			                <a class="btn btn-success" href="readbook.php?read=<?php echo $book['id']; ?>#toolbar=0">Read</a> 
                        </section>

                <?php endwhile; ?>
            <?php else: echo  '<h4 class="bg-danger p-5 m-5 text-warning">SORRY NO RESULTS FOUND FOR '. $keyword . '</h4>' ?> 
            <?php endif; ?>

   
       
<?php include('assets/inc/footer.php') ?>