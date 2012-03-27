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
        $photoArray = $currentAlbum->getPhotos();   // Tableau de photos de l album courant        
        echo("<h3>".$currentAlbum->getNom()."</h3>");
        if($photoArray != NULL)
        {
        	$firstPhoto = array_pop($photoArray);
        	echo("<p>".$firstPhoto->getTitre()."</p>");            // On affiche la premiere photo au depart
    ?>
        	<div id="photo">
            	<div id="loader"></div>
                	<?php
                    	echo("<img src='".$firstPhoto->getLien()."' alt='".$firstPhoto->getTitre()."' />");
                	?>
            	
            	<p>
                	<?php
                    	echo($firstPhoto->getDesc());
                	?>
            	</p>
        	</div>
        	<div id="photoPagination">
            	<?php echo "<span id='idAlb' style='display:none'>".$firstPhoto->getIdAlbum()."</span>"; ?>
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
            	<p><?php echo($firstPhoto->getDesc());?></p>
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