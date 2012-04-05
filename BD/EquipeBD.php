<?php
include_once('BD.php');
include_once('../METIER/Equipe.php');
	
function getEquipeById($id)
{
	$bd = new BD();
	$param = $bd->security($id);
	
	try
	{
		$bd->connexion();
		$connexion = $bd->getConnexion();
		
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

function equipeExists($idEq)
{
	$bd = new BD();
	$param = intval($bd->security($idEq));
	
	try
	{
		$bd->connexion();
		$connexion = $bd->getConnexion();
		
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