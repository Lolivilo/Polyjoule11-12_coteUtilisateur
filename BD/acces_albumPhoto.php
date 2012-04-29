<?php
	require_once("BD.php");
	require_once('../METIER/AlbumPhoto.php');
    require_once('../METIER/Photo.php');


class AlbumPhotoBD extends BD
{   
    public function __construct()
    {
        parent::__construct();
    }

    
    /*
    function getMostRecentAlbum()
    {
        try
        {
            $this->connexion() ;                
            $connexion = parent::getConnexion();
            $resultQuery = $connexion->query("SELECT id_album FROM ALBUM ORDER BY date_album ASC LIMIT 1")->fetch();
            $recentAlbm = new AlbumPhoto($resultQuery['id_album'], $resultQuery['nom_album'], $resultQuery['date_album']);
            addPhotosToAlbum($recentAlbm);
        }
        catch ( PDOException $e )
        {
            $ex = new AccesTableException() ;
            $ex->Message() ;
        }
        $this->deconnexion() ;
        return $recentAlbm;
    }*/

    function getAlbumById($id)
    {
        try
        {
            $this->connexion() ;                
            $connexion = parent::getConnexion();
            $id = intval(parent::security($connexion, $id));
            
           	$resultQuery = $connexion->query("SELECT * FROM ALBUM WHERE id_album = $id");
           	if($resultQuery == NULL)
           	{
           		throw new RequestException();
           	}
           	else
           	{
           		$resultQuery = $resultQuery->fetch();
            }

            $album = new AlbumPhoto($resultQuery['id_album'],
                                    $resultQuery['nom_album'],
                                    $resultQuery['date_album'],
                                    $resultQuery['descFR_album'],
                                    $resultQuery['descEN_album']);
            $this->addPhotosToAlbum($album);
        }
        catch ( PDOException $ex )
        {
            $ex = new AccesTableException() ;
            $ex->Message() ;
        }
        $this->deconnexion();
        return $album;
    }
    
    function addPhotosToAlbum($Album)
    {
        
        try
        {
            $this->connexion() ;                
            $connexion = parent::getConnexion();
            $AlbumID = intval(parent::security($connexion, $Album->getId()));
       
            $res = $connexion->query("SELECT * FROM PHOTO JOIN ALBUM WHERE PHOTO.id_album = ALBUM.id_album AND ALBUM.id_album = $AlbumID");
           	if($res == NULL)
           	{
           		throw new RequestException();
           	}
           	else
           	{
           		$res= $res->fetchAll();
           	}
            foreach($res as $resultPhoto)
            {
                $newPhoto = new Photo($resultPhoto['id_photo'],
                                      $resultPhoto['id_album'],
                                      $resultPhoto['titreFR_photo'],
                                      $resultPhoto['titreEN_photo'],
                                      $resultPhoto['lien_photo'],
                                      $resultPhoto['date_photo'],
                                      $resultPhoto['descFR_photo'],
                                      $resultPhoto['descEN_photo']);
                $Album->addPhoto($newPhoto);
            }
        }
        
        catch(RequestException $e)
        {
        	echo( $e->getMessage() );
			$bd->deconnexion();
			return NULL;
        }
        catch ( PDOException $ex )
        {
            $ex = new AccesTableException() ;
            $ex->Message() ;
        }
       
        $this->deconnexion();
        
    }
}


/** function getNbAlbums()
	Compte le nombre d'albums photos présents dans la base
	@return int $result['COUNT(*)']
**/
function getNbAlbums()
{
    $bd = new Bd();
    try
    {
        $bd->connexion();
        $connexion = $bd->getConnexion();
        $result = $connexion->query("SELECT COUNT(*) FROM ALBUM");
        
        if($result == NULL)
        {
        	throw new RequestException();
        }
        else
        {
        	$result = $result->fetch();
        }
    }
    catch(PDOException $e)
    {
        
    }
    
    $bd->deconnexion();
    
    return $result['COUNT(*)'];
}

/*
function getMostRecentAlbum()
{
    $bd = new BD();
    
    try
    {
        $bd->connexion();
        $connexion = $bd->getConnexion();
        $result = $connexion->query("SELECT id_album FROM ALBUM ORDER BY date_album DESC LIMIT 1");
        
        if($result == NULL)
        {
        	throw new RequestException();
        }
        else
        {
        	$result = $result->fetch();
        }
    }
    catch(RequestException $e)
    {
    	echo( $e->getMessage() );
		$bd->deconnexion();
		return NULL;
    }
    catch(PDOException $ex)
    {
        // A REMPLIR
    }
    
    $bd->deconnexion();
    
    return $result['id_album'];
}
*/


