<!DOCTYPE html>
<html>
	<head>
		<link href="style.css" rel="stylesheet">
		<meta name="viewport" content="user-scalable=no">
	</head>
	<body>
		<div class="main_wrap">
			<div class="title" style="color:white; font-size: 25px;">	
				<h1> Studio <br> Commercialista </h1>
			</div>
			<ul class="navbar">
				<li><a href="index.php">Home</a></li>
				<li><a href="insert.php">Inserimento</a></li>
				<li><a class="active" href="search.php">Ricerca</a></li>
				<li><a href="view.php">Visualizza</a></li>
			</ul>
		

			<div class="text"> 
				<div class="insertbox">
					<div class="firstbox">
						<div id="insert">
							<span style="color:white; font-size: 20px;">Modifica cliente</span>
						</div>
					</div>
						<div class="client1"> 
						<?php
							include "connectdb.php";
							session_start();
							$matricola = $_SESSION["Matricola"];
							
							if(isset($_POST["editprivato"])){
								$sql = "SELECT CodFiscale, Cognome, Nome, NumeroTelefonico FROM privati WHERE MatricolaPrivato = $matricola";
								$result = mysqli_query($conn, $sql);
								$row = mysqli_fetch_assoc($result);
								echo "<form action='editclient.php' method='post'>";
								echo "<p id=\"client2\">";
								echo "Nome: ";
								echo "</br>";
								echo "<input type=\"text\" name=\"name\" size=\"15\" value='".$row['Nome']."'>";
								echo "</br>";
								echo "Cognome: ";
								echo "</br>";
								echo "<input type=\"text\" name=\"surname\" size=\"15\" value='" .$row['Cognome']."'>";
								echo "</br>";
								echo "Codice Fiscale: ";
								echo "</br>";
								echo "<input type=\"text\" name=\"cf\" value='" .$row['CodFiscale']."'>";
								echo "</br>";
								echo "Numero telefonico: ";
								echo "</br>";
								echo "<input type=\"text\" name=\"telefonnumber\" size=\"10\" value='" .$row['NumeroTelefonico']."'>";
								echo "</br>";
								echo "<p id=\"send\">";
								echo "<button id='send2' name='saveprivato'> <img src='send_button.png' width='50' height='50'/> </button>";
								echo "</p>";
								echo "</p>";
								echo "</form>";
							}
							 if(isset($_POST["saveprivato"])){
								 $name = $_POST["name"];
								 $surname = $_POST["surname"];
								 $cf = $_POST["cf"];
								 $telefonnumber = $_POST["telefonnumber"];
								 $sql = "SELECT CodFiscale FROM privati WHERE CodFiscale = '$cf' AND MatricolaPrivato != $matricola";
								 $result = mysqli_query($conn, $sql);
								 $row = mysqli_num_rows($result);
								 if($row == 0){
									 $sql = "UPDATE privati SET Nome = '$name', Cognome = '$surname', 
											 CodFiscale = '$cf', NumeroTelefonico = '$telefonnumber' 
											 WHERE MatricolaPrivato = $matricola";
									 if($result = mysqli_query($conn, $sql)){
										 header("Location: search.php?updated=ok");
									 }else{
										 header("Location: search.php?updated=no");
									 }
								 }else{
									 header("Location: search.php?updated=no");
								 }
							 }
							 
							 if(isset($_POST["editazienda"])){
								$sql = "SELECT PartitaIVA, NomeAzienda, PEC FROM aziende WHERE MatricolaAzienda = $matricola";
								$result = mysqli_query($conn, $sql);
								$row = mysqli_fetch_assoc($result);
								echo "<form action='editclient.php' method='post'>";
								echo "<p id=\"client2\">";
								echo "Nominativo: ";
								echo "</br>";
								echo "<input type=\"text\" name=\"name\" value='" .$row['NomeAzienda']."'>";
								echo "</br>";
								echo "Partita IVA: ";
								echo "</br>";
								echo "<input type=\"text\" name=\"iva\" value='" .$row['PartitaIVA']."'>";
								echo "</br>";
								echo "PEC: ";
								echo "</br>";
								echo "<input type=\"text\" name=\"pec\" size=\"30\" value='" .$row['PEC']."'>";
								echo "</br>";
								echo "<p id=\"send\">";
								echo "<button id='send2' name='saveazienda'> <img src='send_button.png' width='50' height='50'/> </button>";
								echo "</p>";
								echo "</p>";
								echo "</form>";
							 }
							  if(isset($_POST["saveazienda"])){
								 $name = $_POST["name"];
								 $iva = $_POST["iva"];
								 $pec = $_POST["pec"];
								 $sql = "SELECT PartitaIVA FROM aziende WHERE PartitaIVA = '$iva' AND MatricolaAzienda != $matricola";
								 $result = mysqli_query($conn, $sql);
								 $row = mysqli_num_rows($result);
								 if($row == 0){
									 $sql = "UPDATE aziende SET NomeAzienda = '$name', PartitaIVA = '$iva', 
											PEC = '$pec' WHERE MatricolaAzienda = $matricola";
									 if($result = mysqli_query($conn, $sql)){
										 header("Location: search.php?updated=ok");
									 }else{
										 header("Location: search.php?updated=no");
									 }
								 }else{
									  header("Location: search.php?updated=no");
								 }
							 }
							 
							 if(isset($_POST["editente"])){
								$sql = "SELECT Identificativo, Nominativo, DescrizioneServizio, Località FROM entipubblici WHERE MatricolaEnte = $matricola";
								$result = mysqli_query($conn, $sql);
								$row = mysqli_fetch_assoc($result);
								echo "<form action='editclient.php' method='post'>";
								echo "<p id=\"client2\">";
								echo "Nominativo: ";
								echo "</br>";
								echo "<input type=\"text\" name=\"name\" value='" .$row['Nominativo']."'>";
								echo "</br>";
								echo "Identificativo: ";
								echo "</br>";
								echo "<input type=\"text\" name=\"id\" value='" .$row['Identificativo']."'>";
								echo "</br>";
								echo "Localita': ";
								echo "</br>";
								echo "<input type=\"text\" name=\"locality\" size=\"15\" value='" .$row['Località']."'>";
								echo "</br>";
								echo "Descrizione Servizio: ";
								echo "</br>";
								echo "<input type=\"text\" name=\"description\" size=\"30\" value='" .$row['DescrizioneServizio']."'>";
								echo "</br>";
								echo "<p id=\"send\">";
								echo "<button id='send2' name='saveente'> <img src='send_button.png' width='50' height='50'/> </button>";
								echo "</p>";
								echo "</p>";
								echo "</form>";
							 }
							 if(isset($_POST["saveente"])){
								 $name = $_POST["name"];
								 $id = $_POST["id"];
								 $locality = $_POST["locality"];
								 $description = $_POST["description"];
								 $sql = "SELECT Identificativo FROM entipubblici WHERE Identificativo = $id AND MatricolaEnte != $matricola";
								 $result = mysqli_query($conn, $sql);
								 $row = mysqli_num_rows($result);
								 if($row == 0){
									 $sql = "UPDATE entipubblici SET Nominativo = '$name', Identificativo = '$id', 
											 Localita = '$locality', DescrizioneServizio = '$description' 
											 WHERE MatricolaEnte = $matricola";
									 if($result = mysqli_query($conn, $sql)){
										 header("Location: search.php?updated=ok");
									 }else{
										 header("Location: search.php?updated=no");
									 }
								 }else{
									 header("Location: search.php?updated=no");
								 }
							 }
						?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>