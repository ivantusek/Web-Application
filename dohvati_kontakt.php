
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
		<h3> Dohvaceni kontakt  </h3>
		<div class="sadrzaj">
<?php
	include "config/konekcija.php";
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
		<p>Ovjde mozete vididjeti samo prikaz kontakta ali kontaktu ne mozete nista od ponudenoga mjenjati.</p>
		</fieldset>
		<br><br>
	<form method="post" action="">
	
		<div class="login-form">
			<div class="form-label">	
			<fieldset>
			<legend> Dohvaceni kontakt </legend>
			<table>
				<!-- Forma upisa korisnika -->
					<input type="hidden" name="id" value="<?=$_GET["id"]?>"/>
					<tr><td>Ime:</td><td>
					<input type="text"   name="ime" style="width:200px" value="<?=$kontakti["ime"]?> "  readonly="readonly"/></td></tr>
					<tr><td></td></tr>
      				<tr><td>Prezime:</td>		
					<td><input type="text"  name="prezime" style="width:200px" value="<?=$kontakti["prezime"]?>"   readonly="readonly"/></td></tr>
					<tr><td></td></tr>
					<tr><td>Zvanje:</td>		
					<td><input type="text"  name="zvanje" style="width:200px" value="<?=$kontakti["zvanje"]?>"  readonly="readonly" /></td></tr>
					<tr><td></td></tr>
					<tr><td>Titula:</td>		
					<td><input type="text"  name="titula" style="width:200px" value="<?=$kontakti["titula"]?> "  readonly="readonly"/></td></tr>
					<tr><td></td></tr>
					<tr><td>Grad:</td>		
					<td><input type="text"  name="grad" style="width:200px" value="<?=$kontakti["grad"]?>"  readonly="readonly"/></td></tr>
					<tr><td></td></tr>
					<tr><td>Adresa:</td>		
					<td><input type="text"  name="adresa" style="width:200px" value="<?=$kontakti["adresa"]?>"  readonly="readonly" /></td></tr>
					<tr><td></td></tr>
					<tr><td>E-mail:</td>		
					<td><input type="text"  name="email" style="width:200px" value="<?=$kontakti["e_mail"]?>"  readonly="readonly" /></td></tr>
					<tr><td></td></tr>
					<tr><td>Zip code</td>		
					<td><input type="text"  name="code" style="width:200px" value="<?=$kontakti["code"]?>"  readonly="readonly" /></td></tr>
					</table>
					</fieldset>
					<br><br>
					
				
					<fieldset>
					<legend> Grupa kontakta </legend>
					<table>
					<tr><td></td></tr>
					<tr><td>Grupa:</td>
					  <td><select  name="grupa" selected ="<?=$kontakti["grupa"]?>"  readonly="readonly" />
					<!--	<option  >Nema</option> -->
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
					 
			</fieldset>
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
			$sql_update=("UPDATE kontakti SET ime='".$_POST["ime"]."', prezime='".$_POST["prezime"]."',zvanje='".$_POST["zvanje"]."', titula='".$_POST["titula"]."', grad='".$_POST["grad"]."' , adresa='".$_POST["adresa"]."' , e_mail='".$_POST["email"]."', code='".$_POST["code"]."'
							WHERE id=".$_POST["id"]."");		
							if (mysql_query($sql_update))
							{
								if (mysql_affected_rows() > 0 ) 
							{
								header('Location:svi_kontakti.php');
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
				header('Location:svi_kontakti.php');
			}

?>
				
       	
		

		</form>
		</div>
</div>
	</body>
</html>
