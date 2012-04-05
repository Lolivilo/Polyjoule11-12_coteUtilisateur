<?php
	session_start();
	
	require_once('../BD/AlbumPhotoBd.php');
	
	if( (!(isset($_GET['cat']))) || (!(intval($_GET['cat']))) )		// Si GET n est pas valide
    {
    	header('location: erreur.php?code=0');
    }
    else if( !(albumPhotoExists($_GET['cat'])) )
    {
    	header('location: erreur.php?code=1');
    }
    
    $AlbumPhotoBD = new AlbumPhotoBD();
    $currentAlbum = $AlbumPhotoBD->getAlbumById($_GET['cat']);
    $photoArray = $currentAlbum->getPhotos();   // Tableau de photos de l album courant
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml">  
<head>  
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
    <title>Polyjoule</title>  
    <link rel="stylesheet" type="text/css" href="Style/index.css" />
    <link rel="stylesheet" type="text/css" href="Style/skins/tango/skin.css" />
    <script  type="text/javascript" src="JavaScript/jquery-1.4.1.min.js"></script>
    <script  type="text/javascript" src="JavaScript/menu.js"></script>
    <script  type="text/javascript" src="JavaScript/dropDown.js"></script>
    <script  type="text/javascript" src="JavaScript/album_photo.js"></script>
    <script  type="text/javascript" src="JavaScript/jquery.jcarousel.min.js"></script>
    <script type="text/javascript">
		jQuery(document).ready(function() {
    		jQuery('#mycarousel').jcarousel();
		});
	</script>
</head>


<body>
    <?php 
        include('header.php');
        include('explorer/explorer.php');
    ?>
    <div id="corps">
    	<?php
        	echo("<h2>".$parserLangue->getWord('AlbPhoto')->getTraduction()."<span class='titreAlbum'>".$currentAlbum->getNom()."</span></h2>");
        	// Affichage de la photo actuelle
        	if($photoArray != NULL)
        	{
        		$firstPhoto = array_pop($photoArray);
        		echo("<h3>".$firstPhoto->getTitre()."</h3>");            // On affiche la premiere photo au depart
    	?>
    	<div id="photo">
            <div id="loader"></div>
                <?php
                    echo("<img src='".$firstPhoto->getLien()."' alt='".$firstPhoto->getTitre()."' />");	// Lien photo
                ?>
            <a id='descriptionLien'>Description</a>
            <p id='description'>
            	<?php
                	echo($firstPhoto->getDesc());
                ?>
            </p>
        </div>
        <div id="photoPagination">
        	<span id='idAlb' style='display:none'></span>
        	<a href="index.html" class="precedent"></a>
            <span>2 / 42</span> 
            <a href="index.html" class="suivant"></a>
        </div>

		<!-- Thumbnails -->
        <div id="albumPhoto">
        	<a href="index.html" class="precedent"></a>
        	<?php echo "<span id='idAlb' style='display:none'>".$firstPhoto->getIdAlbum()."</span>"; ?>
        	<div id="wrap">
            	<?php //<a href="index.html" class="precedent"></a> ?>
            	<ul id="mycarousel" class="jcarousel-skin-tango">
                	<?php
                    	foreach($currentAlbum->getPhotos() as $photo)
                    	{
                        	echo "<li><img src='".$photo->getThumbnail()."' style=\"width:100px; height:100px;\" /><span class='idImg' style='display:none'>".$photo->getId()."</span></li>";
                    	}
                	?>
            	</ul>
            	<?php //<a href="index.html" class="suivant"></a> ?>
        	</div>
        </div>

        	
       <?php
       	}
       	else
       	{
       		echo "<p>Il n'y a pas encore de photo dans cet album</p>";
       	}
       ?>
    </div>
            <?php
                include_once('footer.php');
            ?>
  </body>
</html>