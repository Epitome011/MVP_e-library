<?php include('conn.php') ?>


<!--Process for Signing In -->

<?php

//Check if the login in button Was clicked
if (isset($_POST['signin'])) {
	$_username = $_POST['IDno'];
	$username = $mysqli->real_escape_string($_username);
	$_password = md5($_POST['password']);
	$password = $mysqli->real_escape_string($_password);
	//Select the row where the username matches the entered username
	$result = $mysqli->query("SELECT password FROM users WHERE idnumber = '$username' ") or die($mysqli->error);
	if ($row=mysqli_fetch_array($result)) {
		//Check if the password matches the data
		if ($password == $row['password']) {
			$_SESSION['username'] = $username;
			$_SESSION['success'] = "Logged In";
			$_SESSION['message'] = "You Are Logged In Succesfully";
			$_SESSION['msg_type'] = "success";
			//Redirect to the admin page
			header("location: index.php");
			exit();
		}else{
			$_SESSION['message'] = "Invalid Password";
			$_SESSION['msg_type'] = "danger";
			header("location: signin.php");

		}

		}else{
			$_SESSION['message'] = "Invalid Username";
			$_SESSION['msg_type'] = "danger";
			header("location: signin.php");
		}
	}
 ?>

<!--Process for Signing Up -->

<?php
//If The register button is clicked
if (isset($_POST['signup'])) {
	$_email= $_POST['email'];
	$email = $mysqli->real_escape_string($_email);

	$_username = $_POST['IDno'];
	$username = $mysqli->real_escape_string($_username);
	$_password = md5($_POST['Password']);
	$password = $mysqli->real_escape_string($_password);
	$_password2 = md5($_POST['Password2']);
	$password2 = $mysqli->real_escape_string($_password2);
//Check if the passwords match
	if ($password === $password2) {
		//select all usernames in the DB and check if the entered username already exist
		$copies = $mysqli->query("SELECT * FROM users WHERE idnumber = '$username' ");

		//select all emails in the DB and check if the entered email already exist
		$emailcopies = $mysqli->query("SELECT * FROM users WHERE email = '$email' ");

		if ($copies->fetch_assoc() == 0 && $emailcopies->fetch_assoc() == 0) {
		//Store the new users details in the DB if the email & username is unique
		$mysqli->query("INSERT INTO users (email, idnumber, password) VALUES('$email', '$username', '$password')") or die($mysqli->error);
			$_SESSION['username'] = $username;
			$_SESSION['success'] = "Logged In";
			$_SESSION['message'] = "You Have been Successfully Registered";
			$_SESSION['msg_type'] = "success";
			header("location: signin.php");
			
	}else {
		$_SESSION['message'] = "ID Number or Email is Taken Try Another";
		$_SESSION['msg_type'] = "danger";
		header("location: signup.php");
		}
	}else {
		$_SESSION['message'] = "Passwords Must Match";
		$_SESSION['msg_type'] = "danger";
		header("location: signup.php");
		}
		
}
?>

<!--Forgot Password-->
<?php

if (isset($_POST['forgot'])) {
	//check if the email exists
    $email = $_POST['email'];
    $user = $mysqli->query("SELECT * FROM users WHERE email = '$email' ");
    if ($user->fetch_assoc() == 0) {
		$_SESSION['message'] = "Email Does not Exist";
		$_SESSION['msg_type'] = "danger";
        header("location: forgot.php");
        	
			
	}else {
		//Generate Token
		$token = random_int(100000, 99999999);
        $_SESSION['exists'] = "Logged In";
		$_SESSION['message'] = "Exists";
		$_SESSION['msg_type'] = "success";
		$_SESSION['email'] = $email;
		//Update token in database
		$mysqli->query("UPDATE users SET passwordToken='$token' WHERE email = '$email' ") or die(mysqli_error($mysqli));
		
		//Send Token To Email
		$mailFrom = "Docsy.com";
		$subject = "Change of Password";
		$emailTo = $email;
    	$headers = "From: " . $mailFrom;
		$txt = "This is You Secret Token" . "\n\n" . "Note: It is only valid for 1hour". "\n\n" . $token;
		//Note check if you can send a link also

		mail($emailTo, $subject, $txt, $headers);

		$_SESSION['message'] = "Email Has Been Sent Check Your Spam Folder if You Do not see it";
		$_SESSION['msg_type'] = "success";
    header("Location: changepassword.php?mailsent");
		}

}

