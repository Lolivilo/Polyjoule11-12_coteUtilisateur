<?php
include_once 'BD.php';
include_once '../METIER/Categorie.php';

class CategorieBD extends BD {
   
	public function __construct( $host , $database , $user , $password )
	{
		parent::__construct($host, $database, $user, $password);
	
	}
	
    /**
     * Retourne un tableau de cat�gories
     * Si le param�tre pass� est egal � NULL, la fonction retourne alors les cat�gories de 1er niveau, celles qui n'ont pas de cat�gorie m�re.
     * Si le param�tre pass� est un 
     */
    function getSousCategories ($CategorieParente) {
    	
    	$CategorieParente = parent::security($CategorieParente);
    	$this->connexion() ;
    	try
		{
			$connexion = parent::getConnexion();
			if($CategorieParente == NULL)//Si on cherche � obtenir les cat�gories parentes ( 1er niveau)
			{
				$ResultQuery = $connexion->query( "SELECT * FROM RUBRIQUE WHERE id_mere IS NULL" )->fetchAll();
			}
			else {// si on cherche � obtenir les sous cat�gories de la cat�gorie donn�e en param�tre
				$ResultQuery = $connexion->query( "SELECT * FROM RUBRIQUE WHERE id_mere=$CategorieParente" )->fetchAll();
			}
			$categoriesTab = array(); // tableau contenant les cat�gories m�res � retourner
			foreach($ResultQuery as $Cat)
			{// Parcours des cat�gories r�cup�r�es dans la base
				//Ici on instancie un objet categorie � l'aide des infos recup�r�es dans la base
				$Categorie = new Categorie($Cat['id_rubrique'], $Cat['id_mere'], $Cat['titreFR_rubrique'], $Cat['titreEN_rubrique']);
				//On ajoute cette cat�gorie dans le tableau de cat�gories m�res
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
			
			//Ici on instancie un objet categorie � l'aide des infos recup�r�es dans la base
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
    
    // retourne la categorie parente la plus haute dans la hi�rarchie
    function getOldestCategoryOfArticle($idArticle)
    {
    	
    	
    }
    
    
    
    
}

?>
