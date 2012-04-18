<?php
require_once('BD.php');
require_once('../METIER/Article.php');


class ArticleBD extends BD
{   
	public function __construct()
	{
		parent::__construct();
	}
    
    //retourne un tableau contenant les artciles directements associŽs ˆ une catŽgorie
	function getArticlesWithCategory ($CategoryId) {
		
		
		$this->connexion() ;
		
    	try
		{
			$connexion = parent::getConnexion();
			$CategoryId = intval(parent::security($connexion, $CategoryId));
			//On rŽcupre tous les articles de la catŽgorie passŽe en paramtre
			$ResultQuery = $connexion->query( "SELECT * FROM ARTICLE WHERE id_rubrique=$CategoryId AND statut_article = 1" )->fetchAll();

			$ArticleTab = array(); // tableau contenant les articles ˆ retourner
			foreach($ResultQuery as $Art)
			{// Parcours des articles rŽcupŽrŽs dans la base
				//Ici on instancie un objet article ˆ l'aide des infos recupŽrŽes dans la base
				$Article = new Article($Art['id_article'],
									   $Art['id_rubrique'],
									   $Art['auteur_article'],
									   $Art['titreFR_article'],
									   $Art['titreEN_article'],
									   $Art['contenuFR_article'],
									   $Art['contenuEN_article'],
									   $Art['autorisation_com'],
									   $Art['statut_article'],
									   $Art['date_article'],
									   $Art['url_photo_principale'],
									   $Art['visible_home']);
				//On ajoute cet article dans le tableau des articles
				array_push($ArticleTab, $Article);
			}				
		}
		catch ( PDOException $e )
		{
			$ex = new AccesTableException() ;
			$ex->Message() ;
		}
		$this->deconnexion() ;
		return $ArticleTab;
    }
    
    function getArticlesWithSearchTerms($terms,$BorneInf,$BorneSup)
	{
		$Articles = array();
		$ArrayTerms = array();
		$bd = new Bd();
		$ArrayTerms = explode(" ",$terms);
		$QueryString = "SELECT * FROM ARTICLE WHERE ";
		foreach($ArrayTerms as $key => $term)
		{
			if($key != 0)
				$QueryString .= " OR ";
			$QueryString .= "titreFR_article like '%".$term."%' OR titreEN_article like '%".$term."%' OR contenuFR_article like '%".$term."%' OR contenuEN_article like '%".$term."%'";
		}
		
		try
		{
			$bd->connexion();
			
			$connexion = $bd->getConnexion();
			$QueryString = $bd->security($connexion, $QueryString);
			if($QueryString != NULL)
			{
				$ResultQuery = $connexion->query($QueryString);
				if($ResultQuery == NULL)
				{
					return NULL;
				}
				else
				{
					$ResultQuery->fetchAll();
        
					foreach($ResultQuery as $art)
        			{
            			$Article = new Article($art['id_article'],
            								   $art['id_rubrique'],
            								   $art['auteur_article'],
            								   $art['titreFR_article'],
            								   $art['titreEN_article'],
            								   $art['contenuFR_article'],
          	  								   $art['contenuEN_article'],
            								   $art['autorisation_com'],
            								   $art['statut_article'],
            								   $art['date_article'],
            								   $art['url_photo_principale'],
            								   $art['visible_home']);
            			array_push($Articles, $Article);
        			}
        		}
        	}
        	else
        	{
        		return NULL;
        	}
		}
		catch ( PDOException $e )
		{
			$ex = new AccesTableException() ;
			$ex->Message() ;
		}
		$bd->deconnexion();


		return $Articles;
	}
	
	function getHomeArticles()
	{
    	$return = array();
    	try
    	{
        	$this->connexion();
			$connexion = $this->getConnexion();
        	$result = $connexion->query("SELECT * FROM ARTICLE WHERE visible_home = 1 AND statut_article = 1 LIMIT 3")->fetchAll();
        
        	foreach($result as $row)
        	{
            	$article = new Article($row['id_article'],
            						   $row['id_rubrique'],
            						   $row['auteur_article'],
            						   $row['titreFR_article'],
            						   $row['titreEN_article'],
            						   $row['contenuFR_article'],
            						   $row['contenuEN_article'],
            						   $row['autorisation_com'],
            						   $row['statut_article'],
            						   $row['date_article'],
            						   $row['url_photo_principale'],
            						   $row['visible_home']
            						  );
            	array_push($return, $article);
        	}
    	}
    	catch(PDOException $e)
    	{
        
    	}
    
    	$this->deconnexion();
    	return $return;
}
        
}


