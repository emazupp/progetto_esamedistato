<!DOCTYPE html>
<html>
	<head>
		<link href="style.css" rel="stylesheet">
		<meta name="viewport" content="user-scalable=no">
	</head>
	<body>
		<div class="main_wrap">
			<div class="title" style="color:white; font-size: 25px;">	
				<h1> Studio <br>Commercialista </h1>
			</div>
			<ul class="navbar">
				<li><a href="index.php">Home</a></li>
				<li><a href="insert.php">Inserimento</a></li>
				<li><a class="active" href="search.php">Ricerca</a></li>
				<li><a href="view.php">Visualizza</a></li>
			</ul>

			<div class="text"> 
			<form action="searchclientactivities.php" method="post">
				<div id="searchbox">
					<span id="searchtext"> Ricerca cliente per ID </span>
					<input type="textbox" name="searchbar" id="searchbar" required>
					<div id="searchbutton">
						<button id="sendactivities" name="searchclient"> <img src="send_button.png" width="50" height="50"/> </button>
					</div>
				</div>
			</form>
			<form action="searchclientactivities.php" method="post">
				<div id="searchbox">
					<span id="searchtext"> Ricerca attività per ID </span>
					<input type="textbox" name="searchbar" id="searchbar" required>
					<div id="searchbutton">
						<button id="sendactivities" name="searchactivities"> <img src="send_button.png" width="50" height="50"/> </button>
					</div>
				</div>
			</form>
				<?php
					include "connectdb.php";
					if(isset($_GET["values"])){
						session_start();
						
						//ricerca ed elimina privato azienda ed ente
						
						if($_GET["values"] == "privato") {
							echo "<table>";
								echo "<tr>";
									echo "<td>";
										echo "<form action=\"deleteclientactivities.php\" method='post'>";
											echo "<button id='deletebutton' name='deleteclient' 
												  onClick=\"return confirm('Vuoi davvero eliminare questo cliente? Così facendo eliminerai anche le attività relative ad esso.')\"> 
												  <img src='delete_button.png' width='30' height='30'/> </button>";
										echo "</form>";
									echo "</td>";
									echo "<th> Matricola </th>";
									echo "<th> Nome </th>";
									echo "<th> Cognome </th>";
									echo "<th> Codice Fiscale </th>";
									echo "<th> Numero Telefonico </th>";
									echo "<th> Data registrazione </th>";
									echo "<th> Tipo </th>";
									echo "<th> Attività </th>";
								echo "</tr>";
								echo "<tr>";
									echo "<td>";
										echo "<form action=\"editclient.php\" method='post'>";
											echo "<button id='editbutton' name='editprivato'> 
												  <img src='edit_button.png' width='30' height='30'/> </button>";
										echo "</form>";
									echo "</td>";
									echo "<td>".$_SESSION['Matricola']."</td>";
									echo "<td>".$_SESSION['Nome']."</td>";
									echo "<td>".$_SESSION['Cognome']."</td>";
									echo "<td>".$_SESSION['CodFiscale']."</td>";
									echo "<td>".$_SESSION['NumeroTelefonico']."</td>";
									echo "<td>".$_SESSION['Data_registrazione']."</td>";
									echo "<td> Privato </td>";
									echo "<td>";
										echo "<a href=\"search.php?idprivato=".$_SESSION['Matricola']."\"> Clicca qui </a>";
									echo "</td>";
							echo "</table>";
						}
						
						if($_GET["values"] == "azienda") {
							echo "<table>";
								echo "<tr>";
									echo "<td>";
										echo "<form action=\"deleteclientactivities.php\" method='post'>";
											echo "<button id='deletebutton' name='deleteclient' 
												  onClick=\"return confirm('Vuoi davvero eliminare questo cliente? Così facendo eliminerai anche le attività relative ad esso.')\"> 
												  <img src='delete_button.png' width='30' height='30'/> </button>";
										echo "</form>";
									echo "</td>";
									echo "<th> Matricola </th>";
									echo "<th> Nome Azienda </th>";
									echo "<th> Partita IVA </th>";
									echo "<th> PEC </th>";
									echo "<th> Data registrazione </th>";
									echo "<th> Tipo </th>";
									echo "<th> Attività </th>";
								echo "</tr>";
								echo "<tr>";
									echo "<td>";
										echo "<form action=\"editclient.php\" method='post'>";
											echo "<button id='editbutton' name='editazienda'> <img src='edit_button.png' width='30' height='30'/> </button>";
										echo "</form>";
									echo "</td>";
									echo "<td>".$_SESSION['Matricola']."</td>";
									echo "<td>".$_SESSION['NomeAzienda']."</td>";
									echo "<td>".$_SESSION['PartitaIVA']."</td>";
									echo "<td>".$_SESSION['PEC']."</td>";
									echo "<td>".$_SESSION['Data_registrazione']."</td>";
									echo "<td> Azienda </td>";
									echo "<td>";
										echo "<a href=\"search.php?idazienda=".$_SESSION['Matricola']."\"> Clicca qui </a>";
									echo "</td>";
							echo "</table>";
						}
						
						if($_GET["values"] == "ente") {
							echo "<table>";
								echo "<tr>";
									echo "<td>";
										echo "<form action=\"deleteclientactivities.php\" method='post'>";
											echo "<button id='deletebutton' name='deleteclient' 
												  onClick=\"return confirm('Vuoi davvero eliminare questo cliente? Così facendo eliminerai anche le attività relative ad esso.')\"> 
												  <img src='delete_button.png' width='30' height='30'/> </button>";
										echo "</form>";
									echo "</td>";
									echo "<th> Matricola </th>";
									echo "<th> Nominativo </th>";
									echo "<th> Identificativo </th>";
									echo "<th> Località </th>";
									echo "<th> Descrizione Servizio </th>";
									echo "<th> Data registrazione </th>";
									echo "<th> Tipo </th>";
									echo "<th> Attività </th>";
								echo "</tr>";
								echo "<tr>";
									echo "<td>";
										echo "<form action=\"editclient.php\" method='post'>";
											echo "<button id='editbutton' name='editente'> <img src='edit_button.png' width='30' height='30'/> </button>";
										echo "</form>";
									echo "</td>";
									echo "<td>".$_SESSION['Matricola']."</td>";
									echo "<td>".$_SESSION['Nominativo']."</td>";
									echo "<td>".$_SESSION['Identificativo']."</td>";
									echo "<td>".$_SESSION['Località']."</td>";
									echo "<td>".$_SESSION['DescrizioneServizio']."</td>";
									echo "<td>".$_SESSION['Data_registrazione']."</td>";
									echo "<td> Ente pubblico </td>";
									echo "<td>";
										echo "<a href=\"search.php?idente=".$_SESSION['Matricola']."\"> Clicca qui </a>";
									echo "</td>";
							echo "</table>";
						}
						
						if(($_GET["values"]) == "iderrorclient"){
							echo "<div id='iderror'> Nessun cliente trovato </div>";
						}
						
						//ricerca ed elimina attività
						
						if($_GET["values"] == "activities") {
							echo "<table>";
								echo "<tr>";
									echo "<td>";
										echo "<form action=\"deleteclientactivities.php\" method='post'>";
											echo "<button id='deletebutton' name='deleteactivities' 
												  onClick=\"return confirm('Vuoi davvero eliminare questa attività?')\"> 
												  <img src='delete_button.png' width='30' height='30'/> </button>";
										echo "</form>";
									echo "</td>";
									echo "<th> ID </th>";
									echo "<th> Tipo </th>";
									echo "<th> File </th>";
									echo "<th> ID Cliente </th>";
								echo "</tr>";
								echo "<tr>";
									echo "<td> </td>";
									echo "<td>".$_SESSION['ID']."</td>";
									echo "<td>".$_SESSION['Tipo']."</td>";
									echo "<td>";
										echo "<a href=\"/uploads/" .$_SESSION['File']."\" download> Download File </a>";
									echo "</td>";
									echo "<td>".$_SESSION['Matricola']."</td>";
							echo "</table>";
						}
						
						if(($_GET["values"]) == "iderroractivities"){
							echo "<div id='iderror'> Nessuna attività trovata </div>";
						}
						
						//eliminazione cliente e attività
						if($_GET["values"] == "clientdeleted"){
							echo "<div id='correct'> Cliente eliminato <br> Attività relative al cliente eliminate </div>";
						}
						
						if($_GET["values"] == "activitiesdeleted"){
							echo "<div id='correct'> Attività eliminata </div>";
						}
						if($_GET["values"] == "errordelete"){
							echo "<div id='iderror'> Qualcosa è andato storto</div>";
						}
					}
					
					//"clicca qui" su clienti per visualizzare attività
					if(isset($_GET["idprivato"])){
							$id = $_GET["idprivato"];
							$sql = "SELECT ID, Tipo, File, Matricola FROM privati INNER JOIN attività ON privati.MatricolaPrivato = attività.Matricola 
									WHERE privati.MatricolaPrivato = $id";
							$result = mysqli_query($conn, $sql);
							$row = mysqli_num_rows($result);
							if($row >= 1){
								echo "<table>";
										echo "<tr>";
											echo "<th> ID </th>";
											echo "<th> Tipo </th>";
											echo "<th> File </th>";
											echo "<th> Matricola </th>";
										echo "</tr>";
									while($row = mysqli_fetch_assoc($result)){
											echo "<tr>";
												echo "<td>" .$row['ID']."</td>";
												echo "<td>" .$row['Tipo']."</td>";
												echo "<td>" .$row['File']."</td>";
												echo "<td>" .$row['Matricola']."</td>";
											echo "</tr>";
									}
									echo "</table>";
							}else{
								echo "<span id='iderror'> Il cliente non ha attività </span>";
							}
						}
					if(isset($_GET["idazienda"])){
						$id = $_GET["idazienda"];
						$sql = "SELECT ID, Tipo, File, Matricola FROM aziende INNER JOIN attività ON aziende.MatricolaAzienda = attività.Matricola WHERE aziende.MatricolaAzienda = $id";
						$result = mysqli_query($conn, $sql);
						$row = mysqli_num_rows($result);
						if($row >= 1){
							echo "<table>";
									echo "<tr>";
										echo "<th> ID </th>";
										echo "<th> Tipo </th>";
										echo "<th> File </th>";
										echo "<th> Matricola </th>";
									echo "</tr>";
								while($row = mysqli_fetch_assoc($result)){
										echo "<tr>";
											echo "<td>" .$row['ID']."</td>";
											echo "<td>" .$row['Tipo']."</td>";
											echo "<td>" .$row['File']."</td>";
											echo "<td>" .$row['Matricola']."</td>";
										echo "</tr>";
								}
								echo "</table>";
						}else{
							echo "<span id='iderror'> Il cliente non ha attività </span>";
						}
					}
					
					if(isset($_GET["idente"])){
						$id = $_GET["idente"];
						$sql = "SELECT ID, Tipo, File, Matricola FROM entipubblici INNER JOIN attività ON entipubblici.MatricolaEnte = attività.Matricola WHERE entipubblici.MatricolaEnte = $id";
						$result = mysqli_query($conn, $sql);
						$row = mysqli_num_rows($result);
						if($row >= 1){
							echo "<table>";
									echo "<tr>";
										echo "<th> ID </th>";
										echo "<th> Tipo </th>";
										echo "<th> File </th>";
										echo "<th> Matricola </th>";
									echo "</tr>";
								while($row = mysqli_fetch_assoc($result)){
										echo "<tr>";
											echo "<td>" .$row['ID']."</td>";
											echo "<td>" .$row['Tipo']."</td>";
											echo "<td>" .$row['File']."</td>";
											echo "<td>" .$row['Matricola']."</td>";
										echo "</tr>";
								}
								echo "</table>";
						}else{
							echo "<span id='iderror'> Il cliente non ha attività </span>";
						}
					}
					
					//modifica cliente
					if(isset($_GET["updated"])){
						if($_GET["updated"] == "ok"){
							echo "<span id='correct'> Modifica avvenuta con successo </span>";
						}
						if($_GET["updated"] == "no"){
							echo "<span id='iderror'> Qualcosa è andato storto </span>";
						}
					}
				?>
			</div>
		</div>
	</body>
</html>
