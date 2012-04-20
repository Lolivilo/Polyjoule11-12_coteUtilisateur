<?php

function getLastPage($nbItems, $nbParPage)
{
	if($nbItems <= $nbParPage)	// Si une seule page suffit
	{
		return 1;
	}
	
	return( ($nbItems % $nbParPage) + 1);
}


function getPreviousPage($currentPage)
{
	if($currentPage == 1)
	{
		return 1;
	}
	return($currentPage - 1);
}


function getNextPage($nbItems, $nbParPage, $currentPage)
{
	if( $currentPage == getLastPage($nbItems, $nbParPage) )
	{
		return($currentPage);
	}
	
	return($currentPage + 1);
}


/**
	Forme des URL SAUF rubrique : <template>-<numPage> (ssi numPage > 1, sinon on ne met rien, pas meme le tiret)
	Forme des URL rubrique : <template>-<rubriqueCourante>-<numPage> (numPage que la meme manière que ci-dessus)
**/
function generatePagination($nbItems, $catCourante)
{
	//$currentTemplate = getNomTemplateByIdRubrique($catCourante);	// On recupere le template correspondant
	$idCurrentTemplate = getIdTemplateByIdRubrique($catCourante);	// On recupere l id du template courante
	$currentTemplate = getNomTemplateById($idCurrentTemplate);		// On reçupere le template corresondant
	
	$tiretCat = "";
	if($idCurrentTemplate == 1)	// Si c'est une rubrique, on va rajouter une partie a l URL
	{
		$tiretCat = "-".$catCourante;
	}
	
	$ret = "<ul id='paginationLivre'>";
	$ret .= "<li><a href='".$currentTemplate.$tiretCat."'><<</a></li>";		// Retour a la page 1
	
	if(($prev = getPreviousPage($_GET['numPage'])) == 1)			// Page precedente
	{
		$ret .= "<li><a href='".$currentTemplate.$tiretCat."'><</a></li>";	
	}
	else
	{
		$ret .= "<li><a href='".$currentTemplate.$tiretCat."-".$prev."'><</a></li>";
	}
	
	$ret .= "<li>".$_GET['numPage']."</li>";						// Page courante
	
	if( ($next = getNextPage($nbItems, 5, $_GET['numPage'])) == 1)	// Page suivante
	{
		$ret .= "<li><a href='".$currentTemplate.$tiretCat."'>></a></li>";
	}
	else
	{
		$ret .= "<li><a href='".$currentTemplate.$tiretCat."-".$next."'>></a></li>";
	}
	
	if( ($last = getLastPage($nbItems, 5)) == 1)					// Derniere page
	{
		$ret .= "<li><a href='".$currentTemplate.$tiretCat."'>>></a></li>";
	}
	else
	{
		$ret .= "<li><a href='".$currentTemplate.$tiretCat."-".$last."'>>></a></li>";
	}
	$ret .= "</ul>";
	
	return($ret);
}


/** Retourne l'index de début du parcours du tableau pour des pages ou il y a une pagination
	Ex : Si on est sur la page 2 du livre d'or, on affiche les signatures de 5 a 9 (donc cette fonction retourne 5)
**/
function getIndexDebutFor($currentPage, $nbParPage)
{
	return( $nbParPage * ($currentPage - 1) );
}


/** Retourne l'index de fin du parcours du tableau pour des pages ou il y a une pagination
	Ex : Si on est sur la page 2 du livre d'or, on affiche les signatures de 5 a 9 (donc cette fonction retourne 9)
**/
function getIndexFinFor($indexDebut, $nbItems, $nbParPage)
{
	if( ($nbItems - $indexDebut) < $nbParPage)
	{
		return( $indexDebut + ($nbItems - $indexDebut) );
	}
	
	return($indexDebut + 5);
}


?>