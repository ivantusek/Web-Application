<?php
if (isset($_POST['trazenje'])) 
{
	include "konekcija.php";
	$col = $_POST['ime'];
	$col = addslashes($col);
	$col2 = $_POST['prezime'];
	$col2 = addslashes($col2);
	$col3 = $_POST['email'];
	$col3 = addslashes($col3);
	

		/* selektuje iz tablice tablica1 onu kolonu cije je ime izabrani tip pretrage, 
		a one redove koji u sebi sadrzi istu ili slicnu kljucnu rijec pretrage */
$upit = "SELECT COUNT(*) FROM korisnici WHERE ime LIKE '%".$col."%' AND prezime LIKE '%".$col2."%' AND e_mail LIKE '%".$col3."%' "; 
$result = mysql_query($upit);
$r = mysql_fetch_row($result);
$numrows = $r[0];
// broj redova koji se prikazuju po stranici
$rowsperpage = 10;
// pronalazak ukupno stranica
$totalpages = ceil($numrows / $rowsperpage);
// trenutna stranica
if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
   $currentpage = (int) $_GET['currentpage'];
} else {
   // trenutna stranica
   $currentpage = 1;
} 

// ako je trenutna stranica veca od ukupnog broja stranica...
if ($currentpage > $totalpages) {
   // postavi na zadnju
   $currentpage = $totalpages;
} // end if
// ako je trenutna stranica manja od ukupnog broja stranica... <1
if ($currentpage < 1) {
   // postavi na prvu
   $currentpage = 1;
} 

$offset = ($currentpage - 1) * $rowsperpage;

	$rezultat = mysql_query("SELECT * FROM korisnici WHERE ime LIKE '%".$col."%' AND prezime LIKE '%".$col2."%' AND e_mail LIKE '%".$col3."%'LIMIT $offset, $rowsperpage ");
	$br_rezultata = mysql_num_rows($rezultat);
	if ($col =='' && $col2 =='' && $col3 =='')
	{
		header('Location:ispis_korisnika.php');
	}
	else {
	
		/* brojac koji broji koliko ima rezultata pretrage */
		
		echo "Broj rezultata je ".$br_rezultata."<br>";
		echo '<br><br>';
	
	echo '<table width="100%" border="1px" cellpadding="2" cellspacing="2" align="center" style="text-align:center; font-size:70%">';
	echo '<tr><td><b>Id</b></td>';
	echo '<td><b>Ime</b></td>';
	echo '<td><b>Prezime</b></td>';
	echo '<td><b>Korisnicko</b></td>';
//	echo '<td><b>Zaporka</b></td>';
	echo '<td><b>E-mail</b></td></td>';
	echo '<td><b>Tip korisnika</b></td></td>';
	
	
	
		
	while ($redak=mysql_fetch_array($rezultat))
		{
		echo '<tr><td>'.$redak["id"].'</td>';
		echo '<td>'.$redak["ime"].'</td>';
		echo '<td>'.$redak["prezime"].'</td>';
		echo '<td>'.$redak["korisnicko"].'</td>';
//		echo '<td>'.$redak["zaporka"].'</td>';
		echo '<td>'.$redak["e_mail"].'</td>';
			if($redak["tip"] == 0)
		{
			echo '<td>Administrator</td>';
		}
		else
		{
			echo '<td>Korisnik</td>';
		}
		echo '<td><a href="izmjeni_korisnika.php?id='.$redak["id"].' ">Uredi</a></td>';
		echo '<td><a href="obrisi_korisnika.php?brisanje=brisi&id='.$redak["id"].' ">Obrisi</a></td>';
		echo '<td><a href="dohvati_korisnika.php?id='.$redak["id"].' ">Dohvati</a></td>';
	
		echo '</tr>';
		}
		echo '</table>';

// prikazi broj stranica (range)
$range = 3;

if ($currentpage > 1) {
   // prikazi link za prvu stranicu
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1'>Prva</a> ";
   // vrijednost prethodne stranice
   $prevpage = $currentpage - 1;
   // prikazi link za prethodnu stranicu
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'>Prethodna</a> ";
} // end if 

// petlja koja provjerava stranice oko trenutne
for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
   // ako je provjeren broj stranica
   if (($x > 0) && ($x <= $totalpages)) {
      // ako je na trenutnoj stranici
      if ($x == $currentpage) {
         // osvjetli, ali nemoj staviti link
         echo " [<b>$x</b>] ";
      // ako nije na trenutnoj stranici
      } else {
         echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a> ";
      } // end else
   } // end if 
} // end for
                       
