<?php 
	session_start();
    require_once('../BD/AlbumPhotoBd.php');
    require_once('../BD/ArticleBD.php');
    
    $tab = getAllArticles();    // Tableau contenant tous les articles
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml">  
    <head>  
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
        <title>Polyjoule</title>  
        <link rel="stylesheet" type="text/css" href="Style/index.css" />
        <script type="text/javascript" src="JavaScript/jquery.js"></script>
        <script type="text/javascript" src="JavaScript/menu.js"></script>
        <script type="text/javascript" src="JavaScript/dropDown.js"></script>
        <script type="text/javascript" src="JavaScript/jquery-1.4.1.min.js"></script>
        <script type="text/javascript" src="JavaScript/jScrollPane.js"></script>
        <script type="text/javascript" src="JavaScript/site.js"></script>
    </head>
    <body>
			<?php 
				include('header.php');
			?>
        <div id="diapoAcceuil">
            <img src=<?php echo("'".$tab[0]->getBasePhoto()."'");?> alt=''>
            <div id="newsAcceuil">
            	<div class="scroll-pane">
            		<a href="trombinoscope.php?equipe=2">TROMBI</a>
                	<h2><?php echo($parserLangue->getWord("headlines")->getTraduction()); ?></h2>
               		<?php
                    	for($i = 0 ; $i < determineNbArticlesIndex() ; $i++)
                    	{
                        	echo("<div class='news'>");
                        	echo("<h3><span class='date'>".$tab[$i]->getFormatedDate()."</span> ".$tab[$i]->getTitre()."</h3>");
                        	echo("<p>".$tab[$i]->getApercu()."</p>");
                        	echo("<a href='article.php?article=".$tab[$i]->getId()."'>Lire la suite</a><div class='border'></div>");
                        	echo("</div>");
                    	}
                	?>
                </div>
            </div>
        </div>
    
        <ul id="menuAccueil">
        	<?php
        		$ArticleBD = new ArticleBD();
        		$homeArticles = $ArticleBD->getHomeArticles();
        		foreach($homeArticles as $art)
        		{
            		echo("<li><a href='".$art->getUrl()."'><img src='".$art->getBasePhoto()."' alt='".$art->getTitre()."'><span>".$art->getTitre()."</span></a></li>");	
            	}
            ?>			
        </ul>
        <?php
            include('footer.php');
        ?>
    </body>
</html>
