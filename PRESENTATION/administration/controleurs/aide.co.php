<!-- // fichier d'aide


traitements

-->

<?php
	include ('modeles/aide.mo.php');


/**********
Page d'aide

	Option 1 : aide administration
	Option 2 : Contact
	Option 3 : Liens utiles
**********/

	$action = array(1,2,3); // Tableau des action possibles
	
	// Traitement de chaque page
	if (isset($_GET['option']) && in_array(securite($_GET['option']),$action))
		$action = securite($_GET['option']);
	else
		$action = 0;

	$sousPage 	= "defaut";

	// traitement pour chaque type de page et calcul de la page à afficher
	switch ($action)
	{ 

		case 1:
			$sousPage 	= "admin";
		break;
		
		case 2:
			$sousPage 	= "contact";
		break;
		
		case 3:
			$sousPage 	= "lien";
		break;
		
		default :
			$sousPage 	= "defaut";
	}

	include ('vues/aide/aide_'.$sousPage.'.vu.php');
?>