function getArticleById ($idArt)
{
	$bd = new Bd();
    $Article = NULL;
	 
	try
	{
		$bd->connexion();
		$connexion = $bd->getConnexion();
		$idArt = intval($bd->security($connexion, $idArt));
		$ResultQuery = $connexion->query( "SELECT * FROM ARTICLE WHERE id_article=$idArt AND statut_article = 1" )->fetch();
        
		if($ResultQuery != NULL) // Pour eviter une erreur si l'id categorie passŽ est null
        {
            //Ici on instancie un objet categorie ˆ l'aide des infos recupŽrŽes dans la base
            $Article = new Article($ResultQuery['id_article'],
            					   $ResultQuery['id_rubrique'],
            					   $ResultQuery['auteur_article'],
            					   $ResultQuery['titreFR_article'],
            					   $ResultQuery['titreEN_article'],
            					   $ResultQuery['contenuFR_article'],
            					   $ResultQuery['contenuEN_article'],
            					   $ResultQuery['autorisation_com'],
            					   $ResultQuery['statut_article'],
            					   $ResultQuery['date_article'],
            					   $ResultQuery['url_photo_principale'],
            					   $ResultQuery['visible_home']
            					  );
        }
	}
	catch ( PDOException $e )
	{
		$ex = new AccesTableException() ;
		$ex->Message() ;
	}
	$bd->deconnexion();
	return $Article;
}
    
    
/** getAllArticles()
  * Renvoie tous les articles, tries par date de parution, dans un tableau d articles
  * @return Article[] : le tableau d'articles
**/
function getAllArticles()
{
    $bd = new Bd();
    $return = array();
    try
    {
        $bd->connexion();
		$connexion = $bd->getConnexion();
        $result = $connexion->query("SELECT * FROM ARTICLE WHERE statut_article = 1 ORDER BY date_article DESC")->fetchAll();
        
        foreach($result as $row)
        {
            $article = new Article($row['id_article'],
            					   $row['id_rubrique'],
            					   $row['auteur_article'],
            					   $row['titreFR_article'],
            					   $row['titreEN_article'],
            					   $row['contenuFR_article'],
            					   $row['contenuEN_article'],
            					   $row['autorisation_com'],
            					   $row['statut_article'],
            					   $row['date_article'],
            					   $row['url_photo_principale'],
            					   $row['visible_home']
            					  );
            array_push($return, $article);
        }
    }
    catch(PDOException $e)
    {
        
    }
    
    $bd->deconnexion();
    return $return;
}
    
function getNbArticles()
{
    $bd = new Bd();
    
    try
    {
        $bd->connexion();
        $connexion = $bd->getConnexion();
        $result = $connexion->query("SELECT COUNT(*) FROM ARTICLE WHERE statut_article = 1")->fetch();
    }
    catch(PDOException $e)
    {
        
    }
    
    $bd->deconnexion();
    return $result['COUNT(*)'];
}



function getNbArticlesByCategorie($idCat)
{
	$bd = new Bd();
    
    try
    {
        $bd->connexion();
        $connexion = $bd->getConnexion();
        $result = $connexion->query("SELECT COUNT(*) FROM ARTICLE WHERE statut_article = 1 AND id_rubrique = $idCat")->fetch();
    }
    catch(PDOException $e)
    {
        
    }
    
    $bd->deconnexion();
    
    return $result['COUNT(*)'];
}



function getNbPagesListeArticles()
{
	$nbArt = getNbArticles();
	if( ($nbArt % 10) == 0)
	{
		return($nbArt / 10);
	}
	return( ($nbArt / 10) + 1);
}
 
    
function determineNbArticlesIndex()
{
    $nbArticles = getNbArticles();
    if( $nbArticles > 5)
    {
        return 5;
    }
    return $nbArticles;
}

function articleExists($idArticle)
{
	$bd = new BD();
		
	try
	{
		$bd->connexion();
		
		$connexion = $bd->getConnexion();
		$param = intval($bd->security($connexion, $idArticle));
		$res = $connexion->query("SELECT * FROM ARTICLE WHERE id_article = $param")->fetch();
	}
	catch(PDOExcpetion $e)
	{
		// EXCEPION
	}
	
	$bd->deconnexion();
	
	if($res == NULL)
	{
		return FALSE;
	}
	return TRUE;
}

?>
