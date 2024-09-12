<?php
	$host = "localhost";
	$username = "root";
	$password = "";
	$nome_db = "studio_commercialista_db";
	$conn = mysqli_connect($host, $username, $password);
	$conn_db = mysqli_select_db($conn, $nome_db);
?>

