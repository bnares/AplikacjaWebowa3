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
		$kategoria = strtoupper($_GET['kategoria']);
		$kwota = $_GET['kwota'];
		$data = $_GET['data'];
		$komentarz = $_GET['kom'];
		$liczbaWystapienIdKategorii = 0;
		echo '<script type = "text/javascript">alert("user_id '.$user_id.'")</script>';
		
		
		
		
			$zapytanieSql = $connection->query("SELECT * FROM incomes_category_asigned_to_user WHERE user_id = '$user_id'");
			if($zapytanieSql)
			{
					while($wynikZapytania = mysqli_fetch_array($zapytanieSql))
					{
							$nazwaKategorii = strtoupper($wynikZapytania['name']);
							$id_kategorii = $wynikZapytania['id'];
							if($nazwaKategorii == $kategoria)
							{
								$_SESSION['id_kategorii'] = $id_kategorii;
								$liczbaWystapienIdKategorii++;
							}
							
					}
					
					
				$zapytanieSql -> free_result();
				if($liczbaWystapienIdKategorii>0)
				{
				
					$connection ->query("INSERT INTO incomes VALUES(NULL, '$user_id', '$_SESSION[id_kategorii]','$kwota', '$data','$komentarz');");
					header('Location:loggedin.php');
					echo "Dodano nowa pozycje";
					
					
				}
				else
				{
					echo '<script type = "text/javascript">alert("password_verify '.$password.' '.$rekord["password"].'")</script>';
					if($connection->query("INSERT INTO incomes_category_asigned_to_user VALUES (NULL,'$user_id', '$kategoria');"))
					{
						
						$zapytanieSql = $connection->query("SELECT * FROM incomes_category_asigned_to_user ORDER BY id DESC LIMIT 1;");
						if($zapytanieSql)
						{
							$wynikZapytania = $zapytanieSql->fetch_assoc();
							$test = $wynikZapytania['id'];
							$zapytanieSql->free_result();
						
							if($connection->query("INSERT INTO incomes VALUES(NULL, '$user_id', '$test', '$kwota', '$data', '$komentarz');"))
							{
								
								
								header('Location:loggedin.php');
							}
							else
							{
								throw new Exception($connection->error);
							}
						
							
						}
						
						else
						{
							throw new Exception($connection->error);
						}
					
					}
					
					else
					{
						throw new Exception($connection->error);
					}
				
				}
				
			}
			else
			{
				throw new Exception($connection->error);
			}
			
			$connection->close();
		
	}
	
	
	
	
}

catch (Exception $e)
{
	echo "<br/>Twoj error to: ".$e;
}

?>