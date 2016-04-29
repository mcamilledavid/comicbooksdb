<?php
$conn = mysqli_connect("localhost", "root", "password");
if (!$conn) {
  die("Connection failed.");
}
$sel = mysqli_select_db($conn, "comic_books_db");
if (!$sel) {
  die("Selection failed.");
}
mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="application-name" content="Comic Books Database">
  <meta name="description" content="Comic Books Database">
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
  <title>Comic Books Database</title>
</head>

<body>
<div class="nav">
      <div class="logo">
        <a href="index.php"><img src="imgs/logo-white.png" width="45px" height="45px" /></a>
      </div>
      <div class="browse">
        <a href="browse.php"><button id="browse-button">Browse</button></a>
      </div>
    </div>
  <header>
    <div class="content">
      <form action="search.php" method="post">
        <input type="text" name="search" id="search-text" placeholder="What are you looking for?">
        <select id="search-select" name="search-select">
         <option value="title">Title</option>
         <option value="publisher">Publisher</option>
         <option value="character">Character</option>
         <option value="story">Story</option>
         <option value="creator">Creator</option>
       </select>
       <input type="submit" value=" Search" id="search-button">
     </form>
   </div>
 </header>
 <section>
  <div class="container">
    <div class="content">
 <?php
  $query1 = mysqli_query($conn, "SELECT book_id, book_title, issue_number, image, publisher_name FROM Book INNER JOIN Publisher ON Book.publisher_id =Publisher.publisher_id WHERE book_id LIKE '".$_GET['id']."'") or die("Could not search.");
  while($row = mysqli_fetch_array($query1)) {
    $title = $row['book_title'];
    $issue = $row['issue_number'];
    $publisher = $row['publisher_name'];
    $image = $row['image'];
    $id = $row['book_id'];
    $output = "<img src=".$image." alt='' class='cover'/><br>
    <div class='cbbox'><div class='cbissue'>".$issue."</div><div class='cbinfo'>
    <h3 class='cbtitle'>".$title."</h3>
    <h3 class='cbpublisher'>".$publisher."</h3>
    </div></div>";
      echo $output;
    }
    $query2 = mysqli_query($conn, "SELECT Book.book_id, Person.person_name, Position.position FROM Book JOIN Creators ON Book.book_id = Creators.book_id JOIN Position ON Creators.position_id = Position.position_id JOIN Person ON Creators.person_id = Person.person_id WHERE Book.book_id LIKE '".$_GET['id']."'") or die("Could not search.");
  while($row = mysqli_fetch_array($query2)) {
    $person = $row['person_name'];
    $position = $row['position'];
      echo "<br>".$person."<br>";
      echo $position;
    }
?>
</div>
</div>
</section>
</body>
</html>