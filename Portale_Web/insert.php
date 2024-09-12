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
				<li><a class="active" href="insert.php">Inserimento</a></li>
				<li><a href="search.php">Ricerca</a></li>
				<li><a href="view.php">Visualizza</a></li>
			</ul>
		

			<div class="text"> 
				<div class="insertbox">
					<div class="firstbox">
						<div id="insert">
							<span style="color:white; font-size: 20px;">Inserimento cliente</span>
						</div>
							<p id="client1">Tipo di cliente:
								<select onchange='location= "insert.php?"+this.value' name="client">
									<option value="seleziona"> Seleziona: </option>
									<option value="privato" <?php if(isset($_GET["privato"])) echo"selected";?>>Privato</option>
									<option value="azienda" <?php if(isset($_GET["azienda"])) echo"selected";?>>Azienda</option>
									<option value="ente" <?php if(isset($_GET["ente"])) echo"selected";?>>Ente Pubblico</option>
								</select>
							</p>
					</div>
					<div class="client1"> 
						<?php
						//controllo casistiche
							if(isset($_GET["uploaded"])){
								$id = intval($_GET["uploaded"]);
								echo "<span id=\"uploadclientstring\"\">Cliente con id: " .$id; 
								echo "<br>";
								echo " inserito correttamente</span>";
							}
							elseif(isset($_GET["notuploaded"]))
								echo "<span id=\"notuploadclientstring\"\">Errore nell'inserimento del cliente</span>";
							elseif(isset($_GET["fieldrequired"]))
								echo "<span id=\"fieldrequiredstring\"\">Inserisci tutti i campi</span>";
								
							if(isset($_GET["errorprivatoid"])){
								$cf = $_GET["errorprivatoid"];
								echo "<span id=\"notuploadclientstring\"\">Cambiare codice fiscale: ".$cf. " già presente nel database</span>";
							}
							
							if(isset($_GET["erroraziendaid"])){
								$iva = $_GET["erroraziendaid"];
								echo "<span id=\"notuploadclientstring\"\">Cambiare partita iva: ".$iva. " già presente nel database</span>";
							}
							
							if(isset($_GET["errorenteid"])){
								$id = $_GET["errorenteid"];
								echo "<span id=\"notuploadclientstring\"\">Cambiare identificativo ente: ".$id. " già presente nel database</span>";
							}
						//inserimenti
							if(isset($_GET["privato"])){
								echo "<form action='uploadclient.php' method='post'>";
								echo "<p id=\"client2\">";
								echo "Nome: ";
								echo "</br>";
								echo "<input type=\"text\" name=\"name\" size=\"15\">";
								echo "</br>";
								echo "Cognome: ";
								echo "</br>";
								echo "<input type=\"text\" name=\"surname\" size=\"15\">";
								echo "</br>";
								echo "Codice Fiscale: ";
								echo "</br>";
								echo "<input type=\"text\" name=\"cf\">";
								echo "</br>";
								echo "Numero telefonico: ";
								echo "</br>";
								echo "<input type=\"text\" name=\"telefonnumber\" size=\"10\">";
								echo "</br>";
								echo "<p id=\"send\">";
								echo "<input type=\"image\" src=\"send_button.png\" width=\"50\" height=\"50\" alt=\"send\">";
								echo "</p>";
								echo "</p>";
								echo "</form>";
							}
							
							if(isset($_GET["azienda"])){
								echo "<form action='uploadclient.php' method='post'>";
								echo "<p id=\"client2\">";
								echo "Nominativo: ";
								echo "</br>";
								echo "<input type=\"text\" name=\"name\">";
								echo "</br>";
								echo "Partita IVA: ";
								echo "</br>";
								echo "<input type=\"text\" name=\"iva\">";
								echo "</br>";
								echo "PEC: ";
								echo "</br>";
								echo "<input type=\"text\" name=\"pec\" size=\"30\">";
								echo "</br>";
								echo "<p id=\"send\">";
								echo "<input type=\"image\" src=\"send_button.png\" width=\"50\" height=\"50\" alt=\"send\">";
								echo "</p>";
								echo "</p>";
								echo "</form>";
							}
							
							if(isset($_GET["ente"])){
								echo "<form action='uploadclient.php' method='post'>";
								echo "<p id=\"client2\">";
								echo "Nominativo: ";
								echo "</br>";
								echo "<input type=\"text\" name=\"name\">";
								echo "</br>";
								echo "Identificativo: ";
								echo "</br>";
								echo "<input type=\"text\" name=\"id\">";
								echo "</br>";
								echo "Localita': ";
								echo "</br>";
								echo "<input type=\"text\" name=\"locality\" size=\"15\">";
								echo "</br>";
								echo "Descrizione Servizio: ";
								echo "</br>";
								echo "<input type=\"text\" name=\"description\" size=\"30\">";
								echo "</br>";
								echo "<p id=\"send\">";
								echo "<input type=\"image\" src=\"send_button.png\" width=\"50\" height=\"50\" alt=\"send\">";
								echo "</p>";
								echo "</p>";
								echo "</form>";
							}
						?>
						
					</div>
				</div>
				
				<div class="insertbox">
					<div class="firstbox">
						<div id="insert">
							<span style="color:white; font-size: 20px;">Inserimento attività</span>
						</div>
							<form action="uploadfile.php" method="post" enctype="multipart/form-data" >
								<p id="client1">Tipo di attività:
									<select onchange='location= "insert.php?"+this.value' name="type" required>
										<option value=""> Seleziona: </option>
										<option value="Dichiarazione_Redditi"<?php if(isset($_GET["Dichiarazione_Redditi"])) echo"selected";?>>Dichiarazione redditi</option>
										<option value="Statuto_Societario" <?php if(isset($_GET["Statuto_Societario"])) echo"selected";?>>Statuto societario</option>
										<option value="Fattura_Elettronica" <?php if(isset($_GET["Fattura_Elettronica"])) echo"selected";?>>Fattura elettronica</option>
										<option value="Contabilità" <?php if(isset($_GET["Contabilità"])) echo"selected";?>>Contabilità</option>
									</select>
								</p>
					</div>
					
					<div class="activity1">
						<div id="selectionfile">
								Inserisci ID cliente: <br>
								<input type="text" name="id" required=> <br> <br>
								Inserisci un file di estenzione <br> .pdf .zip .docx <br> <br>
								<input type="file" name="myfile" required> <br>
								<?php
									if(isset($_GET["extension"]))
										echo "<span style=\"color:red; font-size:14px\">Estensioni supportate: .pdf .zip .docx</span>";
									if(isset($_GET["larger"]))
										echo "<span style=\"color:red; font-size:14px\">Dimensione massima 10mb</span>";
									if(isset($_GET["ok"]))
										echo "<span style=\"color:green; font-size:14px\">Attivita inserita correttamente</span>";
									if(isset($_GET["no"]))
										echo "<span style=\"color:red; font-size:14px\">Errore nell'inserimento dell'attività</span>";
									if(isset($_GET["id"])){
										$matricola = $_GET["id"];
										echo "<span style=\"color:red; font-size:14px\">Il cliente con id: $matricola non esiste</span>";
									}
								?>								
								<p id="send2">
									<button id="send2" name="save"> <img src="send_button.png" width="50" height="50"/> </button>
								</p>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>