if (isset($_POST['changepassword'])) {
	$email = $_SESSION['email'];
	$_password = md5($_POST['Password']);
	$password = $mysqli->real_escape_string($_password);
	$_password2 = md5($_POST['Password2']);
	$password2 = $mysqli->real_escape_string($_password2);
	$_token = $_POST['token'];
	$token = $mysqli->real_escape_string($_token);

	if ($password === $password2) {
		$user = $mysqli->query("SELECT * FROM users WHERE email = '$email' ");
		$result = $user->fetch_assoc();
		$userToken = $result['passwordToken'];

		if ($token == $userToken && $userToken !== 0) {
			$mysqli->query("UPDATE users SET password = '$password', passwordToken= 0 WHERE email = '$email' ") or die(mysqli_error($mysqli));
			$_SESSION['message'] = 'Password Updated';
			$_SESSION['msg_type'] = 'success';
			unset($_SESSION['success']);
			header("location: signin.php");

		}else{
			$_SESSION['message'] = 'Invalid Token';
			$_SESSION['msg_type'] = 'danger';
			$mysqli->query("UPDATE users SET passwordToken= 0 WHERE email = '$email' ") or die(mysqli_error($mysqli));
			header("location: forgot.php");
		}
	}else{
		$_SESSION['message'] = "Passwords Do not Match";
		$_SESSION['msg_type'] = "danger";
		header("location: changepassword.php");

	}
}

?>

<!-- Update Password -->

<?php

if (isset($_POST['passwordchange'])) {
	$uname = $_SESSION['username'];
	$_oldpassword = md5($_POST['oldpassword']);
	$oldpassword = $mysqli->real_escape_string($_oldpassword);
	$_password = md5($_POST['Password']);
	$password = $mysqli->real_escape_string($_password);
	$_password2 = md5($_POST['Password2']);
	$password2 = $mysqli->real_escape_string($_password2);

	$user = $mysqli->query("SELECT * FROM users WHERE idnumber = '$uname' ");
		$result = $user->fetch_assoc();
		$userpassword = $result['password'];

if($oldpassword == $userpassword){

		if ($password === $password2) {
			
				$mysqli->query("UPDATE users SET password = '$password' WHERE idnumber = '$uname' ") or die(mysqli_error($mysqli));
				$_SESSION['message'] = 'Password Updated';
				$_SESSION['msg_type'] = 'success';
				unset($_SESSION['success']);
				header("location: signin.php");

		}else{
			$_SESSION['message'] = "Passwords Do not Match";
			$_SESSION['msg_type'] = "danger";
			header("location: passwordchange.php");

		}
	}else{
		$_SESSION['message'] = "Old Passwords Does not Match";
			$_SESSION['msg_type'] = "danger";
			header("location: passwordchange.php");
	}
}

?>


<!--Book Uploads-->

