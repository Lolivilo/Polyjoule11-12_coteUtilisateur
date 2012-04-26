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
		$param = $bd->security($connexion, $id);
		
		$res = $connexion->query("SELECT * FROM EQUIPE WHERE id_equipe = $param")->fetch();
		$e = new Equipe($res['id_equipe'], $res['annee_equipe']);
		
		
		
	}
	catch(PDOException $e)
	{
	
	}
	
	
	return $e;
}


function getAllEquipes()
{
	$bd = new BD();
	
	try
	{
		$bd->connexion();
		$connexion = $bd->getConnexion();
		
		$res = $connexion->query("SELECT * FROM EQUIPE")->fetchAll();
		$ret = array();
		foreach($res as $e)
		{
			$eq = new Equipe($e['id_equipe'], $e['annee_equipe']);
			array_push($ret, $eq);
		}
	}
	
	catch(PDOException $e)
	{
	
	}
	
	$bd->deconnexion();
	
	return $ret;
}


function getNbEquipes()
{
$bd = new BD();
	
	try
	{
		$bd->connexion();
		$connexion = $bd->getConnexion();
		
		$res = $connexion->query("SELECT COUNT(*) FROM EQUIPE")->fetch();
	}
	
	catch(PDOException $e)
	{
	
	}
	
	$bd->deconnexion();
	
	return $res['COUNT(*)'];

}


function equipeExists($idEq)
{
	$bd = new BD();
	
	
	try
	{
		$bd->connexion();
		
		$connexion = $bd->getConnexion();
		$idEq = intval($bd->security($connexion, $idEq));
		$res = $connexion->query("SELECT * FROM EQUIPE WHERE id_equipe = $idEq")->fetchAll();
	}
	
	catch(PDOException $e)
	{
	
	}
	
	$bd->deconnexion();
	
	if($res == NULL)
	{
		return FALSE;
	}
	return TRUE;
}
	
?>