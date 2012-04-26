<?php
	session_start();
	
	require_once('../BD/acces_livreOr.php');
    require_once('../BD/acces_rubrique.php');
    require_once('../METIER/FonctionsMetier/verificationGet.php');
    
    verifGet();
    
	$signatures = getFiveAcceptedLivreDor(5*(intval($_GET['numPage'])-1));
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="Style/index.css" type="text/css">
    <script language="javascript" src="JavaScript/checkLivreOr.js"></script>
    <title>Polyjoule</title>
</head>

<body>
    <?php 
        include_once('header.php');
        include_once('explorer/explorer.php');
    ?>
    <div id='corps'>
    	<h2 id='titreArticle'><img src="Style/image/livreOr.jpg" alt="Image du livre d'or"/></h2>
        <h3><?php echo( $parserLangue->getWord('LivreOr')->getTraduction() );?></h3>
        	<?php
        		if(isset($_GET['signAttempt']))
        		{
        			echo("<div id='ajoutSignature'>");
        			if($_GET['signAttempt'] == 'i')
        			{
        				echo("<p>Au moins un des champs est incomplet ! Ajout annulé</p>");
        			}
        			else if($_GET['signAttempt'] == 'm')
        			{
        				echo("<p>L'adresse mail n'est pas valide ! Ajout annulé</p>");
        			}
        			else if($_GET['signAttempt'] == 'k')
        			{
        				echo("<p>Erreur lors de l'ajout (impossible d'accéder à la base de données)</p>");
        			}
        			else if($_GET['signAttempt'] == 'o')
        			{
        				echo("<p>Signature ajoutée avec succès ! En attente d'approbation</p>");
        			}
        			echo("</div>");
        		}
            // Affichage des commentaires
            	if( empty($signatures) && $_GET['numPage'] == 1)
            	{
            		echo("<p>Il n'y a encore aucune signature d'acceptée sur le site !</p>");
            	}
            	else
            	{
                	foreach($signatures as $a)
                	{
                		echo("<div class='commentaire' id='signature_".$a->getId()."'>");
                    	echo("<h4>".$a->getPosteur()."<span class='date'>".$a->getFormatedDate()."</span></h4>");
                    	echo("<p>".$a->getMessage()."</p>");
                    	echo("</div>");
                	}
                }
            ?>
              	
           	<?php
           		echo(generatePagination(getNbAcceptedLivreOr(), $_GET['cat']));
           	?>
       
            <form name='signer' id='ajoutSignature' action='../BD/TraitementsFormulaires/AjoutSignature.php' method="post">
            	<label for='pseudo'>Pseudo</label><input type="text" name='pseudo'/><br/>
                <label for='mail'>Mail</label><input type="text" name='mail'/><br/>
                <textarea name='message'></textarea>
                <input type="submit" id='signer' value='Signez'/>
            </form>
            <div id='footerCorps'></div>
        </div>
    </div>
    <?php
        include_once('footer.php');
    ?>
</body>
</html>