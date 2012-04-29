<?php
    include_once('BD.php');
    include_once('../METIER/Participant.php');
    include_once('../METIER/ParticipantTrombinoscope.php');
    
    
function getAllParticipantsProfs()
{
    $bd = new BD();
    try
    {
        $bd->connexion();                   // Connexion a la BD
        $connexion = $bd->getConnexion();  
        $result = $connexion->query("SELECT * FROM PARTICIPANT
        									  JOIN PARTICIPATION ON PARTICIPANT.id_participant = PARTICIPATION.id_participant
        									  WHERE isProf = 1")->fetchAll();   // Execution de la requete
        $ret = array();
        foreach($result as $row)    // Chaque tuple retourne est instancie et stocke dans un tableau
        {
            $participant = new Participant($row['id_participant'],
                                           $row['nom_participant'],
                                           $row['prenom_participant'],
                                           $row['photo_participant'],
                                           $row['mail_participant'],
                                           $row['role_participation'],
                                           $row['bioFR_participant'],
                                           $row['bioEN_participant'],
                                           $row['isProf']
                                           );
            array_push($ret, $participant);
        }
    }
    catch(PDOException $e)
    {
        // A REMPLIR
    }
    $bd->deconnexion();
    
    return $ret;
}

function getAllParticipantsNonProfsByEquipe($idEquipe)
{
    $bd = new BD();
    
    
    try
    {
        $bd->connexion();                   // Connexion a la BD
        $connexion = $bd->getConnexion();  
        $param = intval($bd->security($connexion, $idEquipe));
        $result = $connexion->query("SELECT * FROM PARTICIPANT WHERE isProf = 0 AND id_equipe = $param")->fetchAll();   // Execution de la requete
        $ret = array();
        foreach($result as $row)    // Chaque tuple retourne est instancie et stocke dans un tableau
        {
            $participant = new Participant($row['id_participant'],
                                           $row['nom_participant'],
                                           $row['prenom_participant'],
                                           $row['photo_participant'],
                                           $row['mail_participant'],
                                           $row['role_participation'],
                                           $row['bioFR_participant'],
                                           $row['bioEN_participant'],
                                           $row['isProf']
                                           );
            array_push($ret, $participant);
        }
    }
    catch(PDOException $e)
    {
        // A REMPLIR
    }
    $bd->deconnexion();
    
    return $ret;
}


/** function CreateTrombinoscope
Cree des objets "ParticipantTrombinoscope"
**/
function createTrombinoscopeByEquipe($idEquipe)
{
	$bd = new BD();
	
	
	try
	{
		$bd->connexion();
		$connexion = $bd->getConnexion();
		$param = intval($bd->security($connexion, $idEquipe));
		$result = $connexion->query("SELECT PARTICIPANT.id_participant,
											PARTICIPANT.nom_participant,
											PARTICIPANT.prenom_participant,
											PARTICIPANT.photo_participant,
											PARTICIPANT.mail_participant,
											FORMATION.titreFR_formation,
											FORMATION.titreEN_formation,
											FORMATION.lien_formation,
											PARTICIPATION.role_participation,
											EQUIPE.annee_equipe
									 FROM PARTICIPANT
									 JOIN APPARTIENT ON PARTICIPANT.id_participant = APPARTIENT.id_participant
									 JOIN PARTICIPATION ON PARTICIPANT.id_participant = PARTICIPATION.id_participant
									 JOIN FORMATION ON APPARTIENT.id_formation = FORMATION.id_formation
									 JOIN EQUIPE ON PARTICIPATION.id_equipe = EQUIPE.id_equipe
									 WHERE isProf = 0 AND PARTICIPATION.id_equipe = $param")->fetchAll();
		$ret = array();						 
		foreach($result as $t)	// On va instancier chaque tuple récupéré par un objet ParticipantTrombinoscope
		{
			$p = new ParticipantTrombinoscope($t['id_participant'],
									  		  $t['nom_participant'],
											  $t['prenom_participant'],
											  $t['titreFR_formation'],
											  $t['titreEN_formation'],
											  $t['lien_formation'], 
											  $t['annee_equipe'],
											  $t['photo_participant'],
											  $t['mail_participant'],
											  $t['role_participation']
											 );
			array_push($ret, $p);
		}
	}
	catch(PDOException $e)
	{
		// A TRAITER
	}
	$bd->deconnexion();
	
	return $ret;
}

    
function getNbParticipantsProfs()
{
    $bd = new BD();
    try
    {
        $bd->connexion();                   // Connexion a la BD
        $connexion = $bd->getConnexion();  
        $result = $connexion->query("SELECT COUNT(*) FROM PARTICIPANT WHERE isProf = 1")->fetch();   // Execution de la requete
    }
    catch(PDOException $e)
    {
        // A REMPLIR
    }
    $bd->deconnexion();
    
    return $result['COUNT(*)'];
}
    
function getMostRecentArticlePersonn()
{
    $bd = new BD();
    try
    {
        $bd->connexion();                   // Connexion a la BD
        $connexion = $bd->getConnexion();  
        $result = $connexion->query("SELECT COUNT(*) FROM PARTICIPANT")->fetch();   // Execution de la requete
    }
    catch(PDOException $e)
    {
        // A REMPLIR
    }
    $bd->deconnexion();
    
    return $result['COUNT(*)'];

}
?>