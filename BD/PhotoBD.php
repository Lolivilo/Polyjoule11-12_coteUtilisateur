<?php
    include_once 'BD.php';
    include_once '../METIER/Photo.php';
    
    
    class PhotoBD extends BD
    {   
        public function __construct()
        {
            parent::__construct();
        }
        
        function getPhotoWithPhotoIdAndAlbumId($id_photo, $id_album)
        {
            $id_photo = intval(parent::security($id_photo));
            $id_album = intval(parent::security($id_album));
            $Photo = NULL;
            try
            {
                $this->connexion() ;                
                $connexion = parent::getConnexion();
                $resultPhoto = $connexion->query("SELECT * FROM PHOTO WHERE id_photo=$id_photo AND id_album=$id_album")->fetch();
                if($resultPhoto)
                    $Photo = new Photo($resultPhoto['id_photo'], $resultPhoto['id_album'], $resultPhoto['titreFR_photo'], $resultPhoto['titreEN_photo'], $resultPhoto['lien_photo'], $resultPhoto['date_photo']);
                $this->deconnexion();
                return $Photo;
            }
            catch ( PDOException $e )
            {
                $ex = new AccesTableException() ;
                $ex->Message() ;
            }
        }

    }
    
    
    ?>
