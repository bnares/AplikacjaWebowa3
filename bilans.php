


<!DOCTYPE HTML>
<html lang = "pl">
	
	<head>
	
		<meta charset = "utf-8"/>
		<meta http-equiv = "X-UA-Compatible" content = "IE=edge,chrome =1"/>
		<title>MyBudget</title>
		
		
	</head>
	
	
	<body>
	
	
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
		$zapytanieSqlPrzychody = "SELECT * FROM incomes WHERE user_id = '$_SESSION[id]';";
		$zapytanieSqlWydatki = "SELECT * FROM expenses WHERE user_id = '$_SESSION[id]';";
		
		$wynikPrzychody = $connection->query($zapytanieSqlPrzychody);
		$wynikWydatki = $connection->query($zapytanieSqlWydatki);
		if(!$wynikPrzychody or !$wynikWydatki)
		{
			throw new Exception ($connection-> error);
		}
		
		else
		{
			$rekordyTablicowePrzychody = $wynikPrzychody->fetch_assoc();
			$rekordyTablicoweWydatki = $wynikWydatki->fetch_assoc();
			echo '<table>';
			
			echo '<tr>';
			
			echo '<th>Przychody</th>';
			
			echo '<th>Wydatki</th>';
			
			//echo '<th>Data</th>'
			
			echo '</tr>';
			
			
				echo '<tr>';
				for($i =0;$i<$wynikPrzychody->num_rows; $i++)
				{
					echo '<script type = "text/javascript">alert("PRZYCHÓD '.$rekordyTablicowePrzychody['amount'].'")</script>';
					echo '<td>'.$rekordyTablicowePrzychody['amount'].'</td>';
					
					
				}
				
				for($i =0;$i<$wynikWydatki->num_rows; $i++)
				{
					echo '<script type = "text/javascript">alert("ROZCHÓD '.$rekordyTablicoweWydatki['amount'].'")</script>';
					echo '<td>'.$rekordyTablicoweWydatki['amount'].'</td>';
					
					
				}
				
				
				echo '</tr>';
			
			
			echo '</table>';
		}
	}
}

catch (Exception $e)
{
	echo '<br>Twój Error: '.$e;
}


?>
	
	</body>
	
</html>