<?php
	session_start();
    require_once('../BD/LangueParser.php');
	require_once('../BD/AlbumPhotoBd.php');
    $album = NULL;
    if(isset($_GET['idAlbum']) && $_GET['idAlbum'] != '')
    {
        $AlbumPhotoBD = new AlbumPhotoBD();
        $currentAlbum = $AlbumPhotoBD->getAlbumById($_GET['idAlbum']);
    }
    if($currentAlbum == NULL)
    {
        header('Location: index.php');
    }
    
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml">  
<head>  
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
    <title>Polyjoule</title>  
    <link rel="stylesheet" type="text/css" href="Style/index.css" />
    <script  type="text/javascript" src="JavaScript/jquery.js"></script>
    <script  type="text/javascript" src="JavaScript/menu.js"></script>
    <script  type="text/javascript" src="JavaScript/dropDown.js"></script>
    <script  type="text/javascript" src="JavaScript/album_photo.js"></script>
    <script  type="text/javascript" src="JavaScript/jquery.json-2.3.min.js"></script>
</head>

<body>
    <?php 
        include('header.php');
        include('explorer/explorer.php');
    ?>
    <div id="corps">
    <?php
        echo("<h2>".$parserLangue->getWord('AlbPhoto')->getTraduction()."</h2>");
        echo("<h3>".$currentAlbum->getNom()."</3>");
        $photoArray = $currentAlbum->getPhotos();   // Tableau de photos de l album courant
        echo("<p>".$photoArray[0]->getTitre()."</p>");            // On affiche la premiere photo au depart
    ?>
        <div id="photo">
            <div id="loader">
                <?php
                    echo("<img src='".$photoArray[0]->getLien()."' alt='".$photoArray[0]->getTitre()."' />");
                ?>
            </div>
            <p>
                <?php
                    echo($photoArray[0]->getDesc());
                ?>
            </p>
        </div>
        <div id="photoPagination">
            <?php echo "<span id='idAlb' style='display:none'>".$photoArray[0]->getIdAlbum()."</span>"; ?>
            <a href="index.html" class="precedent"></a>
            <span>2 / 42</span>
            <a href="index.html" class="suivant"></a>
        </div>

        <div id="albumPhoto">
            <a href="index.html" class="precedent"></a>
            <ul id="photos">
                <?php
                    foreach($currentAlbum->getPhotos() as $photo)
                    {
                        echo "<li><a href='index.html' ><img src='".$photo->getLien()."' /><span class='idImg' style='display:none'>".$photo->getId()."</span></a></li>";
                    }
                ?>
            </ul>
            <a href="index.html" class="suivant"></a>
        </div>	

        <div id="footerCorps">
            <p><?php echo($photoArray[0]->getDesc());?></p>
        </div>
    </div>
            <?php
                include_once('footer.php');
            ?>
        </body>
    </html>