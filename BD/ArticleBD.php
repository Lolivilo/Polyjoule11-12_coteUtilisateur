<?php
include_once 'BD.php';
include_once '../METIER/Article.php';

class ArticleBD extends BD {
   
	public function __construct()
	{
		parent::__construct();
	
	}
	
    
	function getArticleWithId ($idArt) {
        $idArt = parent::security($idArt);
		$this->connexion() ;
    	
		try
		{
			$connexion = parent::getConnexion();
			$ResultQuery = $connexion->query( "SELECT * FROM ARTICLE WHERE id_article=$idArt" )->fetch();
			
			//Ici on instancie un objet categorie à l'aide des infos recupérées dans la base
			$Article = new Article($ResultQuery['id_article'], $ResultQuery['id_rubrique'], $ResultQuery['titreFR_article'], $ResultQuery['titreEN_article'], $ResultQuery['contenuFR_article'], $ResultQuery['contenuEN_article'], $ResultQuery['autorisation_com']);
			
			echo "<br>".$ResultQuery['id_article'];
			echo "<br>".$ResultQuery['id_rubrique'];
			echo "<br>".$ResultQuery['titreFR_article'];
			echo "<br>".$ResultQuery['titreEN_article'];
			echo "<br>".$ResultQuery['contenuFR_article'];
			echo "<br>".$ResultQuery['contenuEN_article'];
			echo "<br>".$ResultQuery['autorisation_com'];
		}
		catch ( PDOException $e )
		{
			$ex = new AccesTableException() ;
			$ex->Message() ;
		}
		$this->deconnexion() ;
		return $Article;
    }
    
	function getArticlesWithCategory ($CategoryId) {
		
		$CategoryId = parent::security($CategoryId);
		$this->connexion() ;
    	try
		{
			$connexion = parent::getConnexion();
			//On récupère tous les articles de la catégorie passée en paramètre
			$ResultQuery = $connexion->query( "SELECT * FROM ARTICLE WHERE id_rubrique=$CategoryId" )->fetchAll();

			$ArticleTab = array(); // tableau contenant les articles à retourner
			foreach($ResultQuery as $Art)
			{// Parcours des articles récupérés dans la base
				//Ici on instancie un objet article à l'aide des infos recupérées dans la base
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

?>
