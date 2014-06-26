<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="korisnici_stil.css" />
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
		<h3> Dohvaceni korisnik  </h3>
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
					$sql_upit="SELECT * FROM korisnici WHERE id =".$_GET["id"];
					//provjera ispravnosti upita
					if (!$q=mysql_query($sql_upit))
						{
							echo "Nastala je greska pri trazenju korisnika.<br>".mysql_error();
							$doslo_do_greske=true;
						}
					//je li pribavljen barem jedan podatak
					elseif (mysql_num_rows($q)==0)
						{
							echo "Nema trazenog korisnika.";
							$doslo_do_greske=true;
						}
					else 
						{
							$korisnici=mysql_fetch_array($q);
						}
				}
				//ako nije doslo do pogreske i sve je u redu, prikazi formu za izmjenu podataka
	if (!$doslo_do_greske)
		{
		?>
		<br><br>
		<fieldset>
		<legend> Obavijest </legend>
		<p>Ovjde mozete vidjeti prikaz korisnika. </p>
		</fieldset>
		<br><br>
	<form method="post" action="">
	
		<div class="login-form">
			<div class="form-label">	
			<fieldset>
			<legend> Dohavaceni korisnik </legend>
			<table>
				<!-- Forma upisa korisnika -->
					<input type="hidden" name="id" value="<?=$_GET["id"]?>"/>
					<tr><td>Ime:</td><td>
					<input type="text"   name="ime" style="width:200px" value="<?=$korisnici["ime"]?> "  readonly="readonly"/></td></tr>
					<tr><td></td></tr>
      				<tr><td>Prezime:</td>		
					<td><input type="text"  name="prezime" style="width:200px" value="<?=$korisnici["prezime"]?> "  readonly="readonly" ></td></tr>
					<tr><td></td></tr>
					<tr><td>Korisnicko:</td>		
					<td><input type="text"  name="korisnicko" style="width:200px" value="<?=$korisnici["korisnicko"]?> "  readonly="readonly" /></td></tr>
					<tr><td></td></tr>
					<tr><td>E-mail:</td>		
					<td><input type="text"  name="email" style="width:200px"value="<?=$korisnici["e_mail"]?> "  readonly="readonly" /></td></tr>
					<tr><td></td></tr>
					
				</table>
					 
			</fieldset>
			<br><br>
			<fieldset>
			
			<legend> Tip korisnika </legend>
							<table>		
						<tr><td></td></tr>
						<tr><td> Tip:</td>
					
					  <td>
		
						<?php
						
						
							$query="SELECT * FROM korisnici WHERE korisnicko ='". $korisnici["korisnicko"]."'"; 
							$q=mysql_query($query);
							$broj = mysql_num_rows($q);
							
		                    $query = mysql_fetch_row($q);
		                    if($korisnici["tip"] == 0)
		                    {
		                    	echo 'Administrator';
		                    }
		                    else
		                    {
		                    	echo 'Korisnik';
		                    }
		                ?>
						</td></tr>
						</table>
						</fieldset>
				</div>
		</div>
	
			<br><br>
		<div class="login-form">
			<div class="form-label">
				<p>
					<input type="submit" name="spremi" value="Potvrdi"/>
					<input type="submit" name="odustani" value="Odustani"/>
				</p>
       		</div>
		</div>
		<?php
		}
}
	else 
		{
			$sql_update=("UPDATE korisnici SET ime='".$_POST["ime"]."', prezime='".$_POST["prezime"]."',korisnicko='".$_POST["korisnicko"]."', zaporka='".$_POST["zaporka"]."', e_mail='".$_POST["email"]."' 
							WHERE id=".$_POST["id"]."");		
							if (mysql_query($sql_update))
							{
								if (mysql_affected_rows() > 0 ) 
							{
								header('Location:ispis_korisnika.php');
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
				header('Location:unos_korisnika.php');
			}

?>
		
				
       	
		

		</form>
		</div>
</div>
	</body>
</html>
