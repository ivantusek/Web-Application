<?php
include "config/konekcija.php";
$sql_upit = "SELECT COUNT(*) FROM grupe"; 
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


$sql = "SELECT * FROM grupe LIMIT $offset, $rowsperpage";

		if (!$q=mysql_query($sql))
			{
				echo "Nismo uspjeli ucitati kontakte iz baze"."<br/>".mysql_error();
				die();
			}
		//ako je broj redaka nula onda nema tema u bazi
		if (mysql_num_rows($q)==0)
			{
									echo '<script language="javascript">';
									echo 'alert("Nema grupa u bazi!")'.mysql_error();
									echo '</script>';
			}
		else 
			{

	echo '<table width="100%" border="1px" cellpadding="2" cellspacing="2" align="center" style="text-align:center; font-size:70%">';
	echo '<tr><td><b>Id</b></td>';
	echo '<td><b>Ime</b></td>';
	
	
	
	
		
	while ($red=mysql_fetch_array($q))
		{
		echo '<tr><td>'.$red["id"].'</td>';
		echo '<td>'.$red["ime"].'</td>';
		echo '<td><a href="izmjeni_grupe.php?id='.$red["id"].' ">Uredi</a></td>';
		echo '<td><a href="obrisi_grupe.php?brisanje=brisi&id='.$red["id"].' ">Obrisi</a></td>';
		echo '<td><a href="dohvati_grupe.php?id='.$red["id"].' ">Dohvati</a></td>';

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

?>