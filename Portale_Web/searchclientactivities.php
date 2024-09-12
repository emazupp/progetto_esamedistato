<?php
	include "connectdb.php";
	session_start();
	$searchbar = $_POST["searchbar"];
	if(isset($_POST['searchclient'])){
		$sql = "SELECT Matricola, Nome, Cognome, CodFiscale, NumeroTelefonico, Data_registrazione 
				FROM allclient WHERE MatricolaPrivato IS NOT NULL";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_num_rows($result);
		if($row >= 1){
			while($row = mysqli_fetch_assoc($result)){
				if($row["Matricola"] == $searchbar){
					$_SESSION["Matricola"] = $row["Matricola"];
					$_SESSION["Nome"] = $row["Nome"];
					$_SESSION["Cognome"] = $row["Cognome"];
					$_SESSION["CodFiscale"] = $row["CodFiscale"];
					$_SESSION["NumeroTelefonico"] = $row["NumeroTelefonico"];
					$_SESSION["Data_registrazione"] = $row["Data_registrazione"];
					header("Location: search.php?values=privato");
					return;
				}
			}
		}

			$sql = "SELECT Matricola, NomeAzienda, PartitaIVA, PEC, Data_registrazione
					FROM allclient WHERE MatricolaAzienda IS NOT NULL";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_num_rows($result);
			if($row >= 1){
				while($row = mysqli_fetch_assoc($result)){
				if($row["Matricola"] == $searchbar){
					$_SESSION["Matricola"] = $row["Matricola"];
					$_SESSION["NomeAzienda"] = $row["NomeAzienda"];
					$_SESSION["PartitaIVA"] = $row["PartitaIVA"];
					$_SESSION["PEC"] = $row["PEC"];
					$_SESSION["Data_registrazione"] = $row["Data_registrazione"];
					header("Location: search.php?values=azienda");
					return;
					}
				}
			}

			$sql = "SELECT Matricola, Nominativo, Identificativo, Località, DescrizioneServizio,
					Data_registrazione FROM allclient WHERE MatricolaEnte IS NOT NULL";
			$result = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_assoc($result)){
				if($row["Matricola"] == $searchbar){
					$_SESSION["Matricola"] = $row["Matricola"];
					$_SESSION["Nominativo"] = $row["Nominativo"];
					$_SESSION["Identificativo"] = $row["Identificativo"];
					$_SESSION["Località"] = $row["Località"];
					$_SESSION["DescrizioneServizio"] = $row["DescrizioneServizio"];
					$_SESSION["Data_registrazione"] = $row["Data_registrazione"];
					header("Location: search.php?values=ente");
					return;
				}
			}
			header("Location: search.php?values=iderrorclient");
			return;
	}
	
	if(isset($_POST["searchactivities"])){
		$sql = "SELECT * FROM attività WHERE ID = $searchbar";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_num_rows($result);
		if($row == 1){
			while($row = mysqli_fetch_assoc($result)){
				if($row["ID"] == $searchbar){
					$_SESSION["ID"] = $row["ID"];
					$_SESSION["Tipo"] = $row["Tipo"];
					$_SESSION["File"] = $row["File"];
					$_SESSION["Matricola"] = $row["Matricola"];
					header("Location: search.php?values=activities");
					return;
				}
			}
		}else{
			header("Location: search.php?values=iderroractivities");
		}
	}
?>