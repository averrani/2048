<!-- jeu-2048.php -->
<html>
 <head>
 	<meta charset="utf-8" />
 	<?php 
 	 /* ici commence le code PHP 
 	 qui va être éxécuté par le serveur */
 	 $TITRE = "2048"; 
 	 // TITRE est une variable qui contient "2048"
 	?>
 	<title>
 	 <?php echo $TITRE; ?>
 	</title>
 </head>
 <body>
 	<h2>Bienvenue dans le jeu 2048 !</h2>
 	<?php
 	 echo "HTTP_USER_AGENT="; echo $_SERVER['HTTP_USER_AGENT']; echo "<br />";
 	 echo "HTTP_HOST="; echo $_SERVER['HTTP_HOST']; echo "<br />";
 	 echo "DOCUMENT_ROOT="; echo $_SERVER['DOCUMENT_ROOT']; echo "<br />";
 	 echo "SCRIPT_FILENAME="; echo $_SERVER['SCRIPT_FILENAME']; echo "<br />";
 	 echo "PHP_SELF="; echo $_SERVER['PHP_SELF']; echo "<br />";
 	 echo "REQUEST_URI="; echo $_SERVER['REQUEST_URI']; echo "<br />";
 	 echo "action-joueur="; echo $_GET['action-joueur']; echo "<br />";	
 	 phpinfo();
 	?>
 </body>
</html>	
