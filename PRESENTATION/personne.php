<?php
    session_start();
    
    require_once('../BD/acces_participant.php');
    require_once("../BD/acces_rubrique.php");
    require_once('../METIER/FonctionsMetier/verificationGet.php');
    
    verifGet();
    
    $tabParticipants = getAllParticipantsProfs();
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
        include('explorer/explorer.php');
    ?>
    <div id='corps'>
        <h2>
            <?php
                echo( $parserLangue->getWord("personnages")->getTraduction() );
            ?>
        </h2>
        <?php
        	if( empty($tabParticipants) )
        	{
        		echo("<p>Aucune personnage clé n'a encore été ajouté !</p>");
        	}
        	else
        	{
        		$debut = getIndexDebutFor($_GET['numPage'], 5);
        		$fin = getIndexFinFor($debut, getNbParticipantsProfs(), 5);
        	
        		foreach($tabParticipants as $p)
        		{
        			echo("<div class='articleHeader' id='participant_".$p->getId()."'>");
    	            echo("<img src='".$p->getPhoto()."' alt='Photo de ".$p->getNom()."'/>");
        	        echo("<div class='description'>");
            	    echo("<h3>".$p->getPrenom()." ".$p->getNom()."</h3>");
	                echo("<div class='italic'>".$p->getRole()."</div>");
    	            echo("</div>");
        	        echo("<div class='presentation'>Manque dans la base !<br/></div>");
            	    echo("<div class='clear'></div>");
	                echo("</div>");
    	            echo("<h4>".$parserLangue->getWord("quiEstIl")->getTraduction()."</h4>");
        	        echo("<p>".$p->getBioFr()."</p>");
        		}
        		
        		/*
            	for($i = $debut ; $i < $fin ; $i++)
            	{
 	               echo("<div class='articleHeader' id='participant_".$tabParticipants[$i]->getId()."'>");
    	            echo("<img src='".$tabParticipants[$i]->getPhoto()."' alt='Photo de ".$tabParticipants[$i]->getNom()."'/>");
        	        echo("<div class='description'>");
            	    echo("<h3>".$tabParticipants[$i]->getPrenom()." ".$tabParticipants[$i]->getNom()."</h3>");
	                echo("<div class='italic'>".$tabParticipants[$i]->getRole()."</div>");
    	            echo("</div>");
        	        echo("<div class='presentation'>Manque dans la base !<br/></div>");
            	    echo("<div class='clear'></div>");
	                echo("</div>");
    	            echo("<h4>".$parserLangue->getWord("quiEstIl")->getTraduction()."</h4>");
        	        echo("<p>".$tabParticipants[$i]->getBioFr()."</p>");
            	}
            	*/
            }
        ?>
        <?php
        	echo(generatePagination(getNbParticipantsProfs(), $_GET['cat']));
        ?>
         <div id='footerCorps'></div>
    </div>
    <?php
        include('footer.php');
    ?>
</body>
    
</html>