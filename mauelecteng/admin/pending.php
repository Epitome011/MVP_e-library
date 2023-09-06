<?php
$pagename = "Admin Dashboard";
?>

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



<div class="bookdisplay">
	<?php while ($pending = $allpendingbooks->fetch_assoc()): ?>
		<div class="pending">	
			<div class="cover">
				<img src="../uploads/pending/bookcover/<?php echo $pending['thumbnail']; ?>">
			</div>
			<div class="title">
				<?php echo $pending['title']; ?>
			</div>
			<div class="thebook">
				<a href="../uploads/pending/<?php echo $pending['book']; ?>" class="btn btn-info"> Read</a>
				<a href="adminprocess.php?approve=<?php echo $pending['id']; ?>" class="btn btn-success"> Approve</a> 
			</div>
		</div>
		<br/>
	<?php endwhile; ?>
</div>

<?php else: header("location: login.php"); ?>

<?php endif; ?>
<?php include('assets/inc/footer.php') ?>   