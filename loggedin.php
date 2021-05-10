<?php

session_start();
echo "Witaj ".$_SESSION['login']." jestes zalogowany";


?>


<!DOCTYPE HTML>
<html lang = "pl">
	
	<head>
	
		<meta charset = "utf-8"/>
		<meta http-equiv = "X-UA-Compatible" content = "IE=edge,chrome =1"/>
		<title>MyBudget</title>
		
		
	</head>
	
	
	<body>
	<br/>
	<form method = "post">
	
		<input type = "submit" value = "Wyloguj" name = "wyloguj"/>
		<?php
		
			if(isset($_POST['wyloguj']))
			{
				unset($_POST['wyloguj']);
				session_unset();
				header('Location: index.php');
			}

		
		?>
	
	</form>
	
	<form method = "post" action = "dodajPrzychod.php">
	
		<input type = "submit" name = "DodajPrzychod" value = "Dodaj Przychód"/>
	
	</form>
	
	
	<form method = "post" action = "dodajWydatek.php">
	
		<input type = "submit" name = "DodajWydatek" value = "Dodaj Wydatek"/>
	
	</form>
	
	<form method = "post" action = "bilans.php">
	
		<input type = "submit" value = "Bilans"/>
	
	</form>
	
	
	
	
	</body>
	
</html>

