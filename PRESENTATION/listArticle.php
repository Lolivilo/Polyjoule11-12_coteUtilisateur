<?php
	session_start();
	
	require_once('../BD/CategorieBD.php');
    require_once('../BD/ArticleBD.php');
    
    if( (!(isset($_GET['cat']))) || (!(intval($_GET['cat']))) )		// Si GET n est pas valide
    {
    	header('location: erreur.php?code=0');
    }
    else if( !(categorieExists($_GET['cat'])) )
    {
    	header('location: erreur.php?code=1');
    }
    
    $categorieCourante = new CategorieBD();
    $categorieCourante = $categorieCourante->getCategorieWithId($_GET['cat']);
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
</head>

<body>
<?php 
    include('header.php');
    include('explorer/explorer.php');
?>
    <div id="corps">
    	<h2 id="titreNews"><img src="Style/image/time.png" alt="The Polyjoule Times"/></h2>
    <?php
                // FAUT IL CHERCHER LES ARTICLES DE LA CAT ENFANT ? EN + DES ARTICLES DE LA CAT EN COUR OU LES 2?
                // AFFICHAGE DES ARTICLES
    
                $ArticleBD = new ArticleBD();
                $TabArticles = array();
                $TabArticles = $ArticleBD->getArticlesWithCategory($categorieCourante->getId());

                foreach($TabArticles as $art)
                {
                    echo "<div class='listeArticle'>";
                	$BasePhoto = $art->getBasePhoto();
                		if($BasePhoto != NULL)
                		{
                			echo "<img style=\"width:100px\" src=\"".$BasePhoto."\"/>";
                		}
                		else
                		{
                			echo "<img style=\"width:100px\" src=\"Style/image/photo.png\" />";
                		}
                	echo "<div class='description'><h3>".$art->getTitre()."</h3><div class='date'>".$art->getFormatedDate()."</div><p>".$art->getApercu()."</p></div><a href='".$art->getUrl()."'>Lire la suite ...</a><div class='clear'></div></div>";
                }
                //Si il n'y a pas d'article dans la catégorie
                if(empty($TabArticles))
                {
                    echo "<p>Il n'y a pas d'article dans cette cat&eacute;gorie</p>";
                }
            ?>
            
            <?php
            	$nbArticles = getNbArticlesByCategorie($categorieCourante->getId());
            	echo(generatePagination($nbArticles, $_GET['cat']));
            ?>

            <div id="footerCorps">
            </div>
        </div>
        <?php
                include_once('footer.php');
            ?>
    </body>
</html>