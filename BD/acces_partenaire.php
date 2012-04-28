<?php
include_once 'BD.php';
include_once '../METIER/Partenaire.php';



/** getPartenaireById
 * 
 * Renvoie l'objet Partenaire correpondant a l'ID passe en parametre
 * @param $id : l'ID du Partenaire souhaite
 * @return Partenaire $part : l'objet Partenaire correspondant
 */
function getPartenaireById($id)
{
	if( !(intval($id)) )
	{
		throw new RequestException("Le parametre \"".(String)$id."\" ne permet pas de retrouver un partenaire dans la base !");
	}
	else
	{
		$bd = new Bd();
		try
		{
			// Connexion a la base de donnees
			$bd->connexion();
			$connexion= $bd->getConnexion();
			$id = intval($bd->security($connexion, $id));
			$resultQuery = $connexion->query("SELECT * FROM PARTENAIRE WHERE id_partenaire = $id")->fetch();
			$part = new Partenaire($resultQuery['id_partenaire'],
								   $resultQuery['id_article'],
								   $resultQuery['nom_partenaire'],
								   $resultQuery['logo_partenaire'],
								   $resultQuery['site_partenaire'],
								   $resultQuery['descFR_partenaire'],
							   	$resultQuery['descEN_partenaire']
							  	);
		}
		catch(PDOException $e)
		{
			$ex = new AccesTableException();
			$ex->Message();
		}
		// Deconnexion de la base de donnees
		$bd->deconnexion();
	
	}
	return $part;
}


/** getAllPartners
 * 
 * Renvoie un tableau contenant tous les partenaires sous forme d'objets Partenaire
 * @return Partenaire $tableauDePartenaires[] : le tableau d'objets Partenaire
 */
function getAllPartners()
{
	$bd = new Bd();
	$nbPartMax = 3;
	try
	{
		// Connexion a la base de donnees
		$bd->connexion();
		$connexion = $bd->getConnexion();
		$resultQuery = $connexion->query("SELECT * FROM PARTENAIRE")->fetchAll();
			
		$tableauDePartenaires = array();	// Tableau que l'on va retourner
		// On parcourt le rsultat de la requte et on remplie le tableau ˆ retourner
		foreach($resultQuery as $row)
		{
			$partenaire = new Partenaire($row['id_partenaire'], $row['id_article'], $row['nom_partenaire'], $row['logo_partenaire'], $row['site_partenaire'], $row['descFR_partenaire'], $row['descEN_partenaire']);
			array_push($tableauDePartenaires, $partenaire);
		}
		$randomPartnersTab = array();
		$indexDejaPresent = array();
		for($i=0;$i<$nbPartMax;$i++)
		{
			$randomIndex = rand(0,count($tableauDePartenaires)-1);
			while(in_array($randomIndex, $indexDejaPresent))
			{
				$randomIndex = rand(0,count($tableauDePartenaires)-1);
			}
			array_push($indexDejaPresent,$randomIndex);
			array_push($randomPartnersTab,$tableauDePartenaires[$randomIndex]);
		}		
	}	
	catch(PDOException $e)
	{
		$ex = new AccesTableException() ;
		$ex->Message() ;
	}
	// Dconnexion de la base
	$bd->deconnexion();
		
	return $randomPartnersTab;
}

/** getAllPartners
 * 
 * Renvoie un tableau contenant tous les partenaires sous forme d'objets Partenaire
 * @return Partenaire $tableauDePartenaires[] : le tableau d'objets Partenaire
 */
function getTousPartners()
{
	$bd = new Bd();

	try
	{
		// Connexion a la base de donnees
		$bd->connexion();
		$connexion = $bd->getConnexion();
		$resultQuery = $connexion->query("SELECT * FROM PARTENAIRE")->fetchAll();
			
		$tableauDePartenaires = array();	// Tableau que l'on va retourner
		// On parcourt le rsultat de la requte et on remplie le tableau ˆ retourner
		foreach($resultQuery as $row)
		{
			$partenaire = new Partenaire($row['id_partenaire'], $row['id_article'], $row['nom_partenaire'], $row['logo_partenaire'], $row['site_partenaire'], $row['descFR_partenaire'], $row['descEN_partenaire']);
			array_push($tableauDePartenaires, $partenaire);
		}
	}	
	catch(PDOException $e)
	{
		$ex = new AccesTableException() ;
		$ex->Message() ;
	}
	// Dconnexion de la base
	$bd->deconnexion();
		
	return $tableauDePartenaires;
}


function partenaireExists($idPart)
{
	$bd = new Bd();
	
	
	try
	{
		// Connexion a la base de donnees
		$bd->connexion();
		$connexion = $bd->getConnexion();
		$param = intval($bd->security($connexion, $idPart));
		$res = $connexion->query("SELECT * FROM PARTENAIRE WHERE id_partenaire = $param")->fetchAll();
	}	
	catch(PDOException $e)
	{
		$ex = new AccesTableException() ;
		$ex->Message() ;
	}
	// Dconnexion de la base
	$bd->deconnexion();
		
	if($res == NULL)
	{
		return false;
	}
	return true;
}

?>