<?php
$con=mysqli_connect("localhost","root","","diplomski");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// Create table
$sql="CREATE TABLE `kontakti`(
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

// Execute query
if (mysqli_query($con,$sql))
  {
  echo "Table korisnici created successfully";
  }
else
  {
  echo "Error creating table: " . mysqli_error($con);
  }
?>