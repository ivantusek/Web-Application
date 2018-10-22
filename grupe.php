<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/grupe_stil.css" />
<title> Diplomski rad </title>
<script type="text/javascript">
			
			function provjeriFormu(forma)
			{
				var razlog = "";
				razlog += provjeriPrazno(forma.grupa);
				
			
				if(razlog != "")
				{
					alert("Nisu popunjena sva polja:\n" + razlog);
					return false;
				}
				else
					return true;
			}
			function provjeriPrazno(polje)
			{
				var greska = "";
				if(polje.value.length == 0)
				{
					polje.style.background = 'Yellow';
					greska = "Polje " + polje.name + " je ostavljeno prazno.\n";
				}
				else
				{
					polje.style.background = 'White';
				}
				return greska;
			}
			function provjeriOznaceno(oznaka)
			{
				var greska = "";
				if(oznaka[0].checked == false && oznaka[1].checked == false)
				{
					greska = "Potrebno je odabrati tip korisnika.\n";
				}
				return greska;
			}
		</script>
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
		 </div>
		 
		<div id="naslov">
		<h3> Ovdje mozete vidjeti kreirane grupe  </h3>
		<div class="sadrzaj">
		<br><br>
		<fieldset>
		<legend> Obavijest </legend>
		<p> Za kreiranje grupe unesite u polje za kreiranje ime grupe,
			a kada ste unnjeli ime kliknite na KREIRAJ ili ako ne onda BRISI.</p>
		</fieldset>
		
		
		<!-- Forma za ispis korisnika -->
		<br/><br/>
		<fieldset>
		<legend> Kreiranje grupe </legend>
	<form method="post" action="grupe_unos.php" onsubmit="return provjeriFormu(this)">
	    <tr>
			<td>Kreiraj grupu:</td> 
			<td><input name="grupa" type="text"/></td>
		</tr>
		
	
		</fieldset>
			
			<br><br>
					<input type="submit" name="spremi" value="Kreiraj"/>
					<input type="submit" name="obrisi" value="Brisi"/>
				
	</form>
		<br><br>
							<?php
							include "konekcija.php";
							include "grupe_ispis.php";

							?>
				</div>
		</div>
	
		
				
       		
				
       	
		

		
		</div>
</div>
	</body>
</html>