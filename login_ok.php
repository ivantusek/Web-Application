
<?php
//spoj na bazu
	include "config/konekcija.php";

//klik na tipku login
	if (isset($_POST['login'])) { 

 		// da su popunjena sva polja
		if(!$_POST['korisnicko'] | !$_POST['zaporka'])
		{

 			die('Niste popunili sva polja.');

 		}

	 	// provjera korisnika
		$check = mysql_query("SELECT * FROM korisnici WHERE korisnicko = '".$_POST['korisnicko']."'")or die(mysql_error());
	
		
	
		//greska ako ne postoji korisnik
		$check2 = mysql_num_rows($check);
		if ($check2 == 0) 
		{
			die('Korisnik ne postoji u bazi. <a href=registracija.html>Ovdje se registrirajte.</a>');
		}

 
		$info = mysql_fetch_array( $check );
		$_POST['zaporka'] = stripslashes($_POST['zaporka']);
		
		$info['pass'] = stripslashes($info['zaporka']);
		
		$_POST['zaporka'] = md5($_POST['zaporka']);



		//ako zaporka nije tocna
		if ($_POST['zaporka'] != $info['pass'])
		{
	
			die('Pogresna zaporka, pokusajte ponovo.');
	
	 	}
		else 
	    {
			$tip = $info['tip'];
			//printf("<p>Tip korisnika u bazi: %d</p>", $tip);
			session_start();
			$_SESSION['tip'] = $tip;
			//printf("<p>Tip korisnika: %d</p>", $_SESSION['tip']);
			header("Location: naslovna.php");
		}
	}
	
	// klik na odustani vraca prazna polja
	 if (isset($_POST['reset']))
	 {
	 header("Location: index.html");
	}
?>