<?php
require_once 'BD.php';
require_once '../METIER/Categorie.php';

class CategorieBD extends BD
{   
	public function __construct()
	{
		parent::__construct();
	}
	
    /**
     * Retourne un tableau de catŽgories
     * Si le paramtre passŽ est egal ˆ NULL, la fonction retourne alors les catŽgories de 1er niveau, celles qui n'ont pas de catŽgorie mre.
     * Si le paramtre passŽ est un 
     */
    function getSousCategories ($CategorieParente)
    {
    	
    	$CategorieParente = parent::security($CategorieParente);
    	$this->connexion() ;
    	try
		{
			$connexion = parent::getConnexion();
			if($CategorieParente == NULL)//Si on cherche ˆ obtenir les catŽgories parentes ( 1er niveau)
			{
				$ResultQuery = $connexion->query( "SELECT * FROM RUBRIQUE WHERE id_mere IS NULL" )->fetchAll();
			}
			else {// si on cherche ˆ obtenir les sous catŽgories de la catŽgorie donnŽe en paramtre
				$ResultQuery = $connexion->query( "SELECT * FROM RUBRIQUE WHERE id_mere=$CategorieParente" )->fetchAll();
			}
			$categoriesTab = array(); // tableau contenant les catŽgories mres ˆ retourner
			foreach($ResultQuery as $Cat)
			{// Parcours des catŽgories rŽcupŽrŽes dans la base
				//Ici on instancie un objet categorie ˆ l'aide des infos recupŽrŽes dans la base
				$Categorie = new Categorie($Cat['id_rubrique'], $Cat['id_mere'], $Cat['titreFR_rubrique'], $Cat['titreEN_rubrique']);
				//On ajoute cette catŽgorie dans le tableau de catŽgories mres
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
   
	/** getCategorieWithId
	 * 
	 * Renvoie un objet de type Categorie ˆ partir de son ID
	 * @param $idCat : l'ID de la Categorie ˆ retourner
	 * @return l'objet de type Categorie correspondant
	 */
	function getCategorieWithId ($idCat)
	{
        $idCat = intval(parent::security($idCat));
		$this->connexion() ;
    	
		try
		{
			$connexion = parent::getConnexion();
			$ResultQuery = $connexion->query( "SELECT * FROM RUBRIQUE WHERE id_rubrique=$idCat" );
			if($ResultQuery != NULL) // Pour eviter une erreur si l'id categorie passŽ est null
			{
				$ResultQuery = $ResultQuery->fetch();
				//Ici on instancie un objet categorie ˆ l'aide des infos recupŽrŽes dans la base
				$Categorie = new Categorie($ResultQuery['id_rubrique'], $ResultQuery['id_mere'], $ResultQuery['titreFR_rubrique'], $ResultQuery['titreEN_rubrique']);
			}
			else 
			{
				$Categorie = new Categorie(0, NULL, NULL, NULL);
				// C'est la categorie par defaut ( categorie NULL)	
			}			

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
    	$idCat = parent::security($idCat);
    	$this->connexion();	// Connexion ˆ la BD
    	$idMere = NULL;
    	
    	try
    	{
    		$connexion = parent::getConnexion();
    		do
    		{
    			// On rŽcupre l'id_mere de la catŽgorie courante
    			$resultQuery = $connexion->query("SELECT id_mere FROM RUBRIQUE WHERE id_rubrique = $idCat")->fetch();
    			$idMere = $resultQuery['id_mere'];
                echo "While".$idMere;
    			if($idMere != NULL)	// Si elle existe, elle devient la catŽgorie courante pour la prochaine itŽration de boucle
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
		// DŽconnexion de la BD
		$this->deconnexion();
		
		return $idCat;
    }
    
    
    // retourne l'id de la categorie parente la plus haute dans la hiŽrarchie
    function getSuperParentCategoryOfArticle($idArt)
    {
    	$idArt = parent::security($idArt);
    	// Connexion ˆ la BD
    	$this->connexion();
    	$idDirectCat = NULL;	// CatŽgorie liŽe ˆ l'article
    	
    	try
    	{
    		$connexion = parent::getConnexion();
    		// On rŽcupre l'id_rubrique de l'article
    		$resultQuery = $connexion->query("SELECT id_rubrique FROM ARTICLE WHERE id_article = $idArt")->fetch();
			
    		$idDirectCat = $resultQuery['id_rubrique'];
    		echo $idDirectCat;
            if($idDirectCat != NULL)
    		{
                
    			// Puis on appelle la fonction renvoyant la super catŽgorie
    			$idMere = $this->getSuperParentCategoryOfCategory($idDirectCat);
                //echo $idMere;
    		}
    		else $idMere = 0; // Si la catŽgorie de l'article est inconnue
    	}
    	catch (PDOException $e)
    	{
    		$ex = new AccesTableException();
    		$ex->Message();
    	}
    	// DŽconnexion de la BD
    	$this->deconnexion();
    	return $idMere;
    }
    
    
	// retourne l'ID de la catŽgorie directement associŽe ˆ un article
    function getAsssociateCategoryIDForArticle($idArt)
    {
    	$idArt = parent::security($idArt);
    	// Connexion ˆ la BD
    	$this->connexion();
    	
    	try
    	{
    		$connexion = parent::getConnexion();
    		// On rŽcupre l'id_rubrique de l'article
    		$ResultQuery = $connexion->query("SELECT id_rubrique FROM ARTICLE WHERE id_article = $idArt")->fetch();
			$Categorie = $ResultQuery['id_rubrique'];
    		
    	}
    	catch (PDOException $e)
    	{
    		$ex = new AccesTableException();
    		$ex->Message();
    	}
    	// DŽconnexion de la BD
    	$this->deconnexion();
    	return $Categorie;
    }
	
    // Retourne un tableau contenant le fil d'arianne en passant en param une catŽgorie
    function getFilArianneWithCategorie($idCat)
    {
    	$idCat = parent::security($idCat);
    	// Connexion ˆ la BD
    	$this->connexion();
    	$Tab_Arianne = array();
    	try
    	{
    		$connexion = parent::getConnexion();
    		//Recuperation, instanciation de la categorie en paramtre et ajout dans le tableau
    		$resultQuery = $connexion->query("SELECT * FROM RUBRIQUE WHERE id_rubrique = $idCat")->fetch();
    		array_push($Tab_Arianne, new Categorie($ResultQuery['id_rubrique'], $ResultQuery['id_mere'], $ResultQuery['titreFR_rubrique'], $ResultQuery['titreEN_rubrique']));
    		$idMere = $ResultQuery['id_mere']; // catŽgorie mre ˆ la dernire entrŽe dans le tableau de resultats
    		
    		while($idMere != NULL) // tant que l'id mre n'est pas null, donc tant que nous sommes pas dans la catŽgorie de niveau 0
    		{
    			// On rŽcupre la catŽgorie mre ˆ celle qu'on a dŽja
    			$resultQuery = $connexion->query("SELECT * FROM RUBRIQUE WHERE id_rubrique = $idMere")->fetch();
    			array_push($Tab_Arianne, new Categorie($ResultQuery['id_rubrique'], $ResultQuery['id_mere'], $ResultQuery['titreFR_rubrique'], $ResultQuery['titreEN_rubrique']));
    			$idMere = $ResultQuery['id_mere']; // catŽgorie mre ˆ la dernire entrŽe dans le tableau de resultats    			
    			
    		}
    		    		
    	}
    	catch (PDOException $e)
    	{
    		$ex = new AccesTableException();
    		$ex->Message();
    	}
    	// DŽconnexion de la BD
    	$this->deconnexion();
    	return $Tab_Arianne;
    }
	
    
    
    
    // Retourne un tableau contenant le fil d'arianne en passant en param un article
    function getFilArianneWithArticle($idArt)
    {
    	$idArt = parent::security($idArt);
    	return ($this->getFilArianneWithCategorie($this->getAsssociateCategoryIDForArticle($idArt)));
    }
    
}

?>
