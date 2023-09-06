<?php include('assets/inc/header.php') ?>

<?php
//Check if the logout button is clicked
if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['admin']);
    header("location: login.php");
}

?>
			
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="navbar-brand font-weight-bold brand" href="#"><img src="./assets/images/mau.jpeg"></div>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto ml-auto font-weight-bold">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="allbooks.php">All Books</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pending.php">Pending Books</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="addsuperuser.php">Add Admin</a>
      </li>
      <li class="ml-5 signin">
        <a href="index.php?logout='1'" class="btn btn-danger">Logout</a>
      </li>
    </ul>
    <form class="form-inline search">
      <input class="form-control mr-sm-2 searchbar" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success searchbtn form-control my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>



