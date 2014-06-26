<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="grupe_stil.css" />
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
		 </div>
		 
		<div id="naslov">
		<h3> Ovdje mozete uređivati grupe  </h3>
		<div class="sadrzaj">
		<?php
	include "konekcija.php";
	//provjeravamo je li korisnik kliknuo gumb za spremanje uredenih podataka
	if (!isset($_POST["spremi"]))
		{
			//zastavica ide na true ako je doslo do greske
			$doslo_do_greske=false;
			//jesmo li pribavili id studenta
			if (!$_GET["id"])
				{
					echo "Doslo je do pogreske u pribavljanju rednog broja .";
					$doslo_do_greske=true;
				} 
			else 
				{
					//ispis svih studenata u bazi sortiranih po id
					$sql_upit="SELECT * FROM grupe WHERE id =".$_GET["id"];
					//provjera ispravnosti upita
					if (!$q=mysql_query($sql_upit))
						{
							echo "Nastala je greska pri trazenju grupe.<br>".mysql_error();
							$doslo_do_greske=true;
						}
					//je li pribavljen barem jedan podatak
					elseif (mysql_num_rows($q)==0)
						{
							echo "Nema trazene grupe.";
							$doslo_do_greske=true;
						}
					else 
						{
							$grupe=mysql_fetch_array($q);
						}
				}
				//ako nije doslo do pogreske i sve je u redu, prikazi formu za izmjenu podataka
	if (!$doslo_do_greske)
		{
     ?>
		<br><br>
		<fieldset>
		<legend> Obavijest </legend>
		<p> Za izmjenu grupe promjenite ime postojece grupe. Zatim kliknite na SPREMI ili BRISI. </p>
		</fieldset>
		
		
		<!-- Forma za ispis korisnika -->
		<br/><br/>
		<fieldset>
		<legend> Izmjena grupe </legend>
	<form method="post" action="">
	    <tr>
			<td>Izmjeni grupu:</td> 
			<input type="hidden" name="id" value="<?=$_GET["id"]?>"/>
			<td><input name="grupa" type="text" value ="<?=$grupe["ime"]?>" /></td>
		</tr>
		
	
		</fieldset>
			
			<br><br>
					<input type="submit" name="spremi" value="Spremi"/>
					<input type="submit" name="obrisi" value="Brisi"/>
				
	</form>
		<br><br>
							
				</div>
		</div>
		<?php
		}
}
	else 
		{
			$sql_update=("UPDATE grupe SET ime='".$_POST["grupa"]."'
							WHERE id=".$_POST["id"]."");		
							if (mysql_query($sql_update))
							{
								if (mysql_affected_rows() > 0 ) 
							{
								header('Location:grupe.php');
							} 
						else 
							{
								echo "Nismo uspjeli izmijeniti podatke o kontaktu.";
							}
					}
				else 
					{
						echo "Nastala je greska pri upisivanju podataka u bazu.".mysql_error();
					}
			}
	if (isset($_POST['odustani']))
	
			{
				header('Location:grupe.php');
			}

?>
	
		
				
		</form>       		
				
       	
		

		
		</div>
</div>
	</body>
</html>