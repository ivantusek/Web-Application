<?php
		include "konekcija.php";
	
			
		if ($_GET["brisanje"]=="brisi")
			{
					if ($_GET["id"])
					{
		
						$sql_brisi="DELETE FROM grupe WHERE id=".$_GET["id"];
						if (mysql_query($sql_brisi))
							{					
								header('Location:grupe.php');
							}
						else 
							{
									echo '<script language="javascript">';
									echo 'alert("Nema grupa u bazi!")'.mysql_error();
									echo '</script>';
							}
					}
			}
		
?>