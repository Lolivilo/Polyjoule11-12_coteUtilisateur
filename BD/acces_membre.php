<?php
/** Fichier finalement non utilisé **/

	include_once('BD.php');
	include_once('../METIER/Membre.php');
	
	function getMembreByEquipe($idEquipe)
	{
		$bd = new BD();
		
		
		try
		{
			$bd->connexion();
			$param = intval($bd->security($idEquipe));
			$connexion = $bd->getConnexion();
			
			$result = $connexion->query("SELECT * FROM MEMBRE WHERE id_equipe=$param")->fetchAll();
			$ret = array();
			foreach($result as $row)
			{
				$m = new Membre($row['id_membre'],
								$row['pseudo_membre'],
				 		 	    $row['id_equipe'],
				 			    $row['nom_membre'],
								$row['prenom_membre'],
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