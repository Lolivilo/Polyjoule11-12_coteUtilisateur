<?php
	session_start();
	require_once('../BD/CategorieBD.php');
    $categorieCourante = NULL;
    if(isset($_GET['cat']) && $_GET['cat'] != '')
    {
        $categorieCourante = (new CategorieBD())->getCategorieWithId($_GET['cat']);
    }
    if($categorieCourante == NULL)
    {
        header('Location: index.php');
    }
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="Style/article.css" type="text/css">
        <title>
        <?php
            if( $_SESSION['langue'] == 'EN' )
            {
                echo( $categorieCourante->getTitreEN() );
            }
            else
            {
                echo( $categorieCourante->getTitreFR() );
            }
        ?>
        </title>
    </head>
    <body>
        <div id='page'>
        <?php 
            include_once('header.php');
            $articleBD = new articleBD();
            $listeArticles = $articleBD->getArticlesWithCategory
            foreach($listeArticles as $CurrentArticle)
            {
            ?>
            <div class='art'>
                <h2><?php echo  $CurrentArticle->getTitre()?></h2>
                if( $_SESSION['langue'] == 'EN' )
                        {
                            echo( $articleCourant->getContenuEN() );
                        }
                        else
                        {
                            echo( $articleCourant->getContenuFR() );
                        }
                    ?>
                    </div>
                </div>
            </div>
            <?php
                include_once('footer.php');
            ?>
        </div>
    </body>
</html>