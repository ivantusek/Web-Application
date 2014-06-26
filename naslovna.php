<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="stil.css" />
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
		<h3> Baza kontakata </h3>
		<p class="sadrzaj">
		<br>
		
		      
		        <!-- Umetanje slika na naslovnu stranicu -->
				<tr>
                  <td><img src="images/logo2.png" width="200" height="150" border="0"></a></td>
				  <td><img src="images/logo.png" width="200" height="150" border="0"></a></td>                 
                </tr>
                <tr>
			
		</p>
	
   </div>
</body>
</html>
