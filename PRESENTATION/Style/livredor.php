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
            // Affichage des commentaires
            	if( empty($signatures) && $_GET['numPage'] == 1)
            	{
            		echo("<p>Il n'y a encore aucune signature d'acceptée sur le site !</p>");
            	}
            	else
            	{
            		$debut = getIndexDebutFor($_GET['numPage'], 5);
               		$fin = getIndexFinFor($debut, getNbAcceptedLivreOr(), 5);

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
       
            <div id='ajoutSignature'>
                <?php
                    if(isset($_GET['emptyInput']) && $_GET['emptyInput'] == 'true')
                    {
                        echo("<p>Tous les champs doivent être remplis !</p>");
                    }
                    if(isset($_GET['mailSyntax']) && $_GET['mailSyntax'] == 'false')
                    {
                        echo("<p>L'adresse mail doit être valide !</p>");
                    }
                    if(isset($_GET['signAttempt']) && $_GET['signAttempt'] == 'true')
                    {
                        echo("<p>Signature ajoutée avec succès ! En attente d'approbation.</p>");
                    }
                    if(isset($_GET['signAttempt']) && $_GET['signAttempt'] == 'false')
                    {
                        echo("<p>Echec de l'ajout (problème serveur) !</p>");
                    }
                ?>
			</div>
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