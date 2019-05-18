<html>

<head>

	<title>Update Book Record</title>
	
	<link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
	
</head>

<body>

	<div class = "container">
	
		<div class = "page-header">
			<h1>Update Book Record</h1>
		</div>
		
		<?php
				
		$id = isset($_GET["id"]) ? $_GET["id"] : die("Record ID cannot be found.");
		
		include "Config/Database.php";
		
		try {
			
			$query = "SELECT id, title, author, genres, published FROM books WHERE id = ? LIMIT 0, 1";
			
			$stmt = $con -> prepare($query);
			
			$stmt -> bindParam(1, $id);
			
			$stmt -> execute();
			
			$row = $stmt -> fetch(PDO::FETCH_ASSOC);
			
			$booktitle = $row["title"];
			$bookauthor = $row["author"];
			$bookgenres = $row["genres"];
			$bookpublished = $row["published"];
			
		}
		
		catch(PDOException $exception) {
			
			die("Error: " . $exception -> getMessage());
			
		}
		
		?>
		
		<?php
		
		if($_POST) {
			
			try {
								
				$query = "UPDATE books SET title = :title, author = :author, genres = :author, published = :published WHERE id = :id";
				
				$stmt = $con -> prepare($query);
				
				$booktitle = ($_POST["title"]);
				$bookauthor = ($_POST["author"]);
				$bookgenres = ($_POST["genres"]);
				$bookpublished = ($_POST["published"]);
				
				$stmt -> bindParam(":title", $booktitle);
				$stmt -> bindParam(":author", $bookauthor);
				$stmt -> bindParam(":genres", $bookgenres);
				$stmt -> bindParam(":published", $bookpublished);
				$stmt -> bindParam(":id", $id);
				
				$stmt -> execute();
				
				if($stmt -> execute()) {
					
					echo "<div class = 'alert alert-success'>Book record was successfully updated.</div>";
					
				}
				
				else {
					
					echo "<div class = 'alert alert-danger'>Failed to update book record.</div>";
					
				}
				
			}
			
			catch(PDOException $exception) {
				
				die("Error: " . $exception -> getMessage());
				
			}
			
		}
		
		?>
		
		<form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?id={$id}'); ?>" method = "post">
		
			<table class = "table table-hover table-responsive table-bordered">
			
				<tr>
					<td>Title</td>
					<td><input type = "text" name = "title" value = "<?php echo htmlspecialchars($booktitle, ENT_QUOTES); ?>" class = "form-control"></input></td>
				</tr>
				
				<tr>
					<td>Author</td>
					<td><input type = "text" name = "author" value = "<?php echo htmlspecialchars($bookauthor, ENT_QUOTES); ?>" class = "form-control"></input></td>
				</tr>
				
				<tr>
					<td>Genres</td>
					<td><textarea name = "genres" class = "form-control"/><?php echo htmlspecialchars($bookgenres, ENT_QUOTES); ?></textarea></td>
				</tr>
				
				<tr>
					<td>Published</td>
					<td><input type = "text" name = "published" value = "<?php echo htmlspecialchars($bookpublished, ENT_QUOTES); ?>" class = "form-control"></input></td>
				</tr>
				
				<tr>
					<td></td>
					<td align = "right">
						<input type = "submit" value = "Save your changes to this record." class = "btn btn-primary"></input>
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