<?php
	session_start();
	
	require_once("../BD/EquipeBD.php");
	require_once("../BD/CategorieBD.php");
	
	if( (!(isset($_GET['cat']))) || (!(intval($_GET['cat']))) )		// Si GET n est pas valide
    {
    	header('location: erreur.php?code=0');
    }
    else if( !(categorieExists($_GET['cat'])) )
    {
    	header('location: erreur.php?code=1');
    }
    
	$equipes = getAllEquipes();		// Tableau de toutes les equipes
	
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
    <?php
    	if(count($equipes) == 0)
    	{
    		echo("<p>Il n'y a aucune équipe référencée !</p>");
    	}
    	else
    	{
    		echo("<div class='listeArticle'>");
    		
    		$debut = getIndexDebutFor($_GET['numPage'], 5);
			$fin = getIndexFinFor($debut, getNbEquipes(), 5);
			for($i = $debut ; $i < $fin ; $i++)
			{
    			echo("<div class='description'><h3>Equipe de l'année ".$equipes[$i]->getAnnee()."</h3></div>");
    			echo("<a class='lienImportant' href='trombinoscope.php?equipe=".$equipes[$i]->getId()."'>Découvrez leur trombinoscope !</a>");
    			echo("<div class='clear'></div>");
			}
    		echo("</div>");
    	}
    ?>
    <?php
    	echo(generatePagination(getNbEquipes(), $_GET['cat']));
    ?>

    <div id="footerCorps"></div>
</div>
        <?php
                include_once('footer.php');
            ?>
    </body>
</html>