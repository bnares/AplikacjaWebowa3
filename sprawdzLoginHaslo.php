<?php


session_start();

require_once "connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);

if(isset($_POST['signin']) && !(empty($_POST['signin'])))
{
	header('Location:rejestracja.php');
	exit();
}


try
{
	$connection = new mysqli($host, $user, $password, $db_name);
	if($connection->connect_errno!=0)
	{
	
		throw new Exception(mysqli_connect_errno());
		
	
	}
	else
	{
	
		$nick = $_POST['login'];
		$password = $_POST['pass'];
		
		$zapytanieSql = $connection->query("SELECT * FROM users WHERE username = '$nick';");
										   
		
		if(!$zapytanieSql)
		{

			throw new Exception($connection->error);
		
		}
		
		
		
		$liczbaWynikow = $zapytanieSql->num_rows;
		
		
		if($liczbaWynikow>0)
		{
			$rekord = $zapytanieSql->fetch_assoc();
			//echo '<script type = "text/javascript">alert("PRZED password_verify '.$password.' '.$rekord["password"].'")</script>';
			if(password_verify($password, $rekord['password']))
			{
						
				$_SESSION['zalogowany'] = true;
				
				if(isset($_SESSION['e_logowanie']))
				{
					unset($_SESSION['e_logowanie']);
				}
				
				$_SESSION['id'] = $rekord['id'];
				$_SESSION['login'] = $_POST['login'];
				unset($_POST['login']);
				unset($_POST['pass']);
				unset($_SESSION['nowyUzytkownik']);
				$zapytanieSql -> free_result();
				
				header('Location: loggedin.php');
			}
			else
			{	//echo '<script type = "text/javascript">alert("password_verify '.$password.' '.$rekord["password"].'")</script>';
				$_SESSION['e_logowanie'] = '<span style ="color:red">Nieprawidłowy Login lub Haslo</span>';
				header('Location:index.php');
			}
		}
		else
		{
			$_SESSION['e_logowanie'] = '<span style ="color:red">Nieprawidłowy Login lub Haslo</span>';
			
			header('Location:index.php');
		}
		
		$connection->close();
	
	}
}

catch(Exception $e)
{
 echo "<br/>Error: ".$e;	
}


?>