<?php
	include_once('BD.php');
	include_once('../METIER/AlbumPhoto.php');

function getMostRecentAlbum()
{
	$bd = new BD();
	try
	{
		$bd->connexion();                   // Connexion a la BD
		$connexion = $bd->getConnexion();
		$resultQuery = $connexion->query("SELECT id_album FROM ALBUM ORDER BY date_album ASC LIMIT 1")->fetch();
		$ret = $resultQuery['id_album'];
		return $ret;
	}
	catch(PDOException $e)
	{
		
	}
}

function getAlbumById($id)
{
	$bd = new BD();
	try
	{
		$bd->connexion();                   // Connexion a la BD
		$connexion = $bd->getConnexion();
		$resultQuery = $connexion->query("SELECT * FROM ALBUM WHERE id_album = $id")->fetch();
		$album = new AlbumPhoto($resultQuery['id_album'], $resultQuery['nom_album'], $resultQuery['date_album']);
		return $album;
	}
	catch(PDOException $e)
	{
		
	}
}

?>