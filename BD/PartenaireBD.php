<?php
include_once 'BD.php';
include_once '../METIER/Partenaire.php';


class PartenaireBD extends BD
{
	public function __construct($host, $database, $user, $password)
	{
		parent::__construct($host, $database, $user, $password);
	}
	
	
	
	/**
	 * Fonction qui renvoie tous les partenaires, pour les afficher sur la home
	 * @return un tableau de PartenaireBD
	 */
	public function getAllPartner()
	{
		$this->connexion();
		try
		{
			$connexion = parent::getConnexion();
			// Consultation de la base de donnŽes
			$resultQuery = $connexion->query("SELECT * FROM PARTENAIRE")->fetchAll();
			
			$tableauDePartenaires = array();	// Tableau que l'on va retourner
			// On parcourt le rŽsultat de la requte et on remplie le tableau ˆ retourner
			foreach($resultQuery as $row)
			{
				$partenaire = new Partenaire($row['id_partenaire'], $row['nom_partenaire'], $row['logo_partenaire'], $row['site_partenaire'], $row['descFR_partenaire'], $row['descEN_partenaire']);
				array_push($tableauDePartenaires, $partenaire);
			}		
		}
		
		catch(PDOException $e)
		{
			$ex = new AccesTableException() ;
			$ex->Message() ;
		}
		// DŽconnexion de la base
		$this->deconnexion();
		
		return $tableauDePartenaires;
	}
}