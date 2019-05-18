<html>

<head>

    <title>Create a New Record</title>

    <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
          
</head>

<body>

<div class="container">
   
	<div class="page-header">
		<h1>Create New Book Record</h1>
	</div>
	
	<?php
	
	if($_POST) {
		
		include "Config/Database.php";
		
		try {
			
			$query = "INSERT INTO books SET title = :title, author = :author, genres = :genres, published = :published";
			
			$stmt = $con -> prepare($query);
			
			$booktitle = htmlspecialchars(strip_tags($_POST["title"]));
			$bookauthor = htmlspecialchars(strip_tags($_POST["author"]));
			$bookgenres = htmlspecialchars(strip_tags($_POST["genres"]));
			$bookpublished = htmlspecialchars(strip_tags($_POST["published"]));
			
			$stmt -> bindParam(":title", $booktitle);
			$stmt -> bindParam(":author", $bookauthor);
			$stmt -> bindParam(":genres", $bookgenres);
			$stmt -> bindParam(":published", $bookpublished);
			
			if ($stmt -> execute()) {
				
				echo "<div class = 'alert alert-success'>New book record has been created.</div>";
				
			}
			
			else {
				
				echo "<div class = 'alert alert-danger'>Unable to create new record.</div>";
			
			}
			
		}
		
	catch(PDOException $exception) {
		
		die ("Error: " . $exception -> getMessage());
		
	}
	
	}
			
	?>
	
	<form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method = "post">
	
		<table class = "table table-hover table-responsive table-bordered">
		
			<tr>
				<td align = "center">Title</td>
				<td><input type = "text" name = "title" class = "form-control"></input></td>
			</tr>
			
			<tr>
				<td align = "center">Author</td>
				<td><input type = "text" name = "author" class = "form-control"></input></td>
			</tr>
			
			<tr>
				<td align = "center">Genres</td>
				<td><textarea name = "genres" class = "form-control"></textarea></td>
			</tr>
			
			<tr>
				<td align = "center">Published</td>
				<td><input type = "text" name = "published" class = "form-control"></textarea></td>
			</tr>
			
			<tr>
				<td></td>
				<td align = "right">
					<input type = "submit" value = "Save new book record." class = "btn btn-primary"></input>
					<a href = "List.php" class = "btn btn-danger">Back to list of books.</a>
				</td>
			</tr>
		
		</table>
		
	</form>
		
</div>

<script src = "https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>

</html>