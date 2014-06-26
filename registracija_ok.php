 
 <?php
 //spoj na bazu
 include "konekcija.php";
 
 // kada se klikne registracija tipka
	if (isset($_POST['register'])) { 



 //da su popunjena sva polja
	if (!$_POST['ime'] | !$_POST['prezime'] | !$_POST['korisnicko'] | !$_POST['email'] | !$_POST['zaporka'] | !$_POST['zaporkap'] ) {

 		die('Niste popunili sva polja!');

 	}



 // ako se korisnicko koristi
	if (!get_magic_quotes_gpc()) {

 		$_POST['korisnicko'] = addslashes($_POST['korisnicko']);

 	}

 $usercheck = $_POST['korisnicko'];
 $check = mysql_query("SELECT korisnicko FROM korisnici WHERE korisnicko = '$usercheck'") or die(mysql_error());
 $check2 = mysql_num_rows($check);



 // ako se korisnico koristi
	if ($check2 != 0) {

 		die('Korisnicko ime '.$_POST['korisnicko'].' se koristi.');

 				}


 // ako se zaporke ne podudaraju
	if ($_POST['zaporka'] != $_POST['zaporkap'])
	{

 		die('Zaporke se ne podudaraju ');

 	}



 	// md5 enkripcija
	$_POST['zaporka'] = md5($_POST['zaporka']);
	if (!get_magic_quotes_gpc()) {

 		$_POST['zaporka'] = addslashes($_POST['zaporka']);
		$_POST['korisnicko'] = addslashes($_POST['korisnicko']);

 			}



 // upis u bazu
	$check = mysql_query("SELECT * FROM korisnici") or die(mysql_error());
	$check2 = mysql_num_rows($check);
	if($check2 == 0)
	{
            $tipkorisnika = 0;
	}
	else
	{
			$tipkorisnika = 1;
	}
 	$insert = "INSERT INTO korisnici (ime, prezime, korisnicko, e_mail, zaporka, tip)
			   VALUES ('".$_POST['ime']."', '".$_POST['prezime']."', '".$_POST['korisnicko']."', '".$_POST['email']."', '".$_POST['zaporka']."', '".$tipkorisnika."')";
 	$add_member = mysql_query($insert);
									
								


							
									echo '<script language="javascript">';
									echo 'alert("Uspijesno ste se registrirali!")'.mysql_error();
									echo '</script>';
									
									header ("Location:index.html");
	}
 	?>