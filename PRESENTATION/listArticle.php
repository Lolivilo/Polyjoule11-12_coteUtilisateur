<?php
	session_start();
	require_once('../BD/ArticleBD.php');
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="Style/article.css" type="text/css">
<title>
<?php
    $articleCourant = getArticleById($_GET['article']);
    if( $_SESSION['langue'] == 'FR' )
    {
        echo( $articleCourant->getTitreFR() );
    }
    elseif( $_SESSION['langue'] == 'EN' )
    {
        echo( $articleCourant->getTitreEN() );
    }
    else
    {
        // TRAITEMENT D'ERREUR A EFFECTUER !!!!!???!!
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
    if( $_SESSION['langue'] == 'FR' )
    {
        echo( $articleCourant->getContenuFR() );
    }
    elseif( $_SESSION['langue'] == 'EN' )
    {
        echo( $articleCourant->getContenuEN() );
    }
    else
    {
        // TRAITEMENT D'ERREUR A EFFECTUER !!!!!???!!
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