/** function getFiveMostRecentAlbums()
	Va chercher dans la BD les 5 albums les plus recents
	@return AlbumPhoto[5]
**/
function getFiveMostRecentAlbums($debut)
{
    $bd = new BD();
    
    try
    {
        $bd->connexion();
        $connexion = $bd->getConnexion();
        $result = $connexion->query("SELECT * FROM ALBUM ORDER BY date_album DESC LIMIT $debut, 5");
        
        if($result == NULL)
        {
        	throw new RequestException();
        }
        else
        {
        	$result = $result->fetchAll();
        }
        
        $res = array();
        foreach($result as $row)
        {
        	$album = new albumPhoto($row['id_album'],
                                    $row['nom_album'], 
                                    $row['date_album'],
                                    $row['descFR_album'],
                                    $row['descEN_album']);
            array_push($res, $album);
        }
    }

    catch(PDOException $ex)
    {
        // A REMPLIR
    }
    
    $bd->deconnexion();
    
    return $res;
}


function getAllAlbums()
{
    $bd = new Bd();
    
    try
    {
        $bd->connexion();
        $connexion = $bd->getConnexion();
        $result = $connexion->query("SELECT * FROM ALBUM ORDER BY date_album DESC");
        
        if($result == NULL)
        {
        	throw new RequestException();
        }
        else
        {
        	$result = $result->fetchAll();
        }
        
        $ret = array();
        foreach($result as $row)
        {
            $album = new albumPhoto($row['id_album'],
                                    $row['nom_album'], 
                                    $row['date_album'],
                                    $row['descFR_album'],
                                    $row['descEN_album']);
            array_push($ret, $album);
        }
    }
    catch(RequestException $e)
    {
    	echo( $e->getMessage() );
		$bd->deconnexion();
		return NULL;
    }
    catch(PDOException $e)
    {
        // A REMPLIR
    }
    $bd->deconnexion();
    
    return $ret;
}


////////////////////////////////////////////////////////////////////////////////////////////////////


function getFirstPhotoById($idAlbum)
{
	$bd = new BD();
	
	try
	{
		$bd->connexion();
		$connexion = $bd->getConnexion();
		$param = intval($bd->security($connexion , $idAlbum));

		$result = $connexion->query("SELECT * FROM PHOTO WHERE id_album = $param ORDER BY id_photo LIMIT 1");
		$Photo = NULL;
		if($result != NULL)
		{
			$resultPhoto = $result->fetch();
			$Photo = new Photo($resultPhoto['id_photo'],
                               $resultPhoto['id_album'],
                               $resultPhoto['titreFR_photo'],
                               $resultPhoto['titreEN_photo'],
                               $resultPhoto['lien_photo'],
                               $resultPhoto['date_photo'],
                               $resultPhoto['descFR_photo'],
                               $resultPhoto['descEN_photo']);
		}
		else
		{
			throw new RequestException();
		}

	}
	catch(RequestException $e)
	{
		echo( $e->getMessage() );
		$bd->deconnexion();
		return NULL;
	}
	catch(PDOException $e)
	{
		// A REMPLIR
	}
	
	$bd->deconnexion();
	
	return $Photo;
}


////////////////////////////////////////////////////////////////////////////////////////////////////


function getNbPhotosById($idAlbum)
{
	$bd = new BD();
	
	
	try
	{
		$bd->connexion();
		$connexion = $bd->getConnexion();
		$param = intval($bd->security($connexion, $idAlbum));
		$result = $connexion->query("SELECT COUNT(*) FROM PHOTO WHERE id_album = $param");
		
		if($result == NULL)
		{
			throw new RequestException();
		}
		else
		{
			$result = $result->fetch();
		}
	}
	
	catch(RequestException $e)
	{
		echo( $e->getMessage() );
		$bd->deconnexion();
		return NULL;
	}
	catch(PDOException $ex)
	{
		// A REMPLIR
	}
	
	$bd->deconnexion();
	
	return $result['COUNT(*)'];
}


////////////////////////////////////////////////////////////////////////////////////////////////////

/*
function albumPhotoExists($idAlb)
{
	$bd = new BD();
	
	
	try
	{
		$bd->connexion();
		$connexion = $bd->getConnexion();
		$param = intval($bd->security($connexion, $idAlb));
		$result = $connexion->query("SELECT * FROM ALBUM WHERE id_album = $param");
		if($result == NULL)
		{
			throw new RequestException();
		}
		else
		{
			$result = $result->fetch();
		}
	}
	catch(RequestException $e)
	{
		echo( $e->getMessage() );
		$bd->deconnexion();
		return false;
	}
	catch(PDOException $e)
	{
		// A REMPLIR
	}
	
	$bd->deconnexion();
	
	if($result == NULL)
	{
		return false;
	}
	
	return true;
}
*/

?>