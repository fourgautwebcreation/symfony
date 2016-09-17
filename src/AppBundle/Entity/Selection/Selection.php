<?php

// src/AppBundle/Entity/Selection/Selection.php

namespace AppBundle\Entity\Selection;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class Selection extends Controller
{
 //retourne un tableau contenant les secteurs disponibles à ajouter au createFormBuilder
 function setList(Array $list)
 {
  $complete_list = array();
  $complete_list[ 'Sélectionner une entreprise' ] = 0;
  foreach($list as $list)
  {
   $complete_list[ $list->enterpriseName ] = $list->id;
  }
  return $complete_list;
 }
}
