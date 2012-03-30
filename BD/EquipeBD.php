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
		
		$res = $connexion->query("SELECT * FROM EQUIPE WHERE id_equipe = $id")->fetchAll();
		
		foreach($res as $row)
		{
			$e = new Equipe($row['id_equipe'], $row['annee_equipe']);
		}
		
		
		
	}
	catch(PDOException $e)
	{
	
	}
	
	print_r($e);
	return $e;
}
	
?>