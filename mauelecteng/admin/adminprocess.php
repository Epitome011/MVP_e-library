<?php
session_start();

//Connect to the DB

$hostname = 'localhost';
$hostuname = 'annong';
$hostpass = '07067579920';
$dbname = 'docsy';

$mysqli = new mysqli($hostname, $hostuname, $hostpass, $dbname) or die(mysqli_error($mysqli));
//Adding Superusers

//If The register button is clicked
if (isset($_POST['adduser'])) {
	$_email= $_POST['email'];
	$email = $mysqli->real_escape_string($_email);

	$_username = $_POST['Username'];
	$username = $mysqli->real_escape_string($_username);
	$_password = md5($_POST['Password']);
	$password = $mysqli->real_escape_string($_password);
	$_password2 = md5($_POST['Password2']);
	$password2 = $mysqli->real_escape_string($_password2);

	
//Check if the passwords match
	if ($password === $password2) {
		//select all usernames in the DB and check if the entered username already exist
		$copies = $mysqli->query("SELECT * FROM superusers WHERE username = '$username' ");

		//select all emails in the DB and check if the entered email already exist
		$emailcopies = $mysqli->query("SELECT * FROM superusers WHERE email = '$email' ");

		if ($copies->fetch_assoc() == 0 && $emailcopies->fetch_assoc() == 0) {
		//Store the new users details in the DB if the email & username is unique
		$mysqli->query("INSERT INTO superusers ( username, email, password) VALUES('$username', '$email', '$password')") or die($mysqli->error);
			$_SESSION['username'] = $username;
			$_SESSION['connect'] = "Registered";
			$_SESSION['message'] = "You Have been Successfully Registered";
			$_SESSION['msg_type'] = "success";
			header("location: login.php");
			
	}else {
		$_SESSION['message'] = "Username or Email is Taken Try Another";
		$_SESSION['msg_type'] = "danger";
		header("location: addsuperuser.php");
		}
	}else {
		$_SESSION['message'] = "Passwords Must Match";
		$_SESSION['msg_type'] = "danger";
		header("location: addsuperuser.php");
		}
		
}


//Check if the login in button Was clicked
if (isset($_POST['signin'])) {
	$_username = $_POST['username'];
	$username = $mysqli->real_escape_string($_username);
	$_password = md5($_POST['password']);
	$password = $mysqli->real_escape_string($_password);
	//Select the row where the username matches the entered username
	$result = $mysqli->query("SELECT password FROM superusers WHERE username = '$username' ") or die($mysqli->error);
	if ($row=mysqli_fetch_array($result)) {
		//Check if the password matches the data
		if ($password == $row['password']) {
			$_SESSION['admin'] = $username;
			$_SESSION['connect'] = "Logged In";
			$_SESSION['content'] = "You Are Logged In Succesfully";
			$_SESSION['msg_type'] = "success";
			//Redirect to the admin page
			header("location: index.php");
			exit();
		}else{
			$_SESSION['content'] = "Invalid Password";
			$_SESSION['type'] = "danger";
			header("location: login.php");

		}

		}else{
			$_SESSION['content'] = "Invalid Username";
			$_SESSION['type'] = "danger";
			header("location: login.php");
		}
	}


	//Site Basic Metrics


	//Number of Users
	function usernumber()
	 {
		$hostname = 'localhost';
		$hostuname = 'annong';
		$hostpass = '07067579920';
		$dbname = 'docsy';

		$mysqli = new mysqli($hostname, $hostuname, $hostpass, $dbname) or die(mysqli_error($mysqli));
		$users = $mysqli->query("SELECT * FROM users") or die($mysqli->error);
	 	$userno = $users->num_rows;

	 	echo $userno;
	 	} 


	 	//Displaying Superusers
	 	function superusers()
	 {
		$hostname = 'localhost';
		$hostuname = 'annong';
		$hostpass = '07067579920';
		$dbname = 'docsy';		
		$mysqli = new mysqli($hostname, $hostuname, $hostpass, $dbname) or die(mysqli_error($mysqli));
		$users = $mysqli->query("SELECT * FROM superusers") or die($mysqli->error);
				
	 	while ($SuperUser = $users->fetch_assoc()) {
	 		echo "ID" . ":" . $SuperUser['username'] . "\n";
	 		echo "Email" . ":" . $SuperUser['email'] . "\n\n";
	 	}
	 	}

	 	//Number of Books

	function booknumber()
	 {
	 	
		$hostname = 'localhost';
		$hostuname = 'annong';
		$hostpass = '07067579920';
		$dbname = 'docsy';
		$mysqli = new mysqli($hostname, $hostuname, $hostpass, $dbname) or die(mysqli_error($mysqli));
		$books = $mysqli->query("SELECT * FROM books") or die($mysqli->error);
	 	$bookno = $books->num_rows;

	 	echo $bookno;
	 	}

	 	//Number of Books Pending Approval
	 	function pendingbooknumber()
	 {
		$hostname = 'localhost';
		$hostuname = 'annong';
		$hostpass = '07067579920';
		$dbname = 'docsy';	 	
		$mysqli = new mysqli($hostname, $hostuname, $hostpass, $dbname) or die(mysqli_error($mysqli));
		$pendingbooks = $mysqli->query("SELECT * FROM books WHERE approved = 'false'") or die($mysqli->error);
	 	$pendingbookno = $pendingbooks->num_rows;

	 	echo $pendingbookno;
	 	}


?>

<!--Book Approval-->

<?php
	//Displaying pending books

	
$mysqli = new mysqli($hostname, $hostuname, $hostpass, $dbname) or die(mysqli_error($mysqli));
$allpendingbooks = $mysqli->query("SELECT * FROM books WHERE approved = 'false'") or die($mysqli->error);
		$superuser = $_SESSION['admin'];

		 if (isset($_GET['approve'])) {
			$id = $_GET['approve'];
			$date =date('j-n-Y');

			$selectbook = $mysqli->query("SELECT * FROM books WHERE id = '$id'") or die($mysqli->error);
			$book = $selectbook->fetch_assoc();
			$bookfile = $book['book'];
			$imagefile = $book['thumbnail'];

			$target_dir = "../uploads/books/";
			$oldtarget_dir = "../uploads/pending/";
			$target_file = $target_dir . $bookfile;
			$oldtarget = $oldtarget_dir . $bookfile;

			$image_dir = "../uploads/books/bookcover/";
			$oldimage_dir = "../uploads/pending/bookcover/";
			$image_file = $image_dir . $imagefile;
			$oldimage = $oldimage_dir . $imagefile;



			if (copy($oldtarget, $target_file) && copy($oldimage, $image_file) ) {
				$_SESSION['message'] = "Book Approved";
				$_SESSION['msg_type'] = "success";
				$mysqli->query("UPDATE books SET approved ='true' WHERE id = '$id' ") or die(mysqli_error($mysqli));
				unlink($oldimage);
				unlink($oldtarget);
				} else {
				$_SESSION['message'] = "Could Not Be Approved";
				$_SESSION['msg_type'] = "danger";
			}

			
			header('location: pending.php');

			

		} 
		 

?>