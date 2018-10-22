<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/ispis_grupe_stil.css" />
<title> Diplomski rad </title>

<script type="text/javascript">
			
			function provjeriFormu(forma)
			{
				var razlog = "";
				razlog += provjeriPrazno(forma.ime);
				razlog += provjeriPrazno(forma.prezime);
				razlog += provjeriPrazno(forma.korisnicko);
				razlog += provjeriPrazno(forma.zaporka);
				razlog += provjeriPrazno(forma.email);
				razlog += provjeriOznaceno(forma.admin_user);
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
		<div id="naslov">
		<h3> Ovdje mozete upisati korisnika u bazu  </h3>
		<div class="sadrzaj">
	
		<br><br>
		<fieldset>
		<legend> Obavijest </legend>
		<p> Za unos korisnika trebate popunuti sva polja.
			Kada ste unjeli korisnika mozete potvrditi klikom na tipku POTVRDI  ili ODUSTANI</p>
		</fieldset>
		<br><br>
	<form method="post" action="unos_korisnika_ok.php" onsubmit="return provjeriFormu(this)">
	
		<div class="login-form">
			<div class="form-label">	
			<fieldset>
			<legend> Unos novog korisnika </legend>
			<table>
				<!-- Forma upisa korisnika -->
					<tr><td>Ime:</td><td>
					<input type="text"   name="ime" style="width:200px"  /></td></tr>
					<tr><td></td></tr>
      				<tr><td>Prezime:</td>		
					<td><input type="text"  name="prezime" style="width:200px" ></td></tr>
					<tr><td></td></tr>
					<tr><td>Korisnicko:</td>		
					<td><input type="text"  name="korisnicko" style="width:200px" /></td></tr>
					<tr><td></td></tr>
					<tr><td>Zaporka:</td>		
					<td><input type="password"  name="zaporka" style="width:200px" /></td></tr>
					<tr><td></td></tr>
					<tr><td>E-mail:</td>		
					<td><input type="text"  name="email" style="width:200px" /></td></tr>
					<tr><td></td></tr>
					
				</table>
					 
			</fieldset>
			<br><br>
		
			<fieldset>
			<legend> Tip korisnika </legend>
			<input type="radio" name="admin_user" value="admin">Administrator<br>
			<input type="radio" name="admin_user" value="user">Korisnik<br>
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
		
				
       	
		

		</form>
		</div>
</div>
	</body>
</html>
