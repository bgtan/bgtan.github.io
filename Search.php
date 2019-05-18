<html>

<head>

	<title>Search</title>
	
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
			<h1>Search for a Book Record</h1>
		</div>
		
		<form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method = "post">
	
			<input type = "text" id = "box" name = "keyword" value = "Enter complete book title or complete author name here." class = "form-control"></input>
			<center><br><input type= "submit" name= "search" value= "Search." class = "btn btn-primary"></input>
			<a href = "List.php" class = "btn btn-danger">Back to list of books.</a></center>
		
		</form>
		
		<script type = "text/javascript">
		
		window.onload = function() { 
			
			var submitbutton = document.getElementById("box");
			
			if(submitbutton.addEventListener) {
				submitbutton.addEventListener("click", function() {
					if(submitbutton.value == "Enter complete book title or complete author name here."){
						submitbutton.value = '';
					}
				});
			}
		}
		
		</script>
		
		<?php
				
		if($_POST) {
			
			include "Config/Database.php";

			$keyword = ($_POST["keyword"]);
						
			$query = "SELECT * FROM books WHERE title = '{$keyword}' OR author = '{$keyword}'";
			
			$stmt = $con -> prepare($query);
					
			$stmt -> execute();
		
			$num = $stmt -> rowCount();
					
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
				
				echo "<div class = 'alert alert-danger'>No book records found.</div>";
				
			}
		
		}
		
		?>
			
	</div>
	
<script src = "https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>

</html>