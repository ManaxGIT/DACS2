<?php
	session_start();
	if(!isset($_POST['submit'])){
		echo "Something wrong! Check again!";
		exit;
	}
	require_once "./functions/database_functions.php";
	$conn = db_connect();

	$name = trim($_POST['name']);
	$pass = trim($_POST['pass']);

	if($name == "" || $pass == ""){
		echo "Name or Pass is empty!";
		exit;
	}

	$name = mysqli_real_escape_string($conn, $name);
	$pass = mysqli_real_escape_string($conn, $pass);

	// get from db
	$query = "SELECT state FROM admin WHERE name = '$name' AND pass = '$pass'";
	echo $query;
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Empty data " . mysqli_error($conn);
		exit;
	}
	$row = mysqli_fetch_assoc($result);

	if($row['state'] == null) {
		header("Location: admin.php");
	} else {
		$_SESSION['admin'] = $row['state'];
		echo $_SESSION['admin'];
		header("Location: admin_book.php");
	}

	if(isset($conn)) {mysqli_close($conn);}
?>
