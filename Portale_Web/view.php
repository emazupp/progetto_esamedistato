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
				<li><a href="search.php">Ricerca</a></li>
				<li><a class="active" href="view.php">Visualizza</a></li>
			</ul>

			<div class="text"> 
				<div id="selectclient">	
					<form action="viewprivati.php" method="post">
						<button name="send" id="buttonclient"> Privati </button>
					</form>
					
					<form action="viewaziende.php" method="post">
						<button name="send" id="buttonclient"> Aziende </button>
					</form>
					
					<form action="viewenti.php" method="post">
						<button name="send" id="buttonclient"> Enti pubblici </button>
					</form>
				</div>
				
			</div>
		</div>
	</body>
</html>