<?php
	include_once('BD.php');
	include_once('../METIER/Membre.php');
	
	public function getMembreByEquipe($idEquipe)
	{
		$bd = new BD();
		try
		{
			$bd->connexion();
			$connexion = $bd->getConnexion();
			
			$result = ("SELECT * FROM MEMBRE WHERE id_equipe=$idEquipe")->fetchAll();
			$ret = array();
			foreach($result as $row)
			{
				Membre $m = new Membre($row['id_membre'],
									   $row['pseudo_membre'],
									   $row['id_equipe'],
									   $row['mdp_membre'],
									   $row['mail_membre'],
									   $row['departement_membre'],
									   $row['promotion_membre'],
									   $row['statut_membre'],
									   $row['photo_membre'],
									   $row['date_inscription']
									  );
				array_push($ret, $m);
			}
		}
		catch(PDOException $e)
		{
			// ABFBSFSBFB
		}
		$bd->deconnexion();
		
		return $ret;
	}
?>