if ($currentpage != $totalpages) {
   // vrijednost sljedece stranice
   $nextpage = $currentpage + 1;
    // prikazi link za sljedecu stranicu
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>Sljedeca</a> ";
   // prikazi link za zadnju stranicu
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>Zadnja</a> ";
} // end if


}
}
else 
{  

$sql_upit = "SELECT COUNT(*) FROM korisnici"; 
$result = mysql_query($sql_upit);
$r = mysql_fetch_row($result);
$numrows = $r[0];
// broj redova koji se prikazuju po stranici
$rowsperpage = 5;
// pronalazak ukupno stranica
$totalpages = ceil($numrows / $rowsperpage);
// trenutna stranica
if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
   $currentpage = (int) $_GET['currentpage'];
} else {
   // trenutna stranica
   $currentpage = 1;
} // end if

// ako je trenutna stranica veca od ukupnog broja stranica...
if ($currentpage > $totalpages) {
   // postavi na zadnju
   $currentpage = $totalpages;
} // end if
// ako je trenutna stranica manja od ukupnog broja stranica... <1
if ($currentpage < 1) {
   // postavi na prvu
   $currentpage = 1;
} // end if

// the offset of the list, based on current page 
$offset = ($currentpage - 1) * $rowsperpage;


$sql = "SELECT * FROM korisnici LIMIT $offset, $rowsperpage";

		if (!$q=mysql_query($sql))
			{
				echo "Nismo uspjeli ucitati korisnike iz baze"."<br/>".mysql_error();
				die();
			}
		//ako je broj redaka nula onda nema tema u bazi
		if (mysql_num_rows($q)==0)
			{
									echo '<script language="javascript">';
									echo 'alert("Nema korisnika u bazi!")'.mysql_error();
									echo '</script>';
			}
		else 
			{

	echo '<table width="100%" border="1px" cellpadding="2" cellspacing="2" align="center" style="text-align:center; font-size:70%">';
	echo '<tr><td><b>Id</b></td>';
	echo '<td><b>Ime</b></td>';
	echo '<td><b>Prezime</b></td>';
	echo '<td><b>Korisnicko</b></td>';
//	echo '<td><b>Zaporka</b></td>';
	echo '<td><b>E-mail</b></td></td>';
	echo '<td><b>Tip korisnika</b></td></td>';
	
	
	
		
	while ($redak=mysql_fetch_array($q))
		{
		echo '<tr><td>'.$redak["id"].'</td>';
		echo '<td>'.$redak["ime"].'</td>';
		echo '<td>'.$redak["prezime"].'</td>';
		echo '<td>'.$redak["korisnicko"].'</td>';
	//	echo '<td>'.$redak["zaporka"].'</td>';
		echo '<td>'.$redak["e_mail"].'</td>';
		
		if($redak["tip"] == 0)
		{
			echo '<td>Administrator</td>';
		}
		else
		{
			echo '<td>Korisnik</td>';
		}
		echo '<td><a href="izmjeni_korisnika.php?id='.$redak["id"].' ">Uredi</a></td>';
		echo '<td><a href="obrisi_korisnika.php?brisanje=brisi&id='.$redak["id"].' ">Obrisi</a></td>';
		echo '<td><a href="dohvati_korisnika.php?id='.$redak["id"].' ">Dohvati</a></td>';
	
		echo '</tr>';
		}
		echo '</table>';

// prikazi broj stranica (range)
$range = 3;


if ($currentpage > 1) {
   // prikazi link za prvu stranicu
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1'>Prva</a> ";
   // vrijednost prethodne stranice
   $prevpage = $currentpage - 1;
   // prikazi link za prethodnu stranicu
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'>Prethodna</a> ";
} // end if 

// petlja koja provjerava stranice oko trenutne
for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
   // ako je provjeren broj stranica
   if (($x > 0) && ($x <= $totalpages)) {
      // ako je na trenutnoj stranici
      if ($x == $currentpage) {
         // osvjetli, ali nemoj staviti link
         echo " [<b>$x</b>] ";
      // ako nije na trenutnoj stranici
      } else {
         echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a> ";
      } // end else
   } // end if 
} // end for
                 
    
if ($currentpage != $totalpages) {
   // vrijednost sljedece stranice
   $nextpage = $currentpage + 1;
    // prikazi link za sljedecu stranicu
       echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>Sljedeca</a> ";
   // prikazi link za zadnju stranicu
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>Zadnja</a> ";
} // end if

}
	}

	
?>