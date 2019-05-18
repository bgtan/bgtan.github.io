<html>

<head>

	<title>Database Home</title>
	
	<link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
	
	<style>
	
	.m-r-1em{ margin-right:1em; }
	.m-b-1em{ margin-bottom:1em; }
	.m-l-1em{ margin-left:1em; }
	.mt0{ margin-top:0; }
	
	</style>
	
</head>

<body>

	<div class = "container">
		
		<div class = "page-header">
			<h1>List of Book Records</h1>
		</div>
		
		<?php
		
		include "Config/Database.php";
		
		$action = isset($_GET["action"]) ? $_GET["action"] : "";
		
		if($action == "deleted") {
			
			echo "<div class = 'alert alert-success'>Record was successfully deleted.</div>";
			
		}
		
		$query = "SELECT id, title, author, genres, published FROM books ORDER BY id ASC";
		
		$stmt = $con -> prepare($query);
		
		$stmt -> execute();
		
		$num = $stmt -> rowCount();
		
		echo "<a href = 'Create.php' class = 'btn btn-primary m-b-1em'>Create a new book record.</a>";
		echo " ";
		echo "<a href = 'Search.php' class = 'btn btn-primary m-b-1em'>Search for a book record.</a>";

		if($num > 0) {
			
			echo "<table class = 'table table-hover table-responsive table-bordered'>";
			
				echo "<tr>";
					echo "<th style= 'text-align:center'>ID</th>";
					echo "<th style= 'text-align:center'>Title</th>";
					echo "<th style= 'text-align:center'>Author</th>";
					echo "<th style= 'text-align:center'>Genres</th>";
					echo "<th style= 'text-align:center'>Published</th>";
					echo "<th style= 'text-align:center'>Actions</th>";
				echo "</tr>";
				
				while($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
					
					extract($row);
					
					echo "<tr>";
						echo "<td align = 'center'>{$id}</td>";
						echo "<td style = 'width:325px'>{$title}</td>";
						echo "<td style = 'width:170px'>{$author}</td>";
						echo "<td style = 'width:200px'>{$genres}</td>";
						echo "<td style = 'width:100px' align = 'center'>{$published}</td>";
						echo "<td style = 'width:275px' align = 'center'>";
							echo "<a href = 'Read.php?id={$id}' class = 'btn btn-primary m-r-1em'>READ</a>";
							echo "<a href = 'Update.php?id={$id}' class = 'btn btn-primary m-r-1em'>UPDATE</a>";
							echo "<a href = '#' onclick = 'delete_user({$id});' class = 'btn btn-danger'>DELETE</a>";
						echo "</td>";
					echo "</tr>";
					
				}
				
			echo "</table>";
			
		}
		
		else {
			
			echo "<div class = 'alert alert-danger'>No books found.</div>";
			
		}
		
		?>
		
	</div>
	
<script src = "https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type = "text/javascript">

function delete_user(id) {
	
	var answer = confirm("Are you sure you want to delete this book record?");
	
	if(answer) {
		
		window.location = "delete.php?id=" + id;
		
	}
	
}

</script>

</body>

</html>