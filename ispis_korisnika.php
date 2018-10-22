<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/ispis_korisnika_stil.css" />
<title> Diplomski rad </title>
</head>

<body>
        
        <div id="leftmenu">

        <div id="leftmenu_top"></div>

				<div id="leftmenu_main">  
									
                
                <h3> IZBORNIK </h3>
                        
                
                  <ul>
                     <a href="naslovna.php">Naslovna</a>
					 <a href="unos_kontakta.php">Unos kontakta</a>
					 <a href="svi_kontakti.php">Svi kontakti</a>
					 <a href="ispis_kontakta.php">Uredi kontakt</a>
					 <a href="grupe.php">Kreiranje grupe</a>
					
					 
					 <?php
				
				session_start();
			
				if ($_SESSION['tip'] == 0)
				{
				echo '<ul>';
                   
				   echo ' <a href="unos_korisnika.php">Unos korisnika</a>';
				   echo ' <a href="ispis_korisnika.php">Opcije korisnika</a>';
				  
				echo '</ul>';
				}
				?>
					 <a href="odjava.php">Odjava</a>
				</ul>
</div>
                
                
              <div id="leftmenu_bottom"></div>
        </div>
	<div id="naslov">
		<h3> Ovdje mozete vidjeti ispis korisnika  </h3>
		<div class="sadrzaj">
		<br><br>
		<fieldset>
		<legend> Obavijest </legend>
		<p> Za pretragu korisnika upisite u polja ime, prezime ili e-mail.
			Mozete upisati kljucnu rijec korisnika i kliknuti na TRAZI.</p>
		</fieldset>
		
		
		<!-- Forma za ispis korisnika -->
		<br/><br/>
		<fieldset>
		<legend> Trazenje korisnika </legend>
	<form method="post" action="">
	    <tr>
			<td>Ime:</td> 
			<td><input name="ime" type="text"/></td>
		</tr>
		<tr>
			<td>Prezime:</td> 
			<td><input name="prezime" type="text"/></td>
		</tr>
		<tr>
			<td>E-mail:</td> 
		<td><input name="email" type="text"/></td>
		</tr>
		<tr>
		<td><input type="submit" name="trazenje" value="Traži" /></td>
		</td>
		</tr>
	</form>
		</fieldset>
		
		<br><br>
		<?php
		
		include "konekcija.php";
		include "ispis_korisnika_ok.php";
		
		?>
		
		
		
		
		</div>
	</div>
	</body>
</html>