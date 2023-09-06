<?php include('assets/inc/header.php') ?>
		
<?php
//Check if the logout button is clicked
if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['username']);
    header("location: signin.php");
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
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Categories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
           <a class="dropdown-item" href="categories.php?category=E-Materials">E-Materials</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="categories.php?category=Past Questions">Past Questions</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="categories.php?category=TextBooks">TextBooks</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="categories.php?category=Lecture Notes">Lecture Notes</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="categories.php?category=Past Projects">Past Projects</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-uppercase" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $_SESSION["username"] ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
           <a class="dropdown-item" href="account.php">Account</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="yourbooks.php">Your Books</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="newbook.php">Add Book</a>
          <div class="dropdown-divider"></div>
          <a href="index.php?logout='1' " class="dropdown-item text-danger">Logout</a>
        </div>
      </li>
    </ul>
    <form class="form-inline search" action="search.php" method="GET">
      <input class="form-control mr-sm-2 searchbar" type="search" placeholder="Search" name="searchword" aria-label="Search">

      <button class="btn btn-success searchbtn form-control my-2 my-sm-0" type="submit" name="search">Search</button>
    </form>
  </div>
  <div class="navbar-brand font-weight-bold brand pl-3" href="#"><img src="./assets/images/naess.jpeg"></div>
</nav>



