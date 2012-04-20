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


function generatePagination($nbItems, $catCourante)
{
	$currentTemplate = getNomTemplateByIdRubrique($catCourante);	// On recupere le template correspondant
	
	
	$ret = "<ul id='paginationLivre'>";
	$ret .= "<li><a href='".$currentTemplate."'><<</a></li>";	// Retour a la page 1
	
	if(($prev = getPreviousPage($_GET['numPage'])) == 1)		// Page precedente
	{
		$ret .= "<li><a href='".$currentTemplate."'><<</a></li>";	
	}
	else
	{
		$ret .= "<li><a href='".$currentTemplate."-".$prev."'><</a></li>";
	}
	
	$ret .= "<li>".$_GET['numPage']."</li>";
	$ret .= "<li><a href='".$_SERVER['PHP_SELF']."?cat=".$catCourante."&numPage=".getNextPage($nbItems, 5, $_GET['numPage'])."'>></a></li>";
	$ret .= "<li><a href='".$_SERVER['PHP_SELF']."?cat=".$catCourante."&numPage=".getLastPage($nbItems, 5)."'>>></a></li>";
	$ret .= "</ul>";
	
	return($ret);
}


function getIndexDebutFor($currentPage, $nbParPage)
{
	return( $nbParPage * ($currentPage - 1) );
}

function getIndexFinFor($indexDebut, $nbItems, $nbParPage)
{
	if( ($nbItems - $indexDebut) < $nbParPage)
	{
		return( $indexDebut + ($nbItems - $indexDebut) );
	}
	
	return($indexDebut + 5);
}
?>