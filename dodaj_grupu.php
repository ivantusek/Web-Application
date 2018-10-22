
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="css/ispis_grupe_stil.css" />
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
		<h3> Ovdje mozete dodati grupu kontaktu   </h3>
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
					$sql_upit="SELECT * FROM kontakti WHERE id =".$_GET["id"];
					//provjera ispravnosti upita
					if (!$q=mysql_query($sql_upit))
						{
							echo "Nastala je greska pri trazenju studenta.<br>".mysql_error();
							$doslo_do_greske=true;
						}
					//je li pribavljen barem jedan podatak
					elseif (mysql_num_rows($q)==0)
						{
							echo "Nema trazenog studenta.";
							$doslo_do_greske=true;
						}
					else 
						{
							$kontakti=mysql_fetch_array($q);
						}
				}
				//ako nije doslo do pogreske i sve je u redu, prikazi formu za izmjenu podataka
	if (!$doslo_do_greske)
		{
		?>
		<br><br>
		<fieldset>
		<legend> Obavijest </legend>
		<p> Za unos grupe kontaktu mozete samo dodati grupu kontaktu.
			Samo su grupe stavljene na izbor, a kada odaberete mozete SPREMITI klikom.</p>
		</fieldset>
		<br><br>
	<form method="post" action="">
	
		<div class="login-form">
			<div class="form-label">	
			<fieldset>
			<legend> Unos kontakta </legend>
			<table>
				<!-- Forma upisa korisnika -->
					<input type="hidden" name="id" value="<?=$_GET["id"]?>"/>
					<tr><td>Ime:</td><td>
					<input type="text"   name="ime"  style="width:200px" value="<?=$kontakti["ime"]?>"  readonly="readonly" /></td></tr>
					<tr><td></td></tr>
      				<tr><td>Prezime:</td>		
					<td><input type="text"  name="prezime"  style="width:200px"  value="<?=$kontakti["prezime"]?>" readonly="readonly" ></td></tr>
					<tr><td></td></tr>
					<tr><td>Zvanje</td>		
					<td><input type="text"  name="zvanje"  style="width:200px"  value="<?=$kontakti["zvanje"]?>" readonly="readonly" /></td></tr>
					<tr><td></td></tr>
					<tr><td>Titula</td>		
					<td><input type="text"  name="titula"  style="width:200px"  value="<?=$kontakti["titula"]?>" readonly="readonly" /></td></tr>
					<tr><td></td></tr>
					<tr><td>Grad:</td>		
					<td><input type="text"  name="grad"  style="width:200px"  value="<?=$kontakti["grad"]?>" readonly="readonly" /></td></tr>
					<tr><td></td></tr>
					<tr><td>Adresa:</td>		
					<td><input type="text"  name="adresa"  style="width:200px"  value="<?=$kontakti["adresa"]?>" readonly="readonly" /></td></tr>
					<tr><td></td></tr>
					<tr><td>E-mail:</td>		
					<td><input type="text"  name="email"  style="width:200px"  value="<?=$kontakti["e_mail"]?>" readonly="readonly" /></td></tr>
					<tr><td></td></tr>
					<tr><td>Zip code</td>
					<td><input type="text"  name="code" style="width:200px"  value="<?=$kontakti["code"]?>" readonly="readonly" /></td></tr>
					</table>
					</fieldset>
					<br><br>
					<fieldset>
					<legend> Dodavanje grupe </legend>
			<table>
					<tr><td>Grupa:</td>
					  <td><select  name="grupa" selected ="<?=$kontakti["grupa"]?>" 
					<!--	<option value=" ">Nema</option> -->
					<br><br>	
						<?php
						
							// Upit u bazu i ispis grupe odabranom kontaktu
							$query="SELECT * FROM kontakti WHERE grupa ='". $kontakti["grupa"]."'";
							$q=mysql_query($query);
							$brojgrupa = mysql_num_rows($q);
							
		                    while($query = mysql_fetch_row($q))
		                    	echo '<option value="', $kontakti["grupa"], '">', $kontakti["grupa"], '</option>';
								?>
						</select></td></tr>	
						</table>
			
			<table>
							<tr><td> Kreirane grupe:</td>
								
					  <td><select  name="grupa">
					<!--	<option value=" ">Nema</option>'; -->
					
						<?php
							
							$query="SELECT * FROM grupe";
							$q=mysql_query($query);
							$brojgrupa = mysql_num_rows($q);
							
		                    while($upit = mysql_fetch_row($q))
		                    	echo '<option value="', $upit[1], '">', $upit[1], '</option>';

                         
						?>
                           
								
								
								
						</select></td></tr>
                         
						</table>
						
					
						
                        
						   
					
				
			</fieldset>
			
			<br><br>
			<input type="submit" name="obrisi" value="Obrisi kontakt"/>
				
					<?php
		
				
				if (isset($_POST['obrisi']))
		{		
			
				if ($_GET["id"])
					{
						$sql_brisi="DELETE FROM kontakti WHERE id=".$_GET["id"];
						if (mysql_query($sql_brisi))
							{					
								header('Location:ispis_kontakta.php');
							}
						else 
							{
								echo "Niste uspjeli obrisati kontakt."."<br>".mysql_error();
							}
					}
			
		}	
?>
					 
				</div>
		</div>
		
		
		
		<div class="login-form">
			<div class="form-label">
			
			<br><br>
				<p>
					<input type="submit" name="spremi" value="Spremi"/>
					<input type="submit" name="odustani" value="Odustani"/>
				</p>
       		</div>
		</div>
	
		<?php
		}
}
	else 
		{
			$sql_update="INSERT INTO kontakti (ime, prezime, titula, zvanje, grad, adresa, e_mail, code, grupa) 
						VALUES ('$_POST[ime]', '$_POST[prezime]', '$_POST[titula]','$_POST[zvanje]','$_POST[grad]','$_POST[adresa]','$_POST[email]','$_POST[code]','$_POST[grupa]')";		
							if (mysql_query($sql_update))
							{
								if (mysql_affected_rows() > 0 ) 
							{
								header('Location:ispis_kontakta.php');
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
				header('Location:ispis_kontakta.php');
			}

?>
				
       	
		

		</form>
		</div>
</div>
	</body>
</html>
