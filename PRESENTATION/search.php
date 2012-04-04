<?php
	session_start();
	
	require_once('../BD/ArticleBD.php');
	
	$StringRecherche = NULL;
    if(isset($_GET['w']) && $_GET['w'] != '')
    {
        $StringRecherche = $_GET['w'];
    }
    if($StringRecherche == NULL)
    {
        header('Location: index.php?erreur=NO_TERM_SEARCH');
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
		<div id="ariane">
			<a href="index.html">Notre Association</a> > <a href="index.html">Notre aaa</a> > <a href="index.html">Nzevgzg</a>
		</div>
		<?php
    		include('explorer/explorer.php');
    	?>

        <div id="corps">
            <?php
            $ArticleBD = new ArticleBD();
            $resultats = array();
            $resultats = $ArticleBD->getArticlesWithSearchTerms($StringRecherche,NULL,NULL);
			foreach($resultats as $art)
            {
            	echo "<div class='listeArticle'><img src='Style/image/photo.png' /><div class='description'><h3>".$art->getTitre()."</h3><div class='italic'>".$art->getDate()."</div><p>".$art->getContenu()."</p></div><a href='".$art->getUrl()."'>Lire la suite ...</a><div class='clear'></div></div>";
            }
            //Si il n'y a pas d'article dans la catégorie
            if(empty($resultats))
            {
            	echo "<p>Il n'y a aucun resultat</p>";
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