<?php

include "Config/Database.php";

try {
	
	$id = isset($_GET["id"]) ? $_GET["id"] : die("Error: Record ID cannot be found.");
	
	$query = "DELETE FROM books WHERE id = ?";
	
	$stmt = $con -> prepare($query);
	
	$stmt -> bindParam(1, $id);
	
	if($stmt -> execute()) {
		
		header("Location: List.php?action=deleted");
		
	}
	
	else {
		
		die("Unable to delete book record.");
		
	}

}

catch(PDOException $exception) {
	
	die("Error: " . $exception -> getMessage());
	
}

?>