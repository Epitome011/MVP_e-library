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

<div class="mybody">
		<div class="sidebar">
		<?php include('assets/inc/sidebar.php') ?>
		</div>
		
	<div class="content main">

		<h2>The Administrators</h2>
		<pre><?php superusers(); ?></pre>
		
	</div>
</div>


<?php include('assets/inc/footer.php') ?> 

<?php else: header("location: login.php"); ?>

<?php endif; ?>  