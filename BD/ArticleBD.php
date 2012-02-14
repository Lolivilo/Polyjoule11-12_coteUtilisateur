<?php
include_once 'BD.php';
include_once '../METIER/Article.php';


class ArticleBD extends BD
{   
	public function __construct()
	{
		parent::__construct();
	}
    
    //retourne un tableau contenant les artciles directements associ�s � une cat�gorie
	function getArticlesWithCategory ($CategoryId) {
		
		$CategoryId = intval(parent::security($CategoryId));
		$this->connexion() ;
    	try
		{
			$connexion = parent::getConnexion();
			//On r�cup�re tous les articles de la cat�gorie pass�e en param�tre
			$ResultQuery = $connexion->query( "SELECT * FROM ARTICLE WHERE id_rubrique=$CategoryId" )->fetchAll();

			$ArticleTab = array(); // tableau contenant les articles � retourner
			foreach($ResultQuery as $Art)
			{// Parcours des articles r�cup�r�s dans la base
				//Ici on instancie un objet article � l'aide des infos recup�r�es dans la base
				$Article = new Article($Art['id_article'], $Art['id_rubrique'], $Art['titreFR_article'], $Art['titreEN_article'], $Art['contenuFR_article'], $Art['contenuEN_article'], $Art['autorisation_com']);
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
    
}


function getArticleById ($idArt)
{
	$bd = new Bd();
    $idArt = intval($bd->security($idArt));
    
	 
	try
	{
		$bd->connexion();
		$connexion = $bd->getConnexion();
		$ResultQuery = $connexion->query( "SELECT * FROM ARTICLE WHERE id_article=$idArt" )->fetch();
			
		//Ici on instancie un objet categorie � l'aide des infos recup�r�es dans la base
		$Article = new Article($ResultQuery['id_article'], $ResultQuery['id_rubrique'], $ResultQuery['titreFR_article'], $ResultQuery['titreEN_article'], $ResultQuery['contenuFR_article'], $ResultQuery['contenuEN_article'], $ResultQuery['autorisation_com']);
	}
	catch ( PDOException $e )
	{
		$ex = new AccesTableException() ;
		$ex->Message() ;
	}
	$bd->deconnexion();
	return $Article;
}
    
    

?>
