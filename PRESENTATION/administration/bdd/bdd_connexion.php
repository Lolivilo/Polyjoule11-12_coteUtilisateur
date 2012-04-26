<!--
/*****************************
|    Partie Administration	 |
|        du site web 		 |
|         Polyjoule		     |
*****************************/

Ce fichier contient uniquement la connexion à la bdd

-->


<?php
/*Connexion à la BDD*/

/* OVH */
$bd_nom_serveur	='mysql51-62.perso';
$bd_login		='polyjoule01';
$bd_mot_de_passe='01admPoly';
$bd_nom_bd		='polyjoule01';/**/




//Connexion à la base de données
$connexion = mysql_connect($bd_nom_serveur, $bd_login, $bd_mot_de_passe);
if (!$connexion)
{
	die("Connexion à la bdd impossible !");
}
else
{
	$bdd = mysql_select_db($bd_nom_bd);
	if (!$bdd) { die ("Sélection bdd impossible !"); }
	mysql_query("set names 'utf8'");
}


?>
