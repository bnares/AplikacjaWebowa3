<?php
	session_start();
	

?>

<!DOCTYPE HTML>
<html lang = "pl">
	
	<head>
	
		<meta charset = "utf-8"/>
		<meta http-equiv = "X-UA-Compatible" content = "IE=edge,chrome =1"/>
		<title>MyBudget</title>
		
		
	</head>
	
	
	<body>
	<?php
		if(isset($_SESSION['nowyUzytkownik']))
		{
			echo $_SESSION['nowyUzytkownik'];
		}
	?>
	<form action = "sprawdzLoginHaslo.php" method = "post">
	
		Login:<br/><input type = "text" name = "login"/>
		<br/>
		Haslo:<br/><input type = "password" name = "pass"/>
		<label><br/><input type = "submit" value = "Zaloguj"></label>
		<label><vr><input type = "submit" name= "signin" value = "Zarejestruj"></label>
	
	</form>
	
	
	<?php
		
			if(isset($_SESSION['e_logowanie']))
			{
				echo '<br/>'.$_SESSION['e_logowanie'];
			
				
			}
		
	?>
	
	</body>
	
</html>