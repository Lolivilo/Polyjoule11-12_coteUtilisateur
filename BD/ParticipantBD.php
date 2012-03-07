<?php
    include_once('BD.php');
    include_once('../METIER/Participant.php');
    
    
function getAllParticipants()
{
    $bd = new BD();
    try
    {
        $bd->connexion();                   // Connexion a la BD
        $connexion = $bd->getConnexion();  
        $result = $connexion->query("SELECT * FROM PARTICIPANT")->fetchAll();   // Execution de la requete
        $ret = array();
        foreach($result as $row)    // Chaque tuple retourne est instancie et stocke dans un tableau
        {
            $participant = new Participant($row['id_participant'],
                                           $row['id_equipe'],
                                           $row['nom_participant'],
                                           $row['prenom_participant'],
                                           $row['photo_participant'],
                                           $row['mail_participant'],
                                           $row['role_participant'],
                                           $row['bioFR_participant'],
                                           $row['bioEN_participant']);
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
    
function getNbParticipants()
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