<?php
	session_start();
	require_once('../BD/ArticleBD.php');
    $articleCourant = NULL;
    if(isset($_GET['article']) && $_GET['article'] != '')
    {
       $articleCourant = getArticleById($_GET['article']);
    }
    if($articleCourant == NULL)
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
        <?php // AFFICHAGE DE L'ARTICLE ?>
        <div id="corps">
                <h2>
                    <?php 
                        echo $articleCourant->getTitre(); 
                    ?>
                </h2> <!-- Titre page -->
                <div class="articleHeader"> <!-- header d'article  -->
                    <img src="image/photo.png" />
                    <div class="presentation italic">
                        <h3>????</h3>
                        <div>????</div>
                    </div>
                    <div class="description">????<br/>????</div>
                    <div class="clear"></div>
                </div>
                <h3>????</h3> <!-- Sous titre page -->
                <div class="article">
                    <img src="Style/image/photo.png" />
                    <?php
                       echo $articleCourant->getContenu();
                    ?>
                </div> <!-- Article -->
            <div id="footerCorps"></div>
        </div>
<?php
    include_once('footer.php');
    ?>
</body>
</html>