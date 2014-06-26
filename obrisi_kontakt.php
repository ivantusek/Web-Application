<?php
		
		include "konekcija.php";		

			
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
								echo "Niste uspjeli obrisati kontakt."."<br>".mysql_error();
							}
					}
			}
			
?>