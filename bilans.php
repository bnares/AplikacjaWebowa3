


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
			//$rekordyTablicowePrzychody = $wynikPrzychody->fetch_assoc();
			//$rekordyTablicoweWydatki = $wynikWydatki->fetch_assoc();
			$sumaPrzychody = 0;
			$sumaWydatki = 0;
			echo '<div>';
			echo '<div style ="float:left">';
			echo '<table>';
			
			echo '<tr>';
			
			echo '<th>Przychody</th>';
			
			
			
			//echo '<th>Data</th>'
			
			echo '</tr>';
			
			
				//echo '<tr>';
				
				while($wynik = mysqli_fetch_assoc($wynikPrzychody))
				{
					
					echo '<tr>';
					
					//echo '<script type = "text/javascript">alert("PRZYCHÓD '.$wynik['amount'].'")</script>';
					echo '<td>'.$wynik['amount'].'</td>';
					$sumaPrzychody = $sumaPrzychody+$wynik['amount'];
					
					echo '</tr>';
				
				}
				mysqli_data_seek($wynikPrzychody,0);
				
				echo '</table>';
				
				echo '</div>';
				
				echo '<div style = "float: left">';
				
				echo '<table>';
				
				echo '<tr>';
			
				echo '<th>Wydatki</th>';
			
				echo '</tr>';
				
				while($wynik=mysqli_fetch_assoc($wynikWydatki))
				{
					echo '<tr>';
					//echo '<script type = "text/javascript">alert("ROZCHÓD '.$wynik['amount'].'")</script>';
					echo '<td>'.$wynik['amount'].'</td>';
					$sumaWydatki = $sumaWydatki+$wynik['amount'];
					echo '</tr>';
					
				}
				mysqli_data_seek($wynikWydatki,0);
				
				echo '</table>';
				
				echo '</div>';
				echo '</div>';
				
				
				echo '<br><div style = "clear:both"><b>BILANS<b>: '.$sumaPrzychody-$sumaWydatki.'</div>';
				
				
				//echo '</tr>';
			
			
			
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