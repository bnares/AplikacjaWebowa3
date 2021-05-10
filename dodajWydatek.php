<?php

session_start();
require_once "connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);
try
{
	$connection = new mysqli($host, $user, $password, $db_name);
	if($connection->connect_errno!=0)
	{
		throw new Exception(mysqli_connect_errno());
	}
	else
	{
		$count = 0;
		$zapytanieSqlDefaultTable = $connection->query("SELECT * FROM payment_methods_default;");
		$zapytanieSqlAsignedTable = $connection->query("SELECT * FROM payment_methods_asigned_to_users WHERE user_id = '$_SESSION[id]'");
		if($zapytanieSqlDefaultTable)
		{
			if($zapytanieSqlAsignedTable)
			{
				$tabelaWynikiDefault = array();
				$tabelaWynikiAsigned = array();
				while($wynikZapytaniaSqlDefault = mysqli_fetch_array($zapytanieSqlDefaultTable))
				{
					//kontrola wartosci alert()
					//echo '<script type = "text/javascript">alert("DEFAULT '.$count.' '.$wynikZapytaniaSqlDefault["name"].'")</script>';
					while($wynikZapytaniaSqlAsigned = mysqli_fetch_array($zapytanieSqlAsignedTable))
					{
						//echo '<script type = "text/javascript">alert("ASIGNED '.$count.' '.$wynikZapytaniaSqlAsigned["name"].'")</script>';
						if($wynikZapytaniaSqlDefault['name'] == $wynikZapytaniaSqlAsigned['name'])
						{
							$count++;
						}
						
					}
					// przesuwa wskaznik na poczatek listy po wykonaniu zagniezdzonego while gdyz domysle wskaznik jest na ostatnim wierszu bazy danych
					mysqli_data_seek($zapytanieSqlAsignedTable,0);  
					if($count==0)
					{	
						//echo '<script type = "text/javascript">alert("'.$count.' '.$wynikZapytaniaSqlDefault["name"].'")</script>';
						$connection->query("INSERT INTO payment_methods_asigned_to_users VALUES(NULL,'$_SESSION[id]', '$wynikZapytaniaSqlDefault[name]');");
					}
					$count = 0;
					
				}
				
				$zapytanieSqlDefaultTable->free_result();
				$zapytanieSqlAsignedTable->free_result();
			}
			
			else
			{
				throw new Exception ($connection->error);
			}
		}
		
		else
		{
			throw new Exception ($connection->error);
		}
		
		//NOWA KATEGORIA ZAPYTAN
		
		$count = 0;
		$zapytanieSqlDefaultTableExpenseCategory = $connection->query("SELECT * FROM expenses_category_default;");
		$zapytanieSqlAsignedTableExpenseCategory = $connection->query("SELECT * FROM expenses_category_asigned_to_users WHERE user_id = '$_SESSION[id]'");
		if($zapytanieSqlDefaultTableExpenseCategory)
		{
			if($zapytanieSqlAsignedTableExpenseCategory)
			{
				while($defaultTable = mysqli_fetch_array($zapytanieSqlDefaultTableExpenseCategory))
				{
						while($asignedTable = mysqli_fetch_array($zapytanieSqlAsignedTableExpenseCategory))
						{
							if($defaultTable['name'] == $asignedTable['name'])
							{
								$count++;
							}
						}
						
						if($count==0)
						{
							$connection->query("INSERT INTO expenses_category_asigned_to_users VALUES (NULL, '$_SESSION[id]', '$defaultTable[name]');");
						}
						$count=0;
						mysqli_data_seek($zapytanieSqlAsignedTableExpenseCategory,0);
				}
			}
			else
			{
				throw new Exception ($connection->error);
			}
		}
		
		else
		{
			throw new Exception ($connection ->error);
		}
		
	}
	$connection->close();
}
catch (Exception $e)
{
	echo "<br>Error: ".$e;
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
	
		<form action = "formularzWydatku.php" method = "post">
			<br/>
			Kwota: <input type = "number" step = "0.01", min = "0" name = "kwota"/>
			<br/>
			Data: <input type = "date" name = "data"/>
			<br/>
			Kategoria: 
			<?php
			
				echo '<select name = "kategoria">';
				session_start();
				mysqli_report(MYSQLI_REPORT_STRICT);
				
				try
				{
					$connection = new mysqli($host, $user, $password, $db_name);
					if($connection->connect_errno!=0)
					{
						throw new Exception($connection->error);
					}
					else{
						$zapytanieSql = "SELECT name FROM expenses_category_asigned_to_users WHERE user_id = '$_SESSION[id]';";
						$rekordyZapytaniaSql = $connection -> query($zapytanieSql);
						if(!$rekordyZapytaniaSql)
						{
							throw new Exception ($connection->error);
						}
						echo '<option value = "default" disabled selected>--WYBIERZ--</option>';
						while($wynikZapytaniaSql = mysqli_fetch_array($rekordyZapytaniaSql))
						{
							echo '<option value = '.$wynikZapytaniaSql['name'].'>'.strtoupper($wynikZapytaniaSql['name']).'</option>';
						}
					}
					
					$connection->close();
				}
				
				catch (Exception $e)
				{
					echo '<br>Error: '.$e;
				}
				
				echo '</select>';
		
			?>
			<br/>
			Metoda Płatności: 
			
			
				<?php
					echo '<select name = "metodaPlatnosci">';
					session_start();
					require_once "connect.php";
					mysqli_report(MYSQLI_REPORT_STRICT);
					try
					{
						$connection = new mysqli($host, $user, $password, $db_name);
						if($connect->connect_errno!=0)
						{
							throw new Exception ($connection->error);
						}
						
						else
						{
							$sqlZapytanie = "SELECT name FROM payment_methods_asigned_to_users WHERE user_id = '$_SESSION[id]';";
							$sqlWynikZapytania = $connection->query($sqlZapytanie);
							if($sqlWynikZapytania)
							{
								echo '<option value = "default" disabled selected>--WYBIERZ--</option>';
								while($listaWynikow = mysqli_fetch_assoc($sqlWynikZapytania))
								{		
									
									echo "<option value = ".$listaWynikow['name'].">".strtoupper($listaWynikow['name'])."</option>";
								}
								
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
						echo "<br>Error: ".$e;
					}
					echo "</select>";
				?>
			
			
			<br>;
			Komentarz: <input type = "text" name = "kom"/>
			<br/>
			
			<input type = "submit" value = "Zatwierdź"/>
		
		</form>
		
	
	</body>


</html>