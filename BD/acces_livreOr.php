<?php
include_once('BD.php');
include_once('../METIER/LivreDOr.php');
    
/** getAllLivreDOr()
  *  Renvoie un tableau contenant tous les commentaires du livre d or sous forme d objets LivreDOr
  *  @return LivreDOr $tableauDeLivreDOr[] : un tableau contenant tous les LivreDOr existants
  */
    
function getAllLivreDOr()
{
    $bd = new BD();
    $tableauDeLivreDOr = array();
        
    try
    {
        $bd->connexion();											// Connexion a la BD
        $connexion = $bd->getConnexion();
        $resultQuery = $connexion->query("SELECT * FROM LIVRE_OR")->fetchAll();	// Execution de la requete
            
        foreach($resultQuery as $row)
        {
            $livre = new LivreDOr($row['id_post'], $row['posteur_post'], $row['mail_post'], $row['date_post'], $row['message_post']);
            array_push($tableauDeLivreDOr, $livre);
        }
    }
    catch(PDOException $e)
    {
            
    }
    $bd->deconnexion();	// Deconnexion de la BD
        
    return $tableauDeLivreDOr;
}


    

/** function getAllAcceptedLivreDOr()
  * Liste l'ensemble des signatures acceptées dans un tableau
  * @return LivreDOr $tableauDeLivreDOr[] : un tabeau contenant tous les LivreDOr listés
**/
function getAllAcceptedLivreDOr()
{
    $bd = new BD();
    $tableauDeLivreDOr = array();
        
    try
    {
        $bd->connexion();											// Connexion a la BD
        $connexion = $bd->getConnexion();
        $resultQuery = $connexion->query("SELECT * FROM LIVRE_OR WHERE accept_post = 1 ORDER BY date_post DESC")->fetchAll();	// Execution de la requete
            
        foreach($resultQuery as $row)
        {
            $livre = new LivreDOr($row['id_post'], $row['posteur_post'], $row['mail_post'], $row['date_post'], $row['message_post']);
            array_push($tableauDeLivreDOr, $livre);
        }
    }
    catch(PDOException $e)
    {
            
    }
    $bd->deconnexion();	// Deconnexion de la BD
        
    return $tableauDeLivreDOr;
}


/** function getFiveAcceptedLivreDOr($debut)
	Retourne 5 signatures a partir de la ($debut)ième signature specifiee
	@param int $debut : laposition de la premiere signature a renvoyer
	@return LivreDOr[5] : Tableau des 5 signatures
**/
function getFiveAcceptedLivreDOr($debut)
{
    $bd = new BD();
    
    $tableauDeLivreDOr = array();
        
    try
    {
        $bd->connexion();											// Connexion a la BD
        $connexion = $bd->getConnexion();
        $param = intval($bd->security($connexion, $debut));
        $resultQuery = $connexion->query("SELECT * FROM LIVRE_OR WHERE accept_post = 1 ORDER BY date_post DESC LIMIT $param, 5")->fetchAll();	// Execution de la requete
            
        foreach($resultQuery as $row)
        {
            $livre = new LivreDOr($row['id_post'], $row['posteur_post'], $row['mail_post'], $row['date_post'], $row['message_post']);
            array_push($tableauDeLivreDOr, $livre);
        }
    }
    catch(PDOException $e)
    {
            
    }
    $bd->deconnexion();	// Deconnexion de la BD
        
    return $tableauDeLivreDOr;
}

    
function getNbAcceptedLivreOr()
{
    $bd = new BD();
    
    try
    {
        $bd->connexion();
        $connexion = $bd->getConnexion();
        $resultQuery = $connexion->query("SELECT COUNT(*) FROM LIVRE_OR WHERE accept_post = 1")->fetch();
    }
    catch(PDOException $e)
    {
        
    }
    $bd->deconnexion();
    
    return $resultQuery['COUNT(*)'];
}

    
function getLastNumPageLivreOr()
{
    return( floor((getNbAcceptedLivreOr() / 10) + 1) );
}
    
    
function getPreviousNumPageLivreOr($currentPage)
{
    if( ($currentPage - 1) < 1)
    {
        return 1;
    }
    
    return($currentPage - 1 );
}
    
function getNextNumPageLivreOr($currentPage)
{
    if( ($currentPage + 1) > getLastNumPageLivreOr() )
    {
        return getLastNumPageLivreOr();
    }
        
    return($currentPage + 1 );
}
    

function getNbOnPageLivreOr($currentPage)
{
    if($currentPage == getLastNumPageLivreOr())
    {
        return( getNbAcceptedLivreOr() - (10*($currentPage - 1)) );
    }
    
    return 10;
}

function getNbPagesLivreOr()
{
	$nb = getNbAcceptedLivreOr();	// Nombre de signatures
	if($nb % 10 == 0)
	{
		return($nb / 10);
	}
	return( ($nb / 10) + 1);
	
}
?>