<?php
	include_once('BD.php');
	include_once('../METIER/AlbumPhoto.php');

class ArticleBD extends BD
{   
    public function __construct()
    {
        parent::__construct();
    }

    
    
    function getMostRecentAlbum()
    {
        try
        {
            $this->connexion() ;                
            $connexion = parent::getConnexion();
            $resultQuery = $connexion->query("SELECT id_album FROM ALBUM ORDER BY date_album ASC LIMIT 1")->fetch();
            $recentAlbm = new AlbumPhoto($resultQuery['id_album'], $resultQuery['nom_album'], $resultQuery['date_album']);
        }
        catch ( PDOException $e )
        {
            $ex = new AccesTableException() ;
            $ex->Message() ;
        }
        $this->deconnexion() ;
        return $recentAlbm;
    }

    function getAlbumById($id)
    {
        $CategoryId = intval(parent::security($CategoryId));
        try
        {
            $this->connexion() ;                
            $connexion = parent::getConnexion();
            $resultQuery = $connexion->query("SELECT * FROM ALBUM WHERE id_album = $id")->fetch();
            $album = new AlbumPhoto($resultQuery['id_album'], $resultQuery['nom_album'], $resultQuery['date_album']);
        }
        catch ( PDOException $e )
        {
            $ex = new AccesTableException() ;
            $ex->Message() ;
        }
        $this->deconnexion();
        return $album;
    }
}

?>