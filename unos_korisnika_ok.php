<?php

      // Spoj na bazu
		include "config/konekcija.php";
		
	//ako smo stisnuli gumb za upis tada upisi u bazu
	if ($_POST["spremi"]){
		
		
		//da su popunjena sva polja
		if (!$_POST['ime'] | !$_POST['prezime'] | !$_POST['korisnicko'] | !$_POST['zaporka'] |  !$_POST['email'] ) {  
 		die('Niste popunili sva polja!');

 	}
			
          
				// provjera tip korisnika radio button
				$check = mysql_query("SELECT * FROM korisnici") or die(mysql_error());
				$check2 = mysql_num_rows($check);
				$tipusera = $_POST['admin_user'];
	
				if ($tipusera == "admin") 
				{
					$tipkorisnika = 0;
				}
				if ($tipusera == "user") 
				{
					 $tipkorisnika = 1;
				}
				
				$_POST['zaporka'] = md5($_POST['zaporka']);
					if (!get_magic_quotes_gpc()) {

						$_POST['zaporka'] = addslashes($_POST['zaporka']);
						$_POST['korisnicko'] = addslashes($_POST['korisnicko']);

 			}
				// provjeriti postoji li u bazi korisnik s istim korisnickim imenom
				$usercheck = $_POST['korisnicko'];
				$check = mysql_query("SELECT korisnicko FROM korisnici WHERE korisnicko = '$usercheck'") or die(mysql_error());
				$check2 = mysql_num_rows($check);



			// ako se korisnico koristi
				if ($check2 != 0) {

				die('Korisnicko ime '.$_POST['korisnicko'].' se koristi.');

 				}
				
				// upis u bazu
					$check = mysql_query("SELECT * FROM korisnici") or die(mysql_error());
					$check2 = mysql_num_rows($check);
					if($check2 == 0)
					{
							$tipkorisnika = 0;
					}
					if($check2 == 1)
					{
							$tipkorisnika = 1;
					}
				
				 
		
					$sql_forma="INSERT INTO korisnici (ime, prezime, korisnicko, zaporka, e_mail, tip) 
						VALUES ('" .$_POST["ime"]."', '". $_POST["prezime"]."', '".$_POST["korisnicko"]."','".$_POST["zaporka"]."','".$_POST["email"]."', '".$tipkorisnika."')";
					mysql_query($sql_forma);
				
				 
				
					header('Location:unos_korisnika.php');
					echo "Postoji korisnik s tim korisnickim imenom";
					echo "Nismo mogli pohraniti podatke"."<br>".mysql_error();
					
				
		}
	else 
		{
			header('Location:unos_korisnika.php');
		}

		
		



	//ako smo stisnuli gumb za odustani vracamo se na unos korisnika
		
	if ($_POST["odustani"])
		{
	
			header('Location:unos_korisnika.php');
		}

?>