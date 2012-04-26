<?php
	session_start();
	
	require_once('../BD/acces_rubrique.php');
    require_once('../BD/acces_article.php');
    require_once('../METIER/FonctionsMetier/verificationGet.php');
    
    verifGet();
    
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
                try
                {
                	$TabArticles = $ArticleBD->getArticlesWithCategory($categorieCourante->getId());
                }
                catch(RequestException $e)
                {
                	echo( $e->getMessage() );
                }
                
                if(empty($TabArticles))
                {
                    echo "<p>".$parserLangue->getWord("aucun_article")->getTraduction()."</p>";
                }
                else
                {
                
                	$debut = getIndexDebutFor($_GET['numPage'], 5);
					for($i = $debut ; $i < getIndexFinFor($debut, getNbArticlesByCategorie($categorieCourante->getId()), 5) ; $i++ )
					{
						echo "<div class='listeArticle'>";
                		$BasePhoto = $TabArticles[$i]->getBasePhoto();
                		if($BasePhoto != NULL)
                		{
                			echo "<img style=\"width:100px\" src=\"".$BasePhoto."\"/>";
                		}
                		else
                		{
                			echo "<img style=\"width:100px\" src=\"Style/image/photo.png\" />";
                		}
                	echo "<div class='description'><h3>".$TabArticles[$i]->getTitre()."</h3><div class='date'>".$TabArticles[$i]->getFormatedDate()."</div><p>".$TabArticles[$i]->getApercu()."</p></div><a href='".$TabArticles[$i]->getUrl()."'>Lire la suite ...</a><div class='clear'></div></div>";

					}
				}
				/*
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
                }*/
                //Si il n'y a pas d'article dans la catégorie
            ?>
            
            <?php
            	try
            	{
            		$nbArticles = getNbArticlesByCategorie($categorieCourante->getId());
            		echo(generatePagination($nbArticles, $_GET['cat']));
            	}
            	catch(RequestException $e)
            	{
            		echo( $e->getMessage() );
            	}
            ?>

			<?php
				//generateCalendrier();
			?>
            <div id="footerCorps">
            </div>
        </div>
        <?php
                include_once('footer.php');
            ?>
    </body>
</html>