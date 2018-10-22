<?php
	//ako smo stisnuli gumb za upis tada upisi u bazu
	if ($_POST["spremi"])
		{
			
           // Spoj na bazu
			include "config/konekcija.php";
			$sql_forma="INSERT INTO kontakti (ime, prezime, titula, zvanje, grad, adresa, e_mail, code, grupa) 
						VALUES ('$_POST[ime]', '$_POST[prezime]', '$_POST[titula]','$_POST[zvanje]','$_POST[grad]','$_POST[adresa]','$_POST[email]','$_POST[code]','$_POST[grupa]')";
			//provjera jesu li podaci uspjesno upisani

			if (mysql_query($sql_forma))
				{
					header('Location:unos_kontakta.php');
				} 
			else 
				{
					echo "Nismo mogli pohraniti podatke"."<br>".mysql_error();
				}
		}
	else 
		{
			header('Location:unos kontakta.php');
		}

		
		



	//ako smo stisnuli gumb za odustani vracamo se na unos korisnika
		
	if ($_POST["odustani"])
		{
	
			header('Location:unos_kontakta.php');
		}

?>