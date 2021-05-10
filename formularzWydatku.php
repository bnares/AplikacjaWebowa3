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
		$kategoria = $_POST['kategoria'];
		$kwota = $_POST['kwota'];
		$data = $_POST['data'];
		$komentarz = $_POST['kom'];
		$metodaPlatnosci = $_POST['metodaPlatnosci'];
		
		$_SESSION['kategoriaWydatku'] = $_POST['kategoria'];
		$_SESSION['metodaPlatnosci'] = $_POST['metodaPlatnosci'];
		
		//znajdz id kategorii po jej nazwie i id uzytkownika
		$zapytanieSql = "SELECT * FROM expenses_category_asigned_to_users WHERE name = '$kategoria' AND user_id = '$user_id';";
		$wynikZapytania = $connection -> query($zapytanieSql);
		if(!$wynikZapytania)
		{
			throw new Exception ($connection->error);
			
		}
		$listaIdKategoriiWydatkuUzytkownika = $wynikZapytania->fetch_assoc();
		
		//wartosc expense_category_assigned_to_user_id z db
		$expense_category_assigned_to_user_id = $listaIdKategoriiWydatkuUzytkownika['id'];
		
		
		$zapytanieSql = "SELECT * FROM payment_methods_asigned_to_users WHERE name = '$metodaPlatnosci' AND user_id = '$user_id';";
		$wynikZapytania = $connection->query($zapytanieSql);
		if(!$wynikZapytania)
		{
			throw new Exception ($connection ->error);
			
		}
		$listaIdMetodPlatnosciUzytkownika = $wynikZapytania->fetch_assoc();
		$payment_method_assigned_to_user_id = $listaIdMetodPlatnosciUzytkownika['id'];
		$_SESSION['infoDeweloperskie'] = '<span>'.$metodaPlatnosci.' metoda platnosci payment_method_assigned_to_user_id '.$payment_method_assigned_to_user_id.' </span>';
		if(is_null($payment_method_assigned_to_user_id))
		{
			throw new Exception ('expense_category_assigned_to_user_id '.$expense_category_assigned_to_user_id.' kategoria '.$kategoria.' payment_method_assigned_to_user_id '.$payment_method_assigned_to_user_id.' metodaPlatnosci'.$metodaPlatnosci);
			print_r($_SESSION['infoDeweloperskie']);
		}
		
		if($connection->query("INSERT INTO expenses VALUES (NULL, '$user_id', '$expense_category_assigned_to_user_id', '$payment_method_assigned_to_user_id', '$kwota', '$data', '$komentarz');"))
		{
			
			header('Location: loggedin.php');
		}
		else
		{
			throw new Exception ($connection->error);
			print_r($_SESSION['infoDeweloperskie']);
		}
		$connection->close();
		
	}
	
	
	
}

catch (Exception $e)
{
	echo "<br/>Twoj error to: ".$e;
	echo "<br><br>";
	print_r($_SESSION['infoDeweloperskie']);
}

?>





