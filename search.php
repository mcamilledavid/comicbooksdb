<?php
$conn = mysqli_connect("localhost", "root", "password");
if (!$conn) {
die("Connection failed.");
}
$sel = mysqli_select_db($conn, "comic_books_db");
if (!$sel) {
die("Selection failed.");
}
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
		<form action="search.php" method="post">
			<input type="text" name="search" id="search-text" placeholder="What are you looking for?" /required>
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
<section id="results">
	<div class="container">
		<div class="content">
			<?php 

			// Check if search bar is empty
			if(empty($_POST['search'])) {
				echo " ";
			} else {
				echo "<h3 class='results-heading'>Search Results</h3>";
				
				// Search function
				if (isset($_POST['search'])) {
					$searchq = $_POST['search'];
$searchq = preg_replace("#[^0-9a-z]#i"," ",$searchq); // searches for pattern

// Search filtering 
switch ($_POST['search-select']) {
// Search by Title
case 'title':
$query = mysqli_query($conn, "SELECT book_id, book_title, issue_number, image, publisher_name FROM Book INNER JOIN Publisher ON Book.publisher_id = Publisher.publisher_id WHERE book_title LIKE '%$searchq%'") or die("Could not search.");
if(mysqli_num_rows($query) == 0) {
	echo "<p style='text-align: center;'>No results found.</p>";
} else {
	$row_cnt = mysqli_num_rows($query);
	echo "<p class='results-text'>Displaying ".$row_cnt." results.</p>";
}
	echo "<table class='cbtable'><tbody>";
	$i = 0;
	while($row = mysqli_fetch_array($query)) {
		$i++;
		if($i % 3 == 1) {
			echo "<tr>";
		}
		$title = $row['book_title'];
		$issue = $row['issue_number'];
		$publisher = $row['publisher_name'];
		$image = $row['image'];
		$id = $row['book_id'];
		$output = "<a href='issue.php?id=".$id."'><img src=".$image." alt='' class='cover'/></a><br>
		<div class='cbbox'><div class='cbissue'>".$issue."</div><div class='cbinfo'>
		<a href='issue.php?id=".$id."'><h3 class='cbtitle'>".$title."</h3></a>
		<h3 class='cbpublisher'>".$publisher."</h3>
		</div></div>";
			echo "<td>".$output."</td>";
		}
		echo "</tbody></table>";
		break;
// Search by Publisher
	case 'publisher':
	$query = mysqli_query($conn, "SELECT book_id, book_title, issue_number, image, publisher_name FROM Book INNER JOIN Publisher ON Book.publisher_id = Publisher.publisher_id WHERE publisher_name LIKE '%$searchq%' ORDER BY book_title ASC") or die("Could not search.");
	if(mysqli_num_rows($query) == 0) {
	echo "<p style='text-align: center;'>No results found.</p>";
} else {
	$row_cnt = mysqli_num_rows($query);
	echo "<p class='results-text'>Displaying ".$row_cnt." results.</p>";
}
	echo "<table class='cbtable'><tbody>";
	$i = 0;
	while($row = mysqli_fetch_array($query)) {
		$i++;
		if($i % 3 == 1) {
			echo "<tr>";
		}
		$title = $row['book_title'];
		$issue = $row['issue_number'];
		$publisher = $row['publisher_name'];
		$image = $row['image'];
		$id = $row['book_id'];
		$output = "<a href='issue.php?id=".$id."'><img src=".$image." alt='' class='cover'/></a><br>
		<div class='cbbox'><div class='cbissue'>".$issue."</div><div class='cbinfo'>
		<a href='issue.php?id=".$id."'><h3 class='cbtitle'>".$title."</h3></a>
		<h3 class='cbpublisher'>".$publisher."</h3>
		</div></div>";
			echo "<td>".$output."</td>";
		}
		echo "</tbody></table>";
		break;
// Search by Character
		case 'character':
		$query = mysqli_query($conn, "SELECT book_id, book_title, issue_number, image, publisher_name FROM Book INNER JOIN Publisher ON Book.publisher_id = Publisher.publisher_id INNER JOIN Characters ON Book.book_id = Characters.book_id INNER JOIN `Character` ON Characters.character_id = `Character`.character_id WHERE `Character`.character_name LIKE '%$searchq%' ORDER BY book_title ASC") or die("Could not search.");
		if(mysqli_num_rows($query) == 0) {
	echo "<p style='text-align: center;'>No results found.</p>";
} else {
	$row_cnt = mysqli_num_rows($query);
	echo "<p class='results-text'>Displaying ".$row_cnt." results.</p>";
}
	echo "<table class='cbtable'><tbody>";
	$i = 0;
	while($row = mysqli_fetch_array($query)) {
		$i++;
		if($i % 3 == 1) {
			echo "<tr>";
		}
		$title = $row['book_title'];
		$issue = $row['issue_number'];
		$publisher = $row['publisher_name'];
		$image = $row['image'];
		$id = $row['book_id'];
		$output = "<a href='issue.php?id=".$id."'><img src=".$image." alt='' class='cover'/></a><br>
		<div class='cbbox'><div class='cbissue'>".$issue."</div><div class='cbinfo'>
		<a href='issue.php?id=".$id."'><h3 class='cbtitle'>".$title."</h3></a>
		<h3 class='cbpublisher'>".$publisher."</h3>
		</div></div>";
			echo "<td>".$output."</td>";
		}
		echo "</tbody></table>";
		break;
// Search by Story
			case 'story':
			$query = mysqli_query($conn, "SELECT book_id, book_title, issue_number, image, publisher_name FROM Book INNER JOIN Publisher ON Book.publisher_id = Publisher.publisher_id INNER JOIN StoryArcs ON Book.book_id = StoryArcs.book_id INNER JOIN Story ON StoryArcs.story_id = Story.story_id WHERE story_title LIKE '%$searchq%' ORDER BY book_title ASC") or die("Could not search.");
			if(mysqli_num_rows($query) == 0) {
	echo "<p style='text-align: center;'>No results found.</p>";
} else {
	$row_cnt = mysqli_num_rows($query);
	echo "<p class='results-text'>Displaying ".$row_cnt." results.</p>";
}
	echo "<table class='cbtable'><tbody>";
	$i = 0;
	while($row = mysqli_fetch_array($query)) {
		$i++;
		if($i % 3 == 1) {
			echo "<tr>";
		}
		$title = $row['book_title'];
		$issue = $row['issue_number'];
		$publisher = $row['publisher_name'];
		$image = $row['image'];
		$id = $row['book_id'];
		$output = "<a href='issue.php?id=".$id."'><img src=".$image." alt='' class='cover'/></a><br>
		<div class='cbbox'><div class='cbissue'>".$issue."</div><div class='cbinfo'>
		<a href='issue.php?id=".$id."'><h3 class='cbtitle'>".$title."</h3></a>
		<h3 class='cbpublisher'>".$publisher."</h3>
		</div></div>";
			echo "<td>".$output."</td>";
		}
		echo "</tbody></table>";
		break;
// Search by Creator
				case 'creator':
				$query = mysqli_query($conn, "SELECT Book.book_id, book_title, issue_number, image, publisher_name FROM Book INNER JOIN Publisher ON Book.publisher_id = Publisher.publisher_id INNER JOIN Creators ON Book.book_id = Creators.book_id INNER JOIN Person ON Creators.person_id = Person.person_id WHERE person_name LIKE '%$searchq%' GROUP BY book_title ORDER BY book_title ASC") or die("Could not search.");
				if(mysqli_num_rows($query) == 0) {
	echo "<p style='text-align: center;'>No results found.</p>";
} else {
	$row_cnt = mysqli_num_rows($query);
	echo "<p class='results-text'>Displaying ".$row_cnt." results.</p>";
}
	echo "<table class='cbtable'><tbody>";
	$i = 0;
	while($row = mysqli_fetch_array($query)) {
		$i++;
		if($i % 3 == 1) {
			echo "<tr>";
		}
		$title = $row['book_title'];
		$issue = $row['issue_number'];
		$publisher = $row['publisher_name'];
		$image = $row['image'];
		$id = $row['book_id'];
		$output = "<a href='issue.php?id=".$id."'><img src=".$image." alt='' class='cover'/></a><br>
		<div class='cbbox'><div class='cbissue'>".$issue."</div><div class='cbinfo'>
		<a href='issue.php?id=".$id."'><h3 class='cbtitle'>".$title."</h3></a>
		<h3 class='cbpublisher'>".$publisher."</h3>
		</div></div>";
			echo "<td>".$output."</td>";
		}
		echo "</tbody></table>";
		break;
				}
			}
		}
		mysqli_close($connection);
		?>        
	</div>
</div>
</section>
</body>
</html>