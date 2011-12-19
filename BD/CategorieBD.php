<?php
require_once 'BD.php';
require_once '../METIER/Categorie.php';

class CategorieBD extends BD {
   
	public function __construct()
	{
		parent::__construct();
	}
	
    /**
     * Retourne un tableau de catégories
     * Si le paramètre passé est egal à NULL, la fonction retourne alors les catégories de 1er niveau, celles qui n'ont pas de catégorie mère.
     * Si le paramètre passé est un 
     */
    function getSousCategories ($CategorieParente) {
    	
    	$CategorieParente = parent::security($CategorieParente);
    	$this->connexion() ;
    	try
		{
			$connexion = parent::getConnexion();
			if($CategorieParente == NULL)//Si on cherche à obtenir les catégories parentes ( 1er niveau)
			{
				$ResultQuery = $connexion->query( "SELECT * FROM RUBRIQUE WHERE id_mere IS NULL" )->fetchAll();
			}
			else {// si on cherche à obtenir les sous catégories de la catégorie donnée en paramètre
				$ResultQuery = $connexion->query( "SELECT * FROM RUBRIQUE WHERE id_mere=$CategorieParente" )->fetchAll();
			}
			$categoriesTab = array(); // tableau contenant les catégories mères à retourner
			foreach($ResultQuery as $Cat)
			{// Parcours des catégories récupérées dans la base
				//Ici on instancie un objet categorie à l'aide des infos recupérées dans la base
				$Categorie = new Categorie($Cat['id_rubrique'], $Cat['id_mere'], $Cat['titreFR_rubrique'], $Cat['titreEN_rubrique']);
				//On ajoute cette catégorie dans le tableau de catégories mères
				array_push($categoriesTab, $Categorie);
			}				
		}
		catch ( PDOException $e )
		{
			$ex = new AccesTableException() ;
			$ex->Message() ;
		}
		$this->deconnexion() ;
		return $categoriesTab;
        
    }
    
	function getCategorieWithId ($idCat) {
        $idCat = parent::security($idCat);
		$this->connexion() ;
    	
		try
		{
			$connexion = parent::getConnexion();
			$ResultQuery = $connexion->query( "SELECT * FROM RUBRIQUE WHERE id_rubrique=$idCat" )->fetch();
			
			//Ici on instancie un objet categorie à l'aide des infos recupérées dans la base
			$Categorie = new Categorie($ResultQuery['id_rubrique'], $ResultQuery['id_mere'], $ResultQuery['titreFR_rubrique'], $ResultQuery['titreEN_rubrique']);
			
			/*echo "<br>".$ResultQuery['id_rubrique'];
			echo "<br>".$ResultQuery['id_mere'];
			echo "<br>".$ResultQuery['titreFR_rubrique'];
			echo "<br>".$ResultQuery['titreEN_rubrique'];*/
		}
		catch ( PDOException $e )
		{
			$ex = new AccesTableException() ;
			$ex->Message() ;
		}
		$this->deconnexion() ;
		return $Categorie;
    }
    
function getSuperParentCategoryOfCategory($idCat)
    {
    	$idcat = parent::security($idCat);
    	$this->connexion();	// Connexion à la BD
    	$idMere = NULL;
    	
    	try
    	{
    		$connexion = parent::getConnexion();
    		do
    		{
    			// On récupère l'id_mere de la catégorie courante
    			$resultQuery = $connexion->query("SELECT id_mere FROM RUBRIQUE WHERE id_rubrique = $idCat")->fetch();
    			$idMere = $resultQuery['id_mere'];
    			if($idMere != NULL)	// Si elle existe, elle devient la catégorie courante pour la prochaine itération de boucle
    			{
    				$idCat = $idMere;
    			}
    		}
    		while($idMere != NULL);
    	}
    	catch (PDOException $e)
		{
			$ex = new AccesTableException();
			$ex->Message();
		}
		// Déconnexion de la BD
		$this->deconnexion();
		
		return $idCat;
    }
    
    
    // retourne la categorie parente la plus haute dans la hiérarchie
    function getSuperParentCategoryOfArticle($idArt)
    {
    	$idArt = parent::security($idArt);
    	// Connexion à la BD
    	$this->connexion();
    	$idDirectCat = NULL;	// Catégorie liée à l'article
    	
    	try
    	{
    		$connexion = parent::getConnexion();
    		// On récupère l'id_rubrique de l'article
    		$resultQuery = $connexion->query("SELECT id_rubrique FROM ARTICLE WHERE id_article = $idArt")->fetch();
    		$idDirectCat= $resultQuery['id_rubrique'];
    		// Puis on appelle la fonction renvoyant la super catégorie
    		$idMere = $this->getSuperParentCategoryOfCategory($idDirectCat);
    	}
    	catch (PDOException $e)
    	{
    		$ex = new AccesTableException();
    		$ex->Message();
    	}
    	// Déconnexion de la BD
    	$this->deconnexion();
    	
    	return $idMere;
    }
    
    
    
    
}

?>
