<?php
include_once 'BD.php';
include_once '../METIER/Article.php';


class ArticleBD extends BD
{   
	public function __construct()
	{
		parent::__construct();
	}
    
    //retourne un tableau contenant les artciles directements associŽs ˆ une catŽgorie
	function getArticlesWithCategory ($CategoryId) {
		
		$CategoryId = intval(parent::security($CategoryId));
		$this->connexion() ;
    	try
		{
			$connexion = parent::getConnexion();
			//On rŽcupre tous les articles de la catŽgorie passŽe en paramtre
			$ResultQuery = $connexion->query( "SELECT * FROM ARTICLE WHERE id_rubrique=$CategoryId" )->fetchAll();

			$ArticleTab = array(); // tableau contenant les articles ˆ retourner
			foreach($ResultQuery as $Art)
			{// Parcours des articles rŽcupŽrŽs dans la base
				//Ici on instancie un objet article ˆ l'aide des infos recupŽrŽes dans la base
				$Article = new Article($Art['id_article'], $Art['id_rubrique'], $Art['titreFR_article'], $Art['titreEN_article'], $Art['contenuFR_article'], $Art['contenuEN_article'], $Art['autorisation_com'], $Art['date_article']);
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
    	$terms = $bd->security($terms);
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
			$ResultQuery = $connexion->query($QueryString)->fetchAll();
        
			foreach($ResultQuery as $art)
        	{
            	$Article = new Article($art['id_article'], $art['id_rubrique'], $art['titreFR_article'], $art['titreEN_article'], $art['contenuFR_article'], $art['contenuEN_article'], $art['autorisation_com'], $art['date_article']);
            	array_push($Articles, $Article);
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
    
        
}


function getArticleById ($idArt)
{
	$bd = new Bd();
    $idArt = intval($bd->security($idArt));
    $Article = NULL;
	 
	try
	{
		$bd->connexion();
		$connexion = $bd->getConnexion();
		$ResultQuery = $connexion->query( "SELECT * FROM ARTICLE WHERE id_article=$idArt" )->fetch();
        
		if($ResultQuery != NULL) // Pour eviter une erreur si l'id categorie passŽ est null
        {
            //Ici on instancie un objet categorie ˆ l'aide des infos recupŽrŽes dans la base
            $Article = new Article($ResultQuery['id_article'], $ResultQuery['id_rubrique'], $ResultQuery['titreFR_article'], $ResultQuery['titreEN_article'], $ResultQuery['contenuFR_article'], $ResultQuery['contenuEN_article'], $ResultQuery['autorisation_com'], $ResultQuery['date_article']);
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
        $result = $connexion->query("SELECT * FROM ARTICLE ORDER BY date_article DESC")->fetchAll();
        
        foreach($result as $row)
        {
            $article = new Article($row['id_article'], $row['id_rubrique'], $row['titreFR_article'], $row['titreEN_article'], $row['contenuFR_article'], $row['contenuEN_article'], $row['autorisation_com'], $row['date_article']);
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
        $result = $connexion->query("SELECT COUNT(*) FROM ARTICLE")->fetch();
    }
    catch(PDOException $e)
    {
        
    }
    
    $bd->deconnexion();
    return $result['COUNT(*)'];
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



?>
