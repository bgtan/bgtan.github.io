<html>

<head>

	<title>Read Record</title>
	
	<link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
	
</head>

<body>

	<div class = "container">
	
		<div class = "page-header">
			<h1>Read Book Record</h1>
		</div>
		
		<?php
		
		include "Config/Database.php";
		
		$id = isset($_GET["id"]) ? $_GET["id"] : die("Record ID cannot be found.");
				
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
		
		<table class = "table table-hover table-responsive table-bordered">
		
			<tr>
				<td style = 'width:150px' align = "center">Title</td>
				<td><?php echo htmlspecialchars($booktitle, ENT_QUOTES); ?></td>
			</tr>
			
			<tr>
				<td style = 'width:150px' align = "center">Author</td>
				<td><?php echo htmlspecialchars($bookauthor, ENT_QUOTES); ?></td>
			</tr>
			
			<tr>
				<td style = 'width:150px' align = "center">Genres</td>
				<td><?php echo htmlspecialchars($bookgenres, ENT_QUOTES); ?></td>
			</tr>
			
			<tr>
				<td style = 'width:150px' align = "center">Published</td>
				<td><?php echo htmlspecialchars($bookpublished, ENT_QUOTES); ?></td>
			</tr>
			
			<tr>
				<td></td>
				<td align = "right"><a href = "List.php" class = "btn btn-danger">Back to list of books.</a></td>
			</tr>
			
		</table>
		
	</div>
	
<script src = "https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>

</html>