<?php
include_once('BD.php');
include_once('../METIER/Equipe.php');
	
function getEquipeById($id)
{
	$bd = new BD();
	
	try
	{
		$bd->connexion();
		$connexion = $bd->getConnexion();
		
		$res = $connexion->query("SELECT * FROM EQUIPE WHERE id_equipe = $id")->fetch();
		print_r($res);
		$e = new Equipe($res['id_equipe'], $res['annee_equipe']);
		
		print_r($e);
		
		
	}
	catch(PDOException $e)
	{
	
	}
	
	
	return $e;
}
	
?>