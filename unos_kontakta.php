<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/kontakti_stil.css" />
<title> Diplomski rad </title>
<script type="text/javascript">
			
			function provjeriFormu(forma)
			{
				var razlog = "";
				razlog += provjeriPrazno(forma.ime);
				razlog += provjeriPrazno(forma.prezime);
				razlog += provjeriPrazno(forma.zvanje);
				razlog += provjeriPrazno(forma.titula);
				razlog += provjeriPrazno(forma.grad);
				razlog += provjeriPrazno(forma.adresa);
				razlog += provjeriPrazno(forma.email);
				razlog += provjeriPrazno(forma.code);
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
					greska = "Potrebno je odabrati grupu kontakta.\n";
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
		<div id="naslov">
		<h3> Ovdje mozete upisati kontakt u bazu  </h3>
		<div class="sadrzaj">
		<br><br>
		<fieldset>
		<legend> Obavijest </legend>
		<p> Za unos kontakta trebate popunuti sva polja.
			Kada ste unjeli kontakt mozete potvrditi klikom na tipku POTVRDI ili ODUSTANI.</p>
		</fieldset>
		<br><br>
	<form method="post" action="unos_kontakta_ok.php" onsubmit="return provjeriFormu(this)">
	
		<div class="login-form">
			<div class="form-label">	
			<fieldset>
			<legend > Unos kontakta </legend>
			<table>
				<!-- Forma upisa korisnika -->
					<tr><td>Ime:</td><td>
					<input type="text"   name="ime" style="width:200px" onsubm /></td></tr>
					<tr><td></td></tr>
      				<tr><td>Prezime:</td>		
					<td><input type="text"  name="prezime" style="width:200px" ></td></tr>
					<tr><td></td></tr>
					<tr><td>Zvanje:</td>		
					<td><input type="text"  name="zvanje" style="width:200px" /></td></tr>
					<tr><td></td></tr>
					<tr><td>Titula:</td>		
					<td><input type="text"  name="titula" style="width:200px" /></td></tr>
					<tr><td></td></tr>
					<tr><td>Grad:</td>		
					<td><input type="text"  name="grad" style="width:200px" /></td></tr>
					<tr><td></td></tr>
					<tr><td>Adresa:</td>		
					<td><input type="text"  name="adresa" style="width:200px" /></td></tr>
					<tr><td></td></tr>
					<tr><td>E-mail:</td>		
					<td><input type="text"  name="email" style="width:200px" /></td></tr>
					<tr><td></td></tr>
					<tr><td>Zip code</td>
					<td><input type="text"  name="code" style="width:200px" /></td></tr>
					</table>
					</fieldset>
					<br><br>
					
				
					<fieldset>
					<legend> Grupa kontakta </legend>
			<table>
					<tr><td>Grupa:</td>
					  <td><select  name="grupa" />
						<option value=" ">Nema</option>';
						<?php
							include "konekcija.php";
							$query="SELECT * FROM grupe";
							$q=mysql_query($query);
							$brojgrupa = mysql_num_rows($q);
							
		                    while($upit = mysql_fetch_row($q))
		                    	echo '<option value="', $upit[1], '">', $upit[1], '</option>';

                         
						?>
                           </select></td></tr>
					
				
					 
			</table>
				</div>
		</div>
	
		
		<div class="login-form">
			<div class="form-label">
			<br><br>
				<p>
					<input type="submit" name="spremi" value="Potvrdi"/>
					<input type="submit" name="odustani" value="Odustani"/>
				</p>
       		</div>
		</div>
		
				
       	
		

		</form>
		</div>
</div>
	</body>
</html>
