<?php

require_once 'fonctions-2048.php';

switch($_GET['action-joueur'])
{
 case '^':
  write_log('haut');
  break;

 case '<':
  write_log('gauche');
  break;

 case '>':
  write_log('droite');
  break;

 case 'v':
  write_log('bas');
  break;
  
 case 'Recommencer':
  write_log('Recommencer');
  break;

 default :
  echo '' ;
  break;
}

include 'index.php';
?>
