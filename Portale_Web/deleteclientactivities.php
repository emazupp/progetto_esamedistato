<?php
	include "connectdb.php";
	session_start();
	$matricola = $_SESSION["Matricola"];
	$id = $_SESSION["ID"];
	
	if(isset($_POST["deleteclient"])){
		$sql = "DELETE FROM clienti WHERE Matricola = $matricola";
		if(mysqli_query($conn, $sql)){
			$sql = "SELECT File FROM attività WHERE Matricola IS NULL";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_num_rows($result);
			if($row >= 1){
				while($row = mysqli_fetch_assoc($result)){
					$filePath = "C:\\xampp\htdocs\\uploads\\" .$row["File"]; 
					if(unlink($filePath)){
						$sql = "DELETE FROM attività WHERE Matricola IS NULL";
						mysqli_query($conn, $sql);
						header("Location: search.php?values=deleted");
					}
				}
			}header("Location: search.php?values=clientdeleted");
		}else{
			header("Location: search.php?values=errordelete");
		}
	}
	
	if(isset($_POST["deleteactivities"])){
		$sql = "SELECT File FROM attività WHERE ID = $id";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$filePath = "C:\\xampp\htdocs\\uploads\\" .$row["File"]; 
		if(unlink($filePath)){
			$sql = "DELETE FROM attività WHERE ID = $id";
			if($result = mysqli_query($conn, $sql)){
				header("Location: search.php?values=activitiesdeleted");
			}else{
				header("Location: search.php?values=errordelete");
			}
		}
		
	}
?>