<?php
//Check if the publish button is clicked
if (isset($_POST['addbook'])) {
	//Connect to the DB
    $mysqli = new mysqli($hostname, $hostuname, $hostpass, $dbname) or die(mysqli_error($mysqli));

	$file = $_FILES["fileToUpload"]["name"];
	$fileExt = explode('.',$file);
	$ext = strtolower(end($fileExt));
	$name =$file."-".uniqid('', true). "." . $ext;
	$username = $_SESSION['username'];
	$_title = $_POST['title'];
	$title = $mysqli->real_escape_string($_title);
	$_author = $_POST['author'];
	$author = $mysqli->real_escape_string($_author);
	$_category = $_POST['category'];
	$category = $mysqli->real_escape_string($_category);
	$_level = $_POST['level'];
	$level = $mysqli->real_escape_string($_level);
	$approved = 'false';
		

	$target_dir = "uploads/pending/";
	$target_file = $target_dir . basename($name);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			$uploadOk = 1;
		} else {
			$uploadOk = 0;
		}
	}
	// Check if file already exists
	if (file_exists($target_file)) {
			$_SESSION['message'] = "Sorry, file already exists";
			$_SESSION['msg_type'] = "danger";
			header("location: newbook.php");
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 50000000000) {
			$_SESSION['message'] = "Sorry, your file is too large.";
			$_SESSION['msg_type'] = "danger";
			header("location: newbook.php");
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "pdf") {
			$_SESSION['message'] = "Sorry,PDF files are allowed";
			$_SESSION['msg_type'] = "danger";
			header("location: newbook.php");
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
			$_SESSION['message'] = "An Error Occured Uploading Your File";
			$_SESSION['msg_type'] = "danger";
			header("location: newbook.php");
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			
			$mysqli->query("INSERT INTO books (title,idnumber,category,author,level,book, approved) VALUES('$title','$username','$category','$author','$level','$name','$approved')") or die(mysqli_error($mysqli));	
			$_SESSION['message'] = "Enter The Cover For Your Book";
			$_SESSION['bookname'] = $name;
			$_SESSION['msg_type'] = "success";
			header("location: bookthumbnail.php");
		
			} else {
			$_SESSION['message'] = "An Error Occured Uploading Your File";
			$_SESSION['msg_type'] = "danger";
			header("location: newbook.php");
		}
	} 

}


?>
<?php

//Check if the publish button is clicked
if (isset($_POST['addcover'])) {
	//Connect to the DB
    $mysqli = new mysqli($hostname, $hostuname, $hostpass, $dbname) or die(mysqli_error($mysqli));

	$file = $_FILES["fileToUpload"]["name"];
	$fileExt = explode('.',$file);
	$ext = strtolower(end($fileExt));
	$username = $_SESSION['username'];
	$imgname =$file."-".uniqid('', true). "." . $ext;

	$target_dir = "uploads/pending/bookcover/";
	$target_file = $target_dir . basename($imgname);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			$uploadOk = 1;
		} else {
			$uploadOk = 0;
		}
	}
	// Check if file already exists
	if (file_exists($target_file)) {
			$_SESSION['message'] = "Sorry, file already exists";
			$_SESSION['msg_type'] = "danger";
			header("location: bookthumbnail.php");
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 5000000) {
			$_SESSION['message'] = "Sorry, your file is too large.";
			$_SESSION['msg_type'] = "danger";
			header("location: bookthumbnail.php");
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "png" && $imageFileType != "jpg" && $imageFileType != "jpeg") {
			$_SESSION['message'] = "Sorry png, jpg & jpeg files are allowed";
			$_SESSION['msg_type'] = "danger";
			header("location: bookthumbnail.php");
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
			$_SESSION['message'] = "An Error Occured Uploading Your File";
			$_SESSION['msg_type'] = "danger";
			header("location: bookthumbnail.php");
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			$name = $_SESSION['bookname'];
			$mysqli->query("UPDATE books SET thumbnail = '$imgname' WHERE book = '$name' ") or die(mysqli_error($mysqli));	
			$_SESSION['message'] = "Book added For Review";
			$_SESSION['msg_type'] = "success";
			header("location: account.php");
		
			} else {
			$_SESSION['message'] = "Image Could not Be Uploaded";
			$_SESSION['msg_type'] = "danger";
			header("location: bookthumbnail.php");
		}
	}
}

?>

<?php
//Profile Editing

if (isset($_POST['editprofile'])) {
	$mysqli = new mysqli($hostname, $hostuname, $hostpass, $dbname) or die(mysqli_error($mysqli));

	$_bio = $_POST['bio'];
	$bio = $mysqli->real_escape_string($_bio);
	$_phonenumber = $_POST['phonenumber'];
	$phonenumber = $mysqli->real_escape_string($_phonenumber);
	$username  = $_SESSION['username'];
	$mysqli->query("UPDATE users SET bio='$bio', phonenumber='$phonenumber' WHERE username = '$username' ") or die(mysqli_error($mysqli));
	$_SESSION['message'] = "Profile Has Been Updated";
	$_SESSION['msg_type'] = "success";
	header("location: account.php");
}

?>


