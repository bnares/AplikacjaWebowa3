<?php

	if(isset($_POST['signin']))
	{
		try
		{
			session_start();
			require_once "connect.php";
			
			$connection = new mysqli($host, $user, $password, $db_name);
			if($connection->connect_errno!=0)
			{
				throw new Exception ($connection->error);
			}
			
			else
			{	
				$login = $_POST['login'];
				$firstPass = $_POST['pass1'];
				$secondPass = $_POST['pass2'];
				$email = $_POST['email'];
				$emailSanitize = filter_var($email, FILTER_SANITIZE_EMAIL);
				$_SESSION['zarejestrowany']=true;
				
				
				if(empty($login) || empty($firstPass) || empty($secondPass) || empty($email))
				{
					$_SESSION['e_dane'] = '<br><span style = "color: red"> Nie wypełnono wszystkich pól</span>';
					$_SESSION['zarejestrowany']=false;
					
				}
				
				
				if($firstPass == $secondPass)
				{
				
					$zapytaniesql = "SELECT * FROM users";
					$wynikZapytania = $connection->query($zapytaniesql);
					while($rekordy = mysqli_fetch_array($wynikZapytania))
					{
						if($login == $rekordy['username'])
						{
							$_SESSION['e_login'] = '<br><span style = "color:red">Taki Login już istnieje. Podaj inny</span>';
							$_SESSION['zarejestrowany']=false;
						}
						
						if(ctype_alnum($login)==false)
						{
							$_SESSION['e_login'] = '<br><span style = "color:red">Login może składać się tylko z liter i cyfr bez polskich znaków</span>';
							$_SESSION['zarejestrowany']=false;
						}
						
						
						if($email == $rekordy['email'])
						{
							$_SESSION['e_email'] = '<br><span style = "color:red">Taki email już istnieje. Podaj inny</span>';
							$_SESSION['zarejestrowany']=false;
						}
						
						if($email != $emailSanitize || (filter_var($email, FILTER_VALIDATE_EMAIL)==false))
						{
							$_SESSION['e_email'] = '<br><span style = "color:red">Błedny email. Podaj inny</span>';
							$_SESSION['zarejestrowany']=false;
						}
						
					}
					mysqli_data_seek($wynikZapytania,0);
					
					
					
				}
				
				else
				{
					$_SESSION['e_haslo'] = '<br><span style = "color: red"> Podane Hasła się różanią</span>';
					$_SESSION['zarejestrowany']=false;
					
				}
				
				
				
				if($_SESSION['zarejestrowany'])
				{
					if(isset($_SESSION['e_haslo'])) unset($_SESSION['e_haslo']);
					if(isset($_SESSION['e_login'])) unset($_SESSION['e_login']);
					if(isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
					if(isset($_SESSION['e_haslo'])) unset($_SESSION['e_haslo']);
					if(isset($_SESSION['e_dane'])) unset($_SESSION['e_dane']);
					$haslo_hash = password_hash($firstPass, PASSWORD_DEFAULT);
					if($connection->query("INSERT INTO users VALUES (NULL, '$login', '$haslo_hash', '$email');"))
					{
						$_SESSION['nowyUzytkownik'] = '<br><span>Dodano Nowego Uzytkownika</span>';
						
						header('Location:index.php');
					}
					else
					{
						throw new Exception ($connection->error);
					}
				}
				
				
				
				
			}
			
			$connection->close();
		
		}
		catch (Exception $e)
		{
			echo "Twoj error: ".$e;
		}
	}

?>

<!DOCTYPE HTML>
<html lang = "pl">
	
	<head>
	
		<meta charset = "utf-8"/>
		<meta http-equiv = "X-UA-Compatible" content = "IE=edge,chrome =1"/>
		<title>MyBudget</title>
		
		
	</head>
	
	
	<body>
	
	<form method = "post">
	
		Login:<br/><input type = "text" name = "login"/>
		<?php
		
			if(isset($_SESSION['e_login']))
			{
				echo $_SESSION['e_login'];
				unset($_SESSION['e_login']);
			}
			
			
		
		?>
		<br/>
		Haslo:<br/><input type = "password" name = "pass1"/>
		<br>
		Powtórz Haslo:<br/><input type = "password" name = "pass2"/>
		<?php
			if(isset($_SESSION['e_haslo']))
			{
				echo $_SESSION['e_haslo'];
				unset($_SESSION['e_haslo']);
			}
			
			
		?>
		<br>
		Email:<br/><input type = "email" name = "email">
		<?php
			if(isset($_SESSION['e_email']))
			{
				echo $_SESSION['e_email'];
				unset($_SESSION['e_email']);
			}
			
			if(isset($_SESSION['e_dane']))
			{
				echo $_SESSION['e_dane'];
				unset($_SESSION['e_dane']);
			
			}
		?>
		
		
		
		<br>
		<label><vr><input type = "submit" name= "signin" value = "Zarejestruj"></label>
	
	</form>
	
	
	
	
	</body>
	
</html>