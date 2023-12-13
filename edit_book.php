<?php	
	// if save change happen
	if(!isset($_POST['save_change'])){
		echo "Something wrong!";
		exit;
	}

	$isbn = trim($_POST['isbn']);
	$title = trim($_POST['title']);
	$author = trim($_POST['author']);
	$descr = trim($_POST['descr']);
	$price = floatval(trim($_POST['price']));
	$publisher = trim($_POST['publisher']);

	if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
		$image = $_FILES['image']['name'];
		$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
		$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "bootstrap/img/";
		$uploadDirectory .= $image;
		move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory);
	}

	require_once("./functions/database_functions.php");
	$conn = db_connect();

	// if publisher is not in db, create new
	$publisher = str_replace("'","\'",$publisher);
	$findPub = "SELECT * FROM publisher WHERE publisher_name = '$publisher'";
	// echo $findPub;
	$findResult = mysqli_query($conn, $findPub);
	if(!$findResult){
		// insert into publisher table and return id
		$insertPub = "INSERT INTO publisher(publisher_name) VALUES ('$publisher')";
		$insertResult = mysqli_query($conn, $insertPub);
		if(!$insertResult){
			echo "Can't add new publisher " . mysqli_error($conn);
			exit;
		}
	}


	$query = "UPDATE books SET  
	book_title = '".str_replace("'","\'",$title)."', 
	book_author = '".str_replace("'","\'",$author)."', 
	book_descr = '".str_replace("'","\'",$descr)."', 
	book_price = '".str_replace("'","\'",$price)."'";
	if(isset($image)){
		$query .= ", book_image='".str_replace("'","\'",$image)."'";
	}
	$query .= " WHERE book_isbn = '".str_replace("'","\'",$isbn)."'";
	// two cases for fie , if file submit is on => change a lot
	// echo "<br>".$query;
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Can't update data " . mysqli_error($conn);
		exit;
	} else {
		header("Location: admin_edit.php?bookisbn=$isbn");
	}
?>