<?php
	$konekcija = mysql_connect('localhost', 'root', '') or
	die('Unable to connect. Check connection parameters.');
	mysql_select_db('baza', $konekcija) or
	die(mysql_error($konekcija));
	
	$test1 = mysql_query("SHOW TABLES LIKE korisnici");
	if(!$test1)
	{
		$create = "CREATE TABLE `korisnici`(
					`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
					`ime` varchar(30) NOT NULL,
					`prezime` varchar(30) NOT NULL,
					`korisnicko` varchar(30) NOT NULL,
					`zaporka` varchar(50) NOT NULL,
					`e_mail` varchar(30) NOT NULL,
					`tip` int(10)  NOT NULL,
					
			PRIMARY KEY (`id`)
					)ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
		mysql_query($create);
	}
	 
	 $test1 = mysql_query("SHOW TABLES LIKE kontakti");
	if(!$test1)
	{
		$create = "CREATE TABLE `kontakti`(
					`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
					`ime` varchar(30) NOT NULL,
					`prezime` varchar(30) NOT NULL,
					`zvanje` varchar(30) NOT NULL,
					`titula` varchar(30) NOT NULL,
					`grad`  varchar(30) NOT NULL,
					`adresa` varchar(30) NOT NULL,
					 `e_mail` varchar(30) NOT NULL,
					 `code` varchar(30) NOT NULL,
					 `grupa` varchar(30) NOT NULL,
					
			PRIMARY KEY (`id`)
					)ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
		mysql_query($create);
	
	}
	
	$test1 = mysql_query("SHOW TABLES LIKE grupe");
	if(!$test1)
	{
		$create = "CREATE TABLE `grupe`(
					`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
					`ime` varchar(30) NOT NULL,
					
					
			PRIMARY KEY (`id`)
					)ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

		mysql_query($create);
	}

?>   