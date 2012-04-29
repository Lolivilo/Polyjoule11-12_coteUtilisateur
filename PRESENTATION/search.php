<?php
	session_start();
	
	require_once('../BD/acces_article.php');
	
	$StringRecherche = NULL;
    if(isset($_GET['w']) && $_GET['w'] != '')
    {
        $StringRecherche = $_GET['w'];
    }
    if($StringRecherche == NULL)
    {
        header('Location: erreur-2');
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
    </head>
    <body>
		<?php 
			include('header.php');
		?>

        <div id="corps">
            <?php
            $ArticleBD = new ArticleBD();
            $resultats = array();
            $resultats = $ArticleBD->getArticlesWithSearchTerms($StringRecherche,NULL,NULL);
            //Si il n'y a pas d'article dans la catégorie
            if(empty($resultats))
            {
            	echo "<p>".$parserLangue->getWord("aucun_resultat")->getTraduction()."</p>";
            }
			else
			{
				foreach($resultats as $art)
            	{
            		echo "<div class='listeArticle'><img src='Style/image/photo.png' /><div class='description'><h3>".$art->getTitre()."</h3><div class='italic'>".$art->getFormatedDate()."</div><p>".$art->getApercu()."</p></div><a href='".$art->getUrl()."'>Lire la suite ...</a><div class='clear'></div></div>";
           		}
           	}
            ?>

            <div id="footerCorps">
            </div>
        </div>
        <?php
                include_once('footer.php');
            ?>
    </body>
</html>