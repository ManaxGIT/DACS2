<?php
  session_start();
  $count = 0;
  // connecto database
  
  $title = "Index";
  require_once "./template/header.php";
  require_once "./functions/database_functions.php";
  $conn = db_connect();
  $row = select4Book($conn);
?>
      <div class="jumbotron">
        <div class="container">
          <h1>Welcome to our Bookstore</h1>
          <p class="lead">Have a nice shopping!</p>
          <p>Have a nice day!</p>
        </div>
      </div>
      <!-- Example row of columns -->
      <p class="lead text-center text-muted">Noticeable books</p>
      <div class="row">
        <?php foreach($row as $book) { ?>
      	<div class="col-md-3">
      		<a href="book.php?bookisbn=<?php echo $book['book_isbn']; ?>">
           <img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $book['book_image']; ?>">
          </a>
      	</div>
        <?php } ?>
      </div>
<?php
  if(isset($conn)) {mysqli_close($conn);}
  require_once "./template/footer.php";
?>