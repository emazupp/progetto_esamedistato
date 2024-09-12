<?php
	include "connectdb.php";
	$matricola = $_POST["id"];
	$type = $_POST["type"];
	if (isset($_POST['save'])) {
		//controllo se la matricola del cliente passato tramite POST è presente nella tabella clienti
		$sql = "SELECT Matricola FROM clienti WHERE Matricola = '$matricola'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_num_rows($result);
		if($row == 0){
			header("Location: insert.php?id=" .$matricola);
		}
		else{
			//creazione dell'attività per permettere di ricavare l'id attività da poi aggiungere ad inizio nome
			$sql = "INSERT INTO attività (Matricola) VALUES (\"$matricola\")";
			mysqli_query($conn, $sql);
			$id = mysqli_insert_id($conn);
			$filename = $_FILES['myfile']['name'];
			$filename = "$id-" . "$filename";
			//destinazione in cui il file dovrà andare a finire
			$destination = 'C:\xampp\htdocs\uploads\\' . $filename;
			//ricavare l'estensione del file per un successivo controllo
			$extension = pathinfo($filename, PATHINFO_EXTENSION);
			//ricavare il file fisico allocato nella variabile superglobale FILES
			$file = $_FILES['myfile']['tmp_name'];
			$size = $_FILES['myfile']['size'];
			if (!in_array($extension, ['zip', 'pdf', 'docx'])){
				$sql = "DELETE FROM attività WHERE ID = $id";
				mysqli_query($conn, $sql);
				header("Location: insert.php?extension");
			}else{
				if ($_FILES['myfile']['size'] > 10000000) { //limite dimensione file di 10mb
					$sql = "DELETE FROM attività WHERE ID = $id";
					mysqli_query($conn, $sql);
					header("Location: insert.php?larger");
				}else{
					//mettere il file nella sua destinazione
					if (move_uploaded_file($file, $destination)) {
						$sql = "UPDATE attività SET File = '$filename', Tipo = '$type' WHERE ID = '$id'";
						if (mysqli_query($conn, $sql)) {
							//File caricato correttamente
							header("Location: insert.php?ok");
						}
					}else{
						//File non caricato
						header("Location: insert.php?no");
					}
				}
			}
		}
	}
?>

