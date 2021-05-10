<?php



?>



<!DOCTYPE HTML>
<html lang = "pl">
	
	<head>
	
		<meta charset = "utf-8"/>
		<meta http-equiv = "X-UA-Compatible" content = "IE=edge,chrome =1"/>
		<title>MyBudget</title>
	</head>
	
	<body>
	
		<form action = "formularzPrzychodu.php" method = "get">
			<br/>
			Kwota: <input type = "number" step = "0.01", min = "0" name = "kwota"/>
			<br/>
			Data: <input type = "date" name = "data"/>
			<br/>
			Kategoria: <input type = "text" name = "kategoria"/>
			<br/>
			Komentarz: <input type = "text" name = "kom"/>
			<br/>
			
			<input type = "submit" value = "Zatwierdź"/>
		
		</form>
		
	
	</body>


</html>