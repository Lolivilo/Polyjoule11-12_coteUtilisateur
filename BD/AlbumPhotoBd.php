<?php
	require_once('BD.php');
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
        $id = intval(parent::security($id));
        try
        {
            $this->connexion() ;                
            $connexion = parent::getConnexion();
            $resultQuery = $connexion->query("SELECT * FROM ALBUM WHERE id_album = $id")->fetch();
            $album = new AlbumPhoto($resultQuery['id_album'], $resultQuery['nom_album'], $resultQuery['date_album']);
            $this->addPhotosToAlbum($album);
        }
        catch ( PDOException $e )
        {
            $ex = new AccesTableException() ;
            $ex->Message() ;
        }
        $this->deconnexion();
        return $album;
    }
    
    function addPhotosToAlbum($Album)
    {
        $AlbumID = intval(parent::security($Album->getId()));
        try
        {
            $this->connexion() ;                
            $connexion = parent::getConnexion();
            $res = $connexion->query("SELECT * FROM PHOTO JOIN ALBUM WHERE PHOTO.id_album = ALBUM.id_album AND ALBUM.id_album = $AlbumID")->fetchAll();
            
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
        catch ( PDOException $e )
        {
            $ex = new AccesTableException() ;
            $ex->Message() ;
        }
        $this->deconnexion();
    }
    
}

function getNbAlbums()
{
    $bd = new Bd();
    try
    {
        $bd->connexion();
        $connexion = $bd->getConnexion();
        $result = $connexion->query("SELECT COUNT(*) FROM ALBUM")->fetch();
    }
    catch(PDOException $e)
    {
        
    }
    
    $bd->deconnexion();
    return $result['COUNT(*)'];
}
    
function getMostRecentAlbum()
{
    $bd = new BD();
    try
    {
        $bd->connexion();
        $connexion = $bd->getConnexion();
        $result = $connexion->query("SELECT id_album FROM ALBUM ORDER BY date_album DESC LIMIT 1")->fetch();
    }
    catch(PDOException $e)
    {
        // A REMPLIR
    }
    $bd->deconnexion();
    return $result['id_album'];
}
    
function getAllAlbums()
{
    $bd = new Bd();
    try
    {
        $bd->connexion();
        $connexion = $bd->getConnexion();
        $result = $connexion->query("SELECT * FROM ALBUM ORDER BY date_album DESC")->fetchAll();
        $ret = array();
        foreach($result as $row)
        {
            $album = new albumPhoto($row['id_album'],
                                    $row['nom_album'], 
                                    $row['date_album']);
            array_push($ret, $album);
        }
    }
    catch(PDOException $e)
    {
        // A REMPLIR
    }
    $bd->deconnexion();
    
    return $ret;
}
?>