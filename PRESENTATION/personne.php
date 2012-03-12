<?php
    session_start();
    require_once('../BD/ParticipantBD.php');
    $tabParticipants = getAllParticipants();
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
                echo("Personnages clés");   // A modifier par le parser
                //echo( $parserLangue->getWord("personnages")->getTraduction() );
            ?>
        </h2>
        <?php
            for($i = 0 ; $i < getNbParticipants() ; $i++)
            {
                echo("<div>");
                echo("<div class='articleHeader' id='participant_".$tabParticipants[$i]->getId()."'>");
                echo("<img src='".$tabParticipants[$i]->getPhoto()."' alt='Photo de ".$tabParticipants[$i]->getNom()."'/>");
                echo("<div class='presentation italic'>");
                echo("<h3>".$tabParticipants[$i]->getPrenom()." ".$tabParticipants[$i]->getNom()."</h3>");
                echo("<div>".$tabParticipants[$i]->getRole()."</div>");
                echo("</div>");
                echo("<div class='description'>Manque dans la base !<br/></div>");
                echo("<div class='clear'></div>");
                echo("</div>");
                echo("<h4>Qui est-il ?</h4>");
                echo($tabParticipants[$i]->getBioFr());
                echo("</div>");
                /*
                echo("<table id='".$tabParticipants[$i]->getId()."'>");
                echo("<tr><td><td>".$tabParticipants[$i]->getNom()." ".$tabParticipants[$i]->getPrenom()."</td><td></td></tr>");
                echo("<tr><td></td><td></td><td>A ajouter dans la base</td></tr>");
                echo("<tr><td></td><td>".$tabParticipants[$i]->getRole()."</td></td></tr>");
                echo("</table>");
                echo("<h5>Qui est-il ?</h5>");
                echo($tabParticipants[$i]->getBioFr());
                echo("</div>");
                 */
            }
        ?>
    </div>
    <?php
        include('footer.php');
    ?>
</body>
    
</html>