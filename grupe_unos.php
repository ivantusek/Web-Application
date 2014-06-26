<?php


	if (isset($_POST['spremi']))
		{
  
			include "konekcija.php";
			$sql_forma="INSERT INTO grupe (id, ime ) 
						VALUES ('', '$_POST[grupa]')";
			

			if (mysql_query($sql_forma))
				{
					header('Location:grupe.php');
				} 
			else 
				{
					echo "Nismo mogli pohraniti podatke"."<br>".mysql_error();
				}
		}
	else 
		{
			header('Location:grupe.php');
		} 


if (isset($_POST['obrisi']))
		{
			header('Location:grupe.php');
		}

	
	

?>