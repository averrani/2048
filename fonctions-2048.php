<?php

function write_log($mesg)
{
	file_put_contents('logs-2048.txt', $mesg."\n", FILE_APPEND);
}

function affiche_sept_variables()
{
	 echo "HTTP_USER_AGENT="; echo $_SERVER['HTTP_USER_AGENT']; echo "<br />";
 	 echo "HTTP_HOST="; echo $_SERVER['HTTP_HOST']; echo "<br />";
 	 echo "DOCUMENT_ROOT="; echo $_SERVER['DOCUMENT_ROOT']; echo "<br />";
 	 echo "SCRIPT_FILENAME="; echo $_SERVER['SCRIPT_FILENAME']; echo "<br />";
 	 echo "PHP_SELF="; echo $_SERVER['PHP_SELF']; echo "<br />";
 	 echo "REQUEST_URI="; echo $_SERVER['REQUEST_URI']; echo "<br />";
 	 echo "action-joueur="; echo $_GET['action-joueur']; echo "<br />";
}

function affiche_logs($nbl)
{
	$logs=file("logs-2048.txt"); 	
	sizeof($logs);
	foreach ($logs as $i => $line) 
{
	  // $logs est un tableau qui contient toutes les lignes du fichier
	  // $i est l'indice du tableau donc le numéro de la ligne - 1 (l'indice commence à 0)
	  // $line contient la ligne d'indice i
	  switch($line)
		{
		 case "haut\n":
		  echo "<span class=\"vert\">Ligne " . ($i+1) . " : " . htmlspecialchars($line) . "</span><br />";
		  break;

		 case "gauche\n":
		  echo "<span class=\"bleu\">Ligne " . ($i+1) . " : " . htmlspecialchars($line) . "</span><br />";
		  break;

		 case "droite\n":
		  echo "<span class=\"rouge\">Ligne " . ($i+1) . " : " . htmlspecialchars($line) . "</span><br />";
		  break;

		 case "bas\n":
		  echo "<span class=\"orange\">Ligne " . ($i+1) . " : " . htmlspecialchars($line) . "</span><br />";
		  break;
		  
		 case "Recommencer\n":
		  echo "<span class=\"gras\">Ligne " . ($i+1) . " : " . htmlspecialchars($line) . "</span><br />";
		  break;

		 default :
		  echo '' ;
		  break;
		}
}}

function score_vers_fichier()
{	
	global $score;
	file_put_contents('score.txt', $score);
}
function fichier_vers_score()
{	
	global $score;
	$score = file_get_contents('score.txt');
}

