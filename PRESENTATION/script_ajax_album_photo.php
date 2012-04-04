<?php
    session_start();
    require_once('../BD/AlbumPhotoBd.php');
    require_once('../BD/PhotoBD.php');
    $Array = array();
    $Photo = NULL;

    if(isset($_POST['id_photo']) && $_POST['id_photo'] != '' && isset($_POST['id_album']) && $_POST['id_album'] != '')
    {
        $IdPhoto = $_POST['id_photo'];
        $IdAlbum = $_POST['id_album'];
        $PhotoBD = new PhotoBD();
        $Photo = $PhotoBD->getPhotoWithPhotoIdAndAlbumId($IdPhoto, $IdAlbum);
    }
    
    if($Photo == NULL)
    {
        $Array = array('success' => 'no', 'texte' => 'Erreur lors du traitement sur le serveur');
    }
    else
    {
        $Array = array('success' => 'yes', 'id' => $Photo->getId(), 'url' => $Photo->getlien(), 'titre' => $Photo->getTitre(), 'date' => $Photo->getDate(), 'commentaire' => 'Commentaire...' );
    }
    $JSON = json_encode($Array);
    echo $JSON;

?>