<?php		
				$tabelaWynikiDefault = array();
				$tabelaWynikiAsigned = array(11,22, 2); 
				foreach($tabelaWynikiDefault as $default)
				{
					//echo '<script type = "text/javascript">alert("DEFAULT '.$default.'")</script>';
					foreach($tabelaWynikiAsigned as $asigned)
					{
						//echo '<script type = "text/javascript">alert("ASIGNED '.$asigned.'")</script>';
						if($default==$asigned)
						{
							echo '<script type = "text/javascript">alert("ROWNE '.$asigned.'")</script>';
						}
						
					}
					
					
					
				}
				$result = array_diff($tabelaWynikiAsigned, $tabelaWynikiDefault);
				print_r($result);
				echo "<br>";
				foreach($result as $res)
				{
					echo $res.'<br>';
				}
				
?>