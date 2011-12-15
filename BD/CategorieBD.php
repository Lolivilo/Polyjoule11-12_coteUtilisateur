<?php
include_once 'BD.php';
include_once '../METIER/Categorie.php';

class CategorieBD extends BD {
   
	public function __construct( $host , $database , $user , $password )
	{
		parent::__construct($host, $database, $user, $password);
	
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
    
    // retourne la categorie parente la plus haute dans la hiérarchie
    function getOldestCategoryOfArticle($idArticle)
    {
    	
    	
    }
    
    
    
    
}

?>
