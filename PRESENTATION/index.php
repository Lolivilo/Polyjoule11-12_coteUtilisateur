<?php 
	session_start();
    require_once('../BD/acces_albumPhoto.php');
    require_once('../BD/acces_article.php');
    
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
				include("header.php");
			?>
        <div id="diapoAcceuil">
        	<?php	// S il n y a pas d articles, on affiche une image specifique
        		if( empty($tab) )
        		{
        			echo("<img src='Style/image/pasDePhoto.jpg' alt='Pas d image' />");
        		}
        		else
        		{
        			echo("<img src='".$tab[0]->getBasePhoto()."' alt='Image principale' />");
        		}
        	?>
            
            <div id="newsAcceuil">
            	<div class="scroll-pane">
                	<h2><?php echo($parserLangue->getWord("headlines")->getTraduction()); ?></h2>
               		<?php
               			if( ($nbArticlesIndex = determineNbArticlesIndex()) == 0)
               			{
               				echo("<p>Il n'y a aucun article à la une !</p>");
               			}
               			else
               			{
                    		for($i = 0 ; $nbArticlesIndex ; $i++)
                    		{
                    			if($tab[$i] != NULL)
                    			{
                        			echo("<div class='news'>");
                        			echo("<h3><span class='date'>".$tab[$i]->getFormatedDate()."</span> ".$tab[$i]->getTitre()."</h3>");
                        			echo("<p>".$tab[$i]->getApercu()."</p>");
                        			echo("<a href='".$tab[$i]->getUrl()."'>Lire la suite</a><div class='border'></div>");
                        			echo("</div>");
                        		}
                    		}
                    	}
                	?>
                </div>
            </div>
        </div>
    	<img src="Style/image/ombreAccueil.png" class="ombreAccueil"/>
        <ul id="menuAccueil">
        	<?php
        		$ArticleBD = new ArticleBD();
        		$homeArticles = $ArticleBD->getHomeArticles();
        		foreach($homeArticles as $art)
        		{
            		echo("<li><a href='".$art->getUrl()."'><img src='".$art->getBasePhoto()."' alt='".$art->getTitre()."'><span>".$art->getTitre()."</span></a><img src='Style/image/ombreAccueil.png' class='ombreAccueil'/></li>");	
            	}
            ?>			
        </ul>
        <?php
            include('footer.php');
        ?>
    </body>
</html>
