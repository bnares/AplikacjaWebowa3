<?php

session_start();


require_once "connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);

try
{
	$connection = new mysqli($host, $user, $password, $db_name);
	if($connection ->connect_errno!=0)
	{
		throw new Exception(mysqli_connect_errno());
	}
	else
	{
		$user_id = $_SESSION['id'];
		$kategoria = rawurldecode($_POST['kategoria']);
		$kwota = $_POST['kwota'];
		$data = $_POST['data'];
		$komentarz = $_POST['kom'];
		$metodaPlatnosci = rawurldecode($_POST['metodaPlatnosci']);
		
		//znajdz id kategorii po jej nazwie i id uzytkownika
		$zapytanieSql = "SELECT * FROM expenses_category_asigned_to_users WHERE name = '$kategoria' AND user_id = '$user_id';";
		$wynikZapytania = $connection -> query($zapytanieSql);
		if(!$wynikZapytania)
		{
			throw new Exception ($connection->error);
			//exit();
		}
		$listaIdKategoriiWydatkuUzytkownika = $wynikZapytania->fetch_assoc();
		
		//wartosc expense_category_assigned_to_user_id z db
		$expense_category_assigned_to_user_id = $listaIdKategoriiWydatkuUzytkownika['id'];
		//$zapytanieSql->free_result();
		$zapytanieSql = "SELECT * FROM payment_methods_asigned_to_users WHERE name = '$metodaPlatnosci' AND user_id = '$user_id';";
		$wynikZapytania = $connection->query($zapytanieSql);
		if(!$wynikZapytania)
		{
			throw new Exception ($connection ->error);
			//exit();
		}
		$listaIdMetodPlatnosciUzytkownika = $wynikZapytania->fetch_assoc();
		$payment_method_assigned_to_user_id = $listaIdMetodPlatnosciUzytkownika['id'];
		if(is_null($payment_method_assigned_to_user_id))
		{
			throw new Exception ('BRAK WYNIKOW W BAZIE expense_category_assigned_to_user_id '.$expense_category_assigned_to_user_id.' kategoria '.$kategoria.' payment_method_assigned_to_user_id '.$payment_method_assigned_to_user_id.' metodaPlatnosci'.$metodaPlatnosci);
		}
		
		if($connection->query("INSERT INTO expenses VALUES (NULL, '$user_id', '$expense_category_assigned_to_user_id', '$payment_method_assigned_to_user_id', '$kwota', '$data', '$komentarz');"))
		{
			header('Location: loggedin.php');
		}
		else
		{
			throw new Exception ($connection->error);
		}
		
		
	}
	
	$connection->close();
	
}

catch (Exception $e)
{
	echo "<br/>Twoj error to: ".$e;
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
	
	
	
	
	
	
	</body>
	
</html>