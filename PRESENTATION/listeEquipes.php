<?php
	session_start();
	
	require_once("../BD/EquipeBD.php");
	
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
    		foreach($equipes as $e)
    		{
    			echo("BORDEL IL ME FAUT LES ANNEES : ".$e->getAnnee().print_r($e));
    			echo("<div class='description'><h3>Equipe de l'année ".$e->getAnnee()."</h3></div>");
    			echo("<a class='lienImportant' href='trombinoscope.php?equipe=".$e->getId()."'>Découvrez leur trombinoscope !</a>");
    			echo("<div class='clear'></div>");
    			
    		}
    		echo("</div>");
    	}
    ?>

    <div id="footerCorps"></div>
</div>
        <?php
                include_once('footer.php');
            ?>
    </body>
</html>