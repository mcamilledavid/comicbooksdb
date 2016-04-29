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
  <link href='https://fonts.googleapis.com/css?family=Lato:400,900,700,300,100' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Raleway:400,900italic,900,800italic,800,700italic,700,600italic,500italic,600,100,100italic,200,200italic,300,300italic,400italic,500' rel='stylesheet' type='text/css'>
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
      <h1 class="main-title">Search for your favorite comic books.</h1>
      <form action="search.php" method="post">
        <input type="text" name="search" id="search-text" placeholder="What are you looking for?">
        <select id="search-select" name="search-select">
         <option value="all">All</option>
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
<section id="latest"></section>
<section id="filter">
<div class="container">
<div class="content">
<div class="left-column">
<h3 class="sub-title">Search</h3>
<h3 class="sub-title">Browse</h3>
<h3 class="sub-title">Latest Releases</h3>
</div>
</div>
</div> 
</section>
<footer></footer>
</body>
</html>