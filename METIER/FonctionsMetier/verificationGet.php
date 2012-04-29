<?php
function verifGet()
{
	if( (!(isset($_GET['cat']))) || (!(intval($_GET['cat']))) || (intval($_GET['cat']) < 0) )	// On vérifie que 'cat' est valide
	{
		header("location: erreur.php?code=0");
	}
	
	if( (!(isset($_GET['numPage']))) || (!(intval($_GET['numPage']))) || (intval($_GET['numPage']) < 0)  )	// On vérifie que 'numPage' est valide
	{
		header("location: erreur.php?code=0");
	}
	
	/*
	if( strlen($_SERVER['QUERY_STRING']) > 17 )	// On vérifie que d'autres informations ne sont pas envoyées
	{
		header("location: erreur.php?code=0");
	}
	*/
		
	if( !(categorieExists($_GET['cat'])) )		// On vérifie que la catégorie exist
	{
		header('location: erreur.php?code=1');
	}
}
?>