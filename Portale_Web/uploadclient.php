<?php
	include "connectdb.php";
	
	//upload privato
	if(isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["cf"]) && isset($_POST["telefonnumber"])){
		if(($_POST["name"])!= "" && ($_POST["surname"])!= "" && ($_POST["cf"])!= "" && ($_POST["telefonnumber"])!= ""){
			$name = $_POST["name"];
			$surname = $_POST["surname"];
			$cf = $_POST["cf"];
			$telefonnumber = $_POST["telefonnumber"];
			$sql = "SELECT CodFiscale FROM privati WHERE CodFiscale = '$cf'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_num_rows($result);
			if($row == 0){
				$sql = "INSERT INTO clienti (Data_registrazione) VALUES (NOW())";
				mysqli_query($conn, $sql);
				$matricola = mysqli_insert_id($conn);
				$sql = "INSERT INTO privati (Nome, Cognome, CodFiscale, NumeroTelefonico, MatricolaPrivato) 
						VALUES ('$name', '$surname', '$cf', '$telefonnumber', '$matricola')";
				
				if(mysqli_query($conn, $sql)){
					header("Location: insert.php?uploaded=".$matricola);
				}
				else{
					header("Location: insert.php?notuploaded");
				}
			}else{
				header("Location: insert.php?errorprivatoid=".$cf);
			}
		}else{
			header("Location: insert.php?fieldrequired");
		}
	}
	
	//upload azienda
	if(isset($_POST["name"]) && isset($_POST["iva"]) && isset($_POST["pec"])){
		if(($_POST["name"])!= "" && ($_POST["iva"])!= "" && ($_POST["pec"])!= ""){
			$name = $_POST["name"];
			$iva = $_POST["iva"];
			$pec = $_POST["pec"];
			$sql = "SELECT PartitaIVA FROM aziende WHERE PartitaIVA = '$iva'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_num_rows($result);
			if($row == 0){
				$sql = "INSERT INTO clienti (Data_registrazione) VALUES (NOW())";
				mysqli_query($conn, $sql);
				$matricola = mysqli_insert_id($conn);
				$sql = "INSERT INTO aziende (NomeAzienda, PartitaIVA, PEC, MatricolaAzienda) 
						VALUES ('$name', '$iva', '$pec', '$matricola')";
				if(mysqli_query($conn, $sql)){
					header("Location: insert.php?uploaded=".$matricola);
				}
				else{
					header("Location: insert.php?notuploaded");
				}
			}else{
				header("Location: insert.php?erroraziendaid=".$iva);
			}
		}else{
			header("Location: insert.php?fieldrequired");
		}
	}
	
	//upload ente pubblico
	if(isset($_POST["name"]) && isset($_POST["id"]) && isset($_POST["locality"]) && isset($_POST["description"])){
		if(($_POST["name"])!= "" && ($_POST["id"])!= "" && ($_POST["locality"])!= "" && ($_POST["description"])!= ""){
			$name = $_POST["name"];
			$id = $_POST["id"];
			$locality = $_POST["locality"];
			$description = $_POST["description"];
			$sql = "SELECT Identificativo FROM entipubblici WHERE Identificativo = $id";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_num_rows($result);
			if($row == 0){
				$sql = "INSERT INTO clienti (Data_registrazione) VALUES (NOW())";
				mysqli_query($conn, $sql);
				$matricola = mysqli_insert_id($conn);
				$sql = "INSERT INTO entipubblici (Nominativo, Identificativo, Località, DescrizioneServizio, MatricolaEnte) 
						VALUES ('$name', '$id', '$locality', '$description', '$matricola')";
				if(mysqli_query($conn, $sql)){
					header("Location: insert.php?uploaded=".$matricola);
				}
				else{
					header("Location: insert.php?notuploaded");
				}
			}else{
				header("Location: insert.php?errorenteid=".$id);
			}
		}else{
			header("Location: insert.php?fieldrequired");
		}
	}
?>