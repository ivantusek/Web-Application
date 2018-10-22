 
<?php
 ob_start(); 
	if (isset($_POST['trazenje'])) {
	
	include "config/konekcija.php";
	$col = $_POST['ime'];
	$col = addslashes($col);
	$col2 = $_POST['prezime'];
	$col2 = addslashes($col2);
	$col3 = $_POST['email'];
	$col3 = addslashes($col3);
	
	
	
	$upit = "SELECT COUNT(*) FROM kontakti WHERE ime LIKE '%".$col."%' AND prezime LIKE '%".$col2."%' AND e_mail LIKE '%".$col3."%' "; 
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

	$rezultat = mysql_query("SELECT * FROM kontakti WHERE ime LIKE '%".$col."%' AND prezime LIKE '%".$col2."%' AND e_mail LIKE '%".$col3."%'LIMIT $offset, $rowsperpage ");
	$br_rezultata = mysql_num_rows($rezultat);
	if ($col =='' && $col2 =='' && $col3 =='')
	{
		header('Location:ispis_kontakta.php');
	}
	else {
	
		/* brojac koji broji koliko ima rezultata pretrage */

		echo "Broj rezultata je ".$br_rezultata."<br>";
		echo '<br><br>';
	
	echo '<table width="100%" border="1px" cellpadding="2" cellspacing="2" align="center" style="text-align:center; font-size:70%">';
	echo '<tr><td><b>Id</b></td>';
	echo '<td><b>Ime</b></td>';
	echo '<td><b>Prezime</b></td>';
	echo '<td><b>Zvanje</b></td>';
	echo '<td><b>Titula</b></td>';
	echo '<td><b>Grad</b></td></td>';
	echo '<td><b>Adresa</b></td></td>';
	echo '<td><b>E-mail</b></td></td>';
	echo '<td><b>Zip Code</b></td></td>';
	echo '<td><b>Grupa</b></td></td>';
	
	
	
		
	while ($redak=mysql_fetch_array($rezultat))
		{
		echo '<tr><td>'.$redak["id"].'</td>';
		echo '<td>'.$redak["ime"].'</td>';
		echo '<td>'.$redak["prezime"].'</td>';
		echo '<td>'.$redak["zvanje"].'</td>';
		echo '<td>'.$redak["titula"].'</td>';
		echo '<td>'.$redak["grad"].'</td>';
		echo '<td>'.$redak["adresa"].'</td>';
		echo '<td>'.$redak["e_mail"].'</td>';
		echo '<td>'.$redak["code"].'</td>';
		echo '<td>'.$redak["grupa"].'</td>';
		echo '<td><a href="izmjeni.php?id='.$redak["id"].' ">Uredi</a></td>';
		echo '<td><a href="obrisi_kontakt.php?brisanje=brisi&id='.$redak["id"].' ">Obrisi</a></td>';
		echo '<td><a href="dodaj_grupu.php?id='.$redak["id"].' ">Dodaj grupu</a></td>';
		echo '<td><a href="dohvati_kontakt.php?id='.$redak["id"].' ">Dohvati</a></td>';
		
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

$sql_upit = "SELECT COUNT(*) FROM kontakti"; 
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


$sql = "SELECT * FROM kontakti LIMIT $offset, $rowsperpage";

		if (!$q=mysql_query($sql))
			{
				echo "Nismo uspjeli ucitati kontakte iz baze"."<br/>".mysql_error();
				die();
			}
		//ako je broj redaka nula onda nema tema u bazi
		if (mysql_num_rows($q)==0)
			{
									echo '<script language="javascript">';
									echo 'alert("Nema kontakata u bazi!")'.mysql_error();
									echo '</script>';
			}
		else 
			{

	echo '<table width="100%" border="1px" cellpadding="2" cellspacing="2" align="center" style="text-align:center; font-size:70%">';
	echo '<tr><td><b>Id</b></td>';
	echo '<td><b>Ime</b></td>';
	echo '<td><b>Prezime</b></td>';
	echo '<td><b>Zvanje</b></td>';
	echo '<td><b>Titula</b></td>';
	echo '<td><b>Grad</b></td></td>';
	echo '<td><b>Adresa</b></td></td>';
	echo '<td><b>E-mail</b></td></td>';
	echo '<td><b>Zip Code</b></td></td>';
	echo '<td><b>Grupa</b></td></td>';
	
	
	
		
	while ($red=mysql_fetch_array($q))
		{
		echo '<tr><td>'.$red["id"].'</td>';
		echo '<td>'.$red["ime"].'</td>';
		echo '<td>'.$red["prezime"].'</td>';
		echo '<td>'.$red["zvanje"].'</td>';
		echo '<td>'.$red["titula"].'</td>';
		echo '<td>'.$red["grad"].'</td>';
		echo '<td>'.$red["adresa"].'</td>';
		echo '<td>'.$red["e_mail"].'</td>';
		echo '<td>'.$red["code"].'</td>';
		echo '<td>'.$red["grupa"].'</td>';
		echo '<td><a href="izmjeni.php?id='.$red["id"].' ">Uredi</a></td>';
		echo '<td><a href="obrisi_kontakt.php?brisanje=brisi&id='.$red["id"].' ">Obrisi</a></td>';
		echo '<td><a href="dodaj_grupu.php?id='.$red["id"].' ">Dodaj grupu</a></td>';
		echo '<td><a href="dohvati_kontakt.php?id='.$red["id"].' ">Dohvati</a></td>';

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
		
	
	if (isset($_POST['dodaj_kontakt'])) 
	{
		header('Location:unos_kontakta.php');
	} 
	 ob_flush(); 
	
?>