<?php
		
		include "config/konekcija.php";		
		
	if ($_GET["brisanje"]=="brisi")
			{
				if ($_GET["id"])
					{
						$sql_brisi="DELETE FROM korisnici WHERE id=".$_GET["id"];
						if (mysql_query($sql_brisi))
							{					
								header('Location:ispis_korisnika.php');
							}
						else 
							{
									echo '<script language="javascript">';
									echo 'alert("Niste uspijeli obrisati korisnika!!")'.mysql_error();
									echo '</script>';
							}
					}
			}
?>