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
     * Retourne un tableau de cat�gories
     * Si le param�tre pass� est egal � NULL, la fonction retourne alors les cat�gories de 1er niveau, celles qui n'ont pas de cat�gorie m�re.
     * Si le param�tre pass� est un 
     */
    function getSousCategories ($CategorieParente)
    {
    
    	
    	$this->connexion() ;
    	
    	try
		{
			$connexion = parent::getConnexion();
			$CategorieParente = parent::security($connexion, $CategorieParente);
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
				$Categorie = new Categorie($Cat['id_rubrique'],
										   $Cat['id_mere'],
										   $Cat['titreFR_rubrique'],
										   $Cat['titreEN_rubrique'],
										   $Cat['descFR_rubrique'],
										   $Cat['descEN_rubrique'],
										   $Cat['id_template']
										  );
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
   
	/** getCategorieWithId
	 * 
	 * Renvoie un objet de type Categorie � partir de son ID
	 * @param $idCat : l'ID de la Categorie � retourner
	 * @return l'objet de type Categorie correspondant
	 */
	function getCategorieWithId ($idCat)
	{
        
		$this->connexion() ;
    	
		try
		{
			
			$connexion = parent::getConnexion();
			$idCat = intval(parent::security($connexion, $idCat));
			$ResultQuery = $connexion->query( "SELECT * FROM RUBRIQUE WHERE id_rubrique=$idCat" );
			if($ResultQuery != NULL) // Pour eviter une erreur si l'id categorie pass� est null
			{
				$ResultQuery = $ResultQuery->fetch();
				//Ici on instancie un objet categorie � l'aide des infos recup�r�es dans la base
				$Categorie = new Categorie($ResultQuery['id_rubrique'],
										   $ResultQuery['id_mere'],
										   $ResultQuery['titreFR_rubrique'],
										   $ResultQuery['titreEN_rubrique'],
										   $ResultQuery['descFR_rubrique'],
										   $ResultQuery['descEN_rubrique'],
										   $ResultQuery['id_template']
										  );
			}
			else 
			{
				$Categorie = new Categorie(0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0);
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
    	
    	$this->connexion();	// Connexion � la BD
    	$idMere = NULL;
    	
    	try
    	{
    		$connexion = parent::getConnexion();
    		$idCat = parent::security($connexion, $idCat);

    		do
    		{
    			// On r�cup�re l'id_mere de la cat�gorie courante
    			$resultQuery = $connexion->query("SELECT * FROM RUBRIQUE WHERE id_rubrique = $idCat")->fetch();
    			$idMere = $resultQuery['id_mere'];
    			if($idMere != NULL)	// Si elle existe, elle devient la cat�gorie courante pour la prochaine it�ration de boucle
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
		// D�connexion de la BD
		$this->deconnexion();
		$Categorie = new Categorie($resultQuery['id_rubrique'],
								   $resultQuery['id_mere'],
								   $resultQuery['titreFR_rubrique'],
								   $resultQuery['titreEN_rubrique'],
								   $resultQuery['descFR_rubrique'],
								   $resultQuery['descEN_rubrique'],
								   $resultQuery['id_template']
								  );
		return $Categorie;
    }
    
    
    // retourne l'id de la categorie parente la plus haute dans la hi�rarchie
    function getSuperParentCategoryOfArticle($idArt)
    {
    	
    	// Connexion � la BD
    	$this->connexion();
    	
    	$idDirectCat = NULL;	// Cat�gorie li�e � l'article
    	
    	try
    	{
    		$connexion = parent::getConnexion();
    		$idArt = parent::security($connexion, $idArt);
    		// On r�cup�re l'id_rubrique de l'article
    		$resultQuery = $connexion->query("SELECT id_rubrique FROM ARTICLE WHERE id_article = $idArt")->fetch();
			
    		$idDirectCat = $resultQuery['id_rubrique'];
    		echo $idDirectCat;
            if($idDirectCat != NULL)
    		{
                
    			// Puis on appelle la fonction renvoyant la super cat�gorie
    			$idMere = $this->getSuperParentCategoryOfCategory($idDirectCat);
                //echo $idMere;
    		}
    		else $idMere = 0; // Si la cat�gorie de l'article est inconnue
    	}
    	catch (PDOException $e)
    	{
    		$ex = new AccesTableException();
    		$ex->Message();
    	}
    	// D�connexion de la BD
    	$this->deconnexion();
    	return $idMere;
    }
    
    
	// retourne l'ID de la cat�gorie directement associ�e � un article
    function getAsssociateCategoryIDForArticle($idArt)
    {
    	
    	// Connexion � la BD
    	$this->connexion();
    	
    	
    	try
    	{
    		$connexion = parent::getConnexion();
    		$idArt = parent::security($connexion, $idArt);
    		// On r�cup�re l'id_rubrique de l'article
    		$ResultQuery = $connexion->query("SELECT id_rubrique FROM ARTICLE WHERE id_article = $idArt")->fetch();
			$Categorie = $ResultQuery['id_rubrique'];
    		
    	}
    	catch (PDOException $e)
    	{
    		$ex = new AccesTableException();
    		$ex->Message();
    	}
    	// D�connexion de la BD
    	$this->deconnexion();
    	return $Categorie;
    }
	
    // Retourne un tableau contenant le fil d'arianne en passant en param une cat�gorie
    function getFilArianneWithCategorie($idCat)
    {
    	
    	// Connexion � la BD
    	$this->connexion();
    	
    	$Tab_Arianne = array();
    	try
    	{
    		$connexion = parent::getConnexion();
    		$idCat = parent::security($connexion, $idCat);
    		//Recuperation, instanciation de la categorie en param�tre et ajout dans le tableau
    		$resultQuery = $connexion->query("SELECT * FROM RUBRIQUE WHERE id_rubrique = $idCat")->fetch();
    		array_push($Tab_Arianne, new Categorie($ResultQuery['id_rubrique'],
    											   $ResultQuery['id_mere'],
    											   $ResultQuery['titreFR_rubrique'],
    											   $ResultQuery['titreEN_rubrique'],
    											   $ResultQuery['descFR_rubrique'],
    											   $ResultQuery['descEN_rubrique'],
    											   $ResultQuery['id_template'])
    											  );
    		$idMere = $ResultQuery['id_mere']; // cat�gorie m�re � la derni�re entr�e dans le tableau de resultats
    		
    		while($idMere != NULL) // tant que l'id m�re n'est pas null, donc tant que nous sommes pas dans la cat�gorie de niveau 0
    		{
    			// On r�cup�re la cat�gorie m�re � celle qu'on a d�ja
    			$resultQuery = $connexion->query("SELECT * FROM RUBRIQUE WHERE id_rubrique = $idMere")->fetch();
    			array_push($Tab_Arianne, new Categorie($ResultQuery['id_rubrique'],
    												   $ResultQuery['id_mere'],
    												   $ResultQuery['titreFR_rubrique'],
    												   $ResultQuery['titreEN_rubrique'],
    												   $ResultQuery['descFR_rubrique'],
    												   $ResultQuery['descEN_rubrique'],
    												   $ResultQuery['id_template'])
    												  );
    			$idMere = $ResultQuery['id_mere']; // cat�gorie m�re � la derni�re entr�e dans le tableau de resultats    			
    			
    		}
    		    		
    	}
    	catch (PDOException $e)
    	{
    		$ex = new AccesTableException();
    		$ex->Message();
    	}
    	// D�connexion de la BD
    	$this->deconnexion();
    	return $Tab_Arianne;
    }
	
    
    
    
    // Retourne un tableau contenant le fil d'arianne en passant en param un article
    function getFilArianneWithArticle($idArt)
    {
    	return ($this->getFilArianneWithCategorie($this->getAsssociateCategoryIDForArticle($idArt)));
    }
    
}
    

function getSousCategories ($idMere)
{
    $bd = new BD();
    $this->connexion();
    
    try
    {
        $connexion = $bd->getConnexion();
        $param = intval($bd->security($connexion, $idMere));
        // si on cherche � obtenir les sous cat�gories de la cat�gorie donn�e en param�tre
        $result = $connexion->query( "SELECT * FROM RUBRIQUE WHERE id_mere=$param" )->fetchAll();
        $tabCategories = array();
        foreach($result as $row)
        {
            $cat = new Categorie($row['id_rubrique'],
                                 $row['id_mere'],
                                 $row['titreFR_rubrique'],
                                 $row['titreEN_rubrique'],
                                 $row['descFR_rubrique'],
                                 $row['descEN_rubrique'],
                                 $row['id_template']
                                );
            array_push($tabCategories, $cat);
            
        }
    }
    catch(PDOException $e)
    {
        // A REMPLIR
    }
    $bd->deconnexion() ;
    
    return $tabCategories;
}

function getCategorieById( $id )
{
    $bd = new Bd();
    
    
    try
    {
        $bd->connexion();
        
        $conexion = $bd->getConnexion();
        $param = intval($bd->security($connexion, $id));
        $result = $connexion->query("SELECT * FROM RUBRIQUE WHERE id_rubrique = $param")->fetch();
        $ret = new Categorie($result['id_rubrique'],
                             $result['id_mere'],
                             $result['titreFR_rubrique'],
                             $result['titreEN_rubrique'],
                             $result['descFR_rubrique'],
                             $result['descEN_rubrique'],
                             $result['id_template']
                            );
    }
    catch(PDOException $e)
    {
        // A REMPLIR
    }
    
    return $ret;
}

function getNomTemplateById($id)
{
	$bd = new BD();
	
	
	try
	{
		$bd->connexion();
		
		$connexion = $bd->getConnexion();
		$param = intval($bd->security($connexion, $id));
		$res = $connexion->query("SELECT template FROM TEMPLATE WHERE id=$param");
		if($res != NULL)
		{
			$res = $res->fetch();
		}
		else
		{
			return NULL;
		}
	}
	catch(PDOException $e)
	{
		// EXCEPTION
	}
	$bd->deconnexion();
	
	return $res['template'];
}

function getNomTemplateByIdRubrique($idCat)
{
	$bd = new BD();
	
	try
	{
		$bd->connexion();
	
		$connexion = $bd->getConnexion();
		$param = intval($bd->security($connexion, $idCat));
		$res = $connexion->query("SELECT template FROM TEMPLATE JOIN RUBRIQUE ON RUBRIQUE.id_template = TEMPLATE.id WHERE RUBRIQUE.id_rubrique = $param");
		if($res != NULL)
		{
			$res = $res->fetch();
		}
		else
		{
			return NULL;
		}
	}
	catch(PDOException $e)
	{
	
	}
	
	return $res['template'];
}


function getIdTemplateByIdRubrique($idCat)
{
	$bd = new BD();
	
	try
	{
		$bd->connexion();
	
		$connexion = $bd->getConnexion();
		$param = intval($bd->security($connexion, $idCat));
		$res = $connexion->query("SELECT id FROM TEMPLATE JOIN RUBRIQUE ON RUBRIQUE.id_template = TEMPLATE.id WHERE RUBRIQUE.id_rubrique = $param");
		if($res != NULL)
		{
			$res = $res->fetch();
		}
		else
		{
			return NULL;
		}
	}
	catch(PDOException $e)
	{
	
	}
	
	return $res['id'];
}


function categorieExists($idCat)
{
	$bd = new BD();
	
	
	try
	{
		$bd->connexion();
		$connexion = $bd->getConnexion();
		$param = intval($bd->security($connexion, $idCat));
		$res = $connexion->query("SELECT * FROM RUBRIQUE WHERE id_rubrique=$param")->fetch();
	}
	catch(PDOException $e)
	{
		// EXCEPTION
	}
	
	$bd->deconnexion();
	
	if($res == NULL)
	{
		return FALSE;
	}
	return TRUE;
}
?>
