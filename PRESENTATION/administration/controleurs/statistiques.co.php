<!-- // fichier des statistiques du site


traitements

-->

<?php

	include ('modeles/statistiques.mo.php');
	
	$graph1 = get_nbArt_par_membre();
	
	$graph2 = get_history_article();
	
	$sousPage = "defaut";
	
	include ('vues/statistiques/statistiques_'.$sousPage.'.vu.php');
	
	
?>
