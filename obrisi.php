<?php
		include "config/konekcija.php";
	
			
		if ($_GET["brisanje"]=="brisi")
			{
					if ($_GET["id"])
					{
		
						$sql_brisi="DELETE FROM kontakti WHERE id=".$_GET["id"];
						if (mysql_query($sql_brisi))
							{					
								header('Location:svi_kontakti.php');
							}
						else 
							{
									echo '<script language="javascript">';
									echo 'alert("Nema kontakta u bazi!")'.mysql_error();
									echo '</script>';
							}
					}
			}
		
?>