function nouvelle_partie()
{
	global $score;
	global $grille;
	$score=0;
	$grille= array_fill(0,4,array_fill(0,4,0));
	$tab=tirage_position_vide();
	$grille [$tab[0]][$tab[1]] =2 ; 
	$tab=tirage_position_vide();
	$grille [$tab[0]][$tab[1]] =2 ; 
	
}
function matrice_vers_fichier()
{ 
	global $grille;
	file_put_contents('grille.txt', "");
	for ($i = 0; $i < 4;$i++)
	{
		for ($g = 0; $g < 3;$g++)
		{
			file_put_contents('grille.txt', $grille[$i][$g]." ", FILE_APPEND);
		}
		file_put_contents('grille.txt', $grille[$i][3]."\n", FILE_APPEND);
	}
}
function fichier_vers_matrice()
{
	global $grille;
	
	$chaine = file_get_contents('grille.txt');
	$chaine = str_replace("\n", " ", $chaine);
	$valeurs = explode(' ', $chaine);
	$n = 0;
	for ($i = 0; $i < 4 ; $i++)
	{
		for ($j = 0; $j < 4; $j++) 
		{
			$grille[$i][$j] = (int) ($valeurs[$n]);
			$n++;
		}
	}
}
function affiche_case($i,$j)
{
	global $grille;
	switch ($grille[$i][$j]) 
		{ 
			case 0:
			echo '<td class= cellule>' . '</td>';
			break;
			case 2:
			echo '<td class= c2>' . $grille[$i][$j] . '</td>';
			break;
			case 4:
			echo '<td class= c4>' . $grille[$i][$j] . '</td>';
			break;
			case 8:
			echo '<td class= c8>' . $grille[$i][$j] . '</td>';
			break;
			case 16:
			echo '<td class= c16>' . $grille[$i][$j] . '</td>';
			break;
			case 32:
			echo '<td class= c32>' . $grille[$i][$j] . '</td>';
			break;
			case 64:
			echo '<td class= c64>' . $grille[$i][$j] . '</td>';
			break;
			case 128:
			echo '<td class= c128>' . $grille[$i][$j] . '</td>';
			break;
			case 256:
			echo '<td class= c256>' . $grille[$i][$j]. '</td>';
			break;
			case 512:
			echo '<td class= c512>' . $grille[$i][$j] . '</td>';
			break;
			case 1024:
			echo '<td class= c1024>' . $grille[$i][$j] . '</td>';
			break;
			case 2048:
			echo '<td class= c2048>' . $grille[$i][$j] . '</td>';
			break;
		}		
}
function tirage_position_vide()
{
	global $grille;
	$i= rand(0,3);
	$j= rand(0,3);
	while ($grille[$i][$j] != 0) 
		{
			$i= rand(0,3);
			$j= rand(0,3);
		}
	return array($i,$j);
}
function grille_pleine()
{ 
	global $grille;
	for ($i = 0; $i < 4 ; $i++)
	{
		for ($j = 0; $j < 4; $j++) 
		{
			if ($grille[$i][$j] == 0) {return false;}
		}
	}
	return true;
}
function tirage_2ou4()
{
	return 2*rand(1,2);
}
function place_nouveau_nb()
{
	global $grille;
	if (!grille_pleine())
		{
			$tab=tirage_position_vide();
			$grille [$tab[0]][$tab[1]] = tirage_2ou4() ; 
		}
}
function decale_ligne_gauche($l)
{
	global $grille;
	$ligne = array_fill(0,4,0);
	$i = 0;
	for ($j = 0; $j < 4; $j++)
	{
		if ($grille[$l][$j] != 0)
		{
			$ligne[$i] = $grille[$l][$j];
			$i++;
		}
	}
	$grille[$l] = $ligne;
}
function decale_ligne_droite($l)
{
	global $grille;
	$ligne = array_fill(0,4,0);
	$i = 3;
	for ($j = 3; $j >= 0; $j--)
	{
		if ($grille[$l][$j] != 0)
		{
			$ligne[$i] = $grille[$l][$j];
			$i--;
		}
	}
	$grille[$l] = $ligne;
}
function decale_col_haut($c)
{
	global $grille;
	$ligne = array_fill(0,4,0);
	$i = 0;
	for ($j = 0; $j < 4; $j++)
	{
		if ($grille[$j][$c] != 0)
		{
			$ligne[$i] = $grille[$j][$c];
			$i++;
		}
	}
	for ($g = 0; $g <4; $g++)
	{
		$grille[$g][$c] = $ligne[$g];
	}
}
function decale_col_bas($c)
{
	global $grille;
	$ligne = array_fill(0,4,0);
	$i = 3;
	for ($j = 3; $j >= 0; $j--)
	{
		if ($grille[$j][$c] != 0)
		{
			$ligne[$i] = $grille[$j][$c];
			$i--;
		}
	}
	for ($g = 0; $g <4; $g++)
	{
		$grille[$g][$c] = $ligne[$g];
	}
}
function fusion_ligne_gauche($l)
{
	global $grille;
	global $score;
	if ($grille[$l][0] == $grille[$l][1])
{
	$score= $score + 2 * $grille[$l][0];
	$grille[$l][0] = 2 * $grille[$l][0];
	$grille[$l][1] = 0;
	if ($grille[$l][2] == $grille[$l][3])
	{
		$score= $score + 2 * $grille[$l][2];
		$grille[$l][2] = 2 * $grille[$l][2];
		$grille[$l][3] = 0;		
	}		
}
	else if ($grille[$l][1] == $grille[$l][2])
{
	$score= $score + 2 * $grille[$l][1];
	$grille[$l][1] = 2 * $grille[$l][1];
	$grille[$l][2] = 0;
}	
	else if ($grille[$l][2] == $grille[$l][3])
{
	$score= $score + 2 * $grille[$l][2];
	$grille[$l][2] = 2 * $grille[$l][2];
	$grille[$l][3] = 0;
}
}	
function fusion_ligne_droite($l)
{
	global $grille;
	global $score;
	if ($grille[$l][0] == $grille[$l][1])
{
	$score= $score + 2 * $grille[$l][1];
	$grille[$l][1] = 2 * $grille[$l][1];
	$grille[$l][0] = 0;
	if ($grille[$l][2] == $grille[$l][3])
	{
		$score= $score + 2 * $grille[$l][3];
		$grille[$l][3] = 2 * $grille[$l][3];
		$grille[$l][2] = 0;		
	}		
}
	else if ($grille[$l][1] == $grille[$l][2])
{
	$score= $score + 2 * $grille[$l][2];
	$grille[$l][2] = 2 * $grille[$l][2];
	$grille[$l][1] = 0;
}	
	else if ($grille[$l][2] == $grille[$l][3])
{
	$score= $score + 2 * $grille[$l][3];
	$grille[$l][3] = 2 * $grille[$l][3];
	$grille[$l][2] = 0;
}
}
function fusion_col_haut($l)
{
	global $grille;
	global $score;
	if ($grille[0][$l] == $grille[1][$l])
{
	$score= $score + 2 * $grille[0][$l];
	$grille[0][$l] = 2 * $grille[0][$l];
	$grille[1][$l] = 0;
	if ($grille[2][$l] == $grille[3][$l])
	{
		$score= $score + 2 * $grille[2][$l];
		$grille[2][$l] = 2 * $grille[2][$l];
		$grille[3][$l] = 0;		
	}		
}
	else if ($grille[1][$l] == $grille[2][$l])
{
	$score= $score + 2 * $grille[1][$l];
	$grille[1][$l] = 2 * $grille[1][$l];
	$grille[2][$l] = 0;
}	
	else if ($grille[2][$l] == $grille[3][$l])
{
	$score= $score + 2 * $grille[2][$l];
	$grille[2][$l] = 2 * $grille[2][$l];
	$grille[3][$l] = 0;
}
}
function fusion_col_bas($l)
{
	global $grille;
	global $score;
	if ($grille[0][$l] == $grille[1][$l])
{
	$score= $score + 2 * $grille[1][$l];
	$grille[1][$l] = 2 * $grille[1][$l];	
	$grille[0][$l] = 0;
	if ($grille[2][$l] == $grille[3][$l])
	{
		$score= $score + 2 * $grille[3][$l];
		$grille[3][$l] = 2 * $grille[3][$l];
		$grille[2][$l] = 0;		
	}		
}
	else if ($grille[1][$l] == $grille[2][$l])
{
	$score= $score + 2 * $grille[2][$l];
	$grille[2][$l] = 2 * $grille[2][$l];
	$grille[1][$l] = 0;
}	
	else if ($grille[2][$l] == $grille[3][$l])
{
	$score= $score + 2 * $grille[3][$l];
	$grille[3][$l] = 2 * $grille[3][$l];
	$grille[2][$l] = 0;
}
}
function fusion_ligne_impos()
{	
	global $grille;
	for ($i=0; $i < 4 ; $i++)
	{
		if ( $grille[$i][0] = $grille[$i][1] or $grille[$i][1] = $grille[$i][2] or $grille[$i][2] = $grille[$i][3])
		{	
			return false;
		}
		
	}return true;
}
function fusion_col_impos()
{	
	global $grille;
	for ($i=0; $i < 4 ; $i++)
	{
		if ( $grille[0][$i] = $grille[1][$i] or $grille[1][$i] = $grille[2][$i] or $grille[2][$i] = $grille[3][$i])
		{	
			return false;
		}
		
	}return true;
}


	
	
	?>
