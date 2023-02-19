<?php 
$score;  
$grille;
require_once 'fonctions-2048.php'; ?> 

<!doctype html> 
<!-- Ceci est un commentaire -->
<html> 
	<head>
	 	<meta charset="utf-8" />					
		<title>2048</title>
		<link rel="stylesheet" href="styles2048.css" />
	</head> 
	<body> 
			
		<h1>2048 </h1> 
		<h2>Faites glisser des tuiles sur une grille, pour combiner les tuiles de mêmes valeurs et créer ainsi une tuile portant le nombre 
		2048.</h2>
		
		<?php 
		
		if ($_GET['action-joueur'] == "Recommencer") 
		{ 
			nouvelle_partie(); 
		} 
		else { 
			fichier_vers_matrice(); fichier_vers_score();
			if (grille_pleine() && fusion_ligne_impos() && fusion_col_impos() ) 
			{ 
				echo "<div style='text-align: center; font-size: 30pt;background-color: #BA2F2F; color : white; border-radius: 10px;'>". 'La partie est perdue'. "</div>";
			}
			else 
			{
				switch ($_GET['action-joueur']) 
			{
				case '<':
				for ($l = 0; $l < 4; $l++) {decale_ligne_gauche($l);}for ($l = 0; $l < 4; $l++) {fusion_ligne_gauche($l);}
				break;
				case '>':
				for ($l = 0; $l < 4; $l++) {decale_ligne_droite($l);}for ($l = 0; $l < 4; $l++) {fusion_ligne_droite($l);}
				break;
				case '^':
				for ($c = 0; $c < 4; $c++) {decale_col_haut($c);}for ($c = 0; $c < 4; $c++) {fusion_col_haut($c);}
				break;
				case 'v':
				for ($l = 0; $l < 4; $l++) {decale_col_bas($l);}for ($c = 0; $c < 4; $c++) {fusion_col_bas($c);}
				break;
				
			}place_nouveau_nb(); 
			}} ?>
			
		<h3 class="score">Score: <?php  echo $score; ?>	</h3> 
		

				<table class="grille">
						<?php 
						for ($i = 0; $i < 4;$i++)
						{
							echo '<tr class="ligne">';
							for ($g = 0; $g < 4;$g++)
							{							
								 affiche_case($i,$g);
							}
							echo '</tr>';
						}		
						?>	
						
				</table> <br/> 
		<form name="jeu-2048" method="get" action="action.php">
			<center> <input class="recommencer" type="submit" name="action-joueur" value="Recommencer" /></center> <br/>
			<input class="bouton" type="submit" name="action-joueur" value="^" style="margin-left: 185px; height: 30px"/> <br/>
			<input class="bouton" type="submit" name="action-joueur" value="<" style="margin-left: 155px; width: 40px"/> 
			<input class="bouton" type="submit" name="action-joueur" value=">" style="margin-left: -2px; width: 40px"/> <br/>
			<input class="bouton" type="submit" name="action-joueur" value="v" style="margin-left: 185px; height: 30px"/>
		</form> <br/><br/>
		<?php  matrice_vers_fichier(); score_vers_fichier();?>
		
	</body> 
</html> 
	
