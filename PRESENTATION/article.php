<?php
	session_start();
	require_once('../BD/ArticleBD.php');
    $articleCourant = NULL;
    if(isset($_GET['article']) && $_GET['article'] != '')
    {
            echo "ok";
       $articleCourant = getArticleById($_GET['article']);
    }
    if($articleCourant == NULL)
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
                echo( $articleCourant->getTitreEN() );
            }
            else
            {
                echo( $articleCourant->getTitreFR() );
            }
        ?>

        </title>
        </head>

        <body>
            <div id='page'>
            <?php 
                include_once('header.php');
            ?>
	
            <div id='global'>
                <div id='left'>
				<?php 
					include_once('EXPLORER_CATEGORIES/explorer.php');
				?>
                </div>
                <div id='right'>
                    <ul id='fil'>
                        <li>fil d'ariane</li>
                    </ul>
                    <div id='content'>
                        <?php 
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