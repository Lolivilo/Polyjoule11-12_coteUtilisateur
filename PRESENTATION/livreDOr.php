<?php
	session_start();
	require_once('../BD/LivreDOrBD.php');
    require_once('../BD/LangueParser.php');
	$tabComment = getAllAcceptedLivreDOr();	// Creation de la liste des commentaires a afficher
    $parserLangue = new LangueParser();
    ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="Style/index.css" type="text/css">
    <script language="javascript" src="JavaScript/checkLivreOr.js"></script>
    <title>
        <?php
            echo( $parserLangue->getWord('LivreOr')->getTraduction() );
        ?>
    </title>
</head>

<body>
    <?php 
        include_once('header.php');
    ?>
    <div id='global'>
        <div id='left'>
            <?php
                include_once('explorer/explorer.php');
            ?>
        </div>
        <div id='right'>
            <div id='corps'>
            	<h2 id='titreArticle'><img src="Style/image/livreOr.jpg" alt="Image du livre d'or"/></h2>
                <h3>
                	<?php
                    	echo( $parserLangue->getWord('LivreOr')->getTraduction() );
                    ?>
                </h3>
                
                <?php
                    // Affichage des commentaires
                    for($i = 0 ; $i <= (getNbOnPageLivreOr($_GET['numPage'])-1) ; $i++)
                    {
                        echo("<div class='commentaire' id='signature_".$tabComment[$i]->getId()."'>");
                        echo("<h4>".$tabComment[$i+(10*($_GET['numPage']-1))]->getPosteur()."<span class='date'>".$tabComment[$i+(10*($_GET['numPage']-1))]->getFormatedDate()."</span></h4>");
                        echo("<p>".$tabComment[$i+(10*($_GET['numPage']-1))]->getMessage()."</p>");
                        echo("</div>");
                    }
                ?>
               
               	<ul id='paginationLivre'>
               		<li><a href='livreDOr.php?numPage=1'><<</a></li>
               		<?php
               			echo("<li><a href='livreDOr.php?numPage=".getPreviousNumPageLivreOr($_GET['numPage'])."'><</a></li>");
               			echo("<li>".$_GET['numPage']."</li>");
               			echo("<li><a href='livreDOr.php?numPage=".getNextNumPageLivreOr($_GET['numPage'])."'>></a></li>");
               			echo("<li><a href='livreDOr.php?numPage=".getLastNumPageLivreOr()."'>>></a></li>");
               		?>
               	</ul>
               	
               
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
                <form name='signer' id='ajoutSignature' action='../BD/AjoutSignature.php' method="post" onsubmit="return check()">
                 	<label for='pseudo'>Pseudo</label><input type="text" name='pseudo'/><br/>
                   	<label for='mail'>Mail</label><input type="text" name='mail'/><br/>
                    <textarea name='message'></textarea>
                    <input type="submit" id='signer' value='Signez'/>
                </form>
                <div id='footerCorps'></div>
            </div>
        </div>
    </div>
    <?php
        include_once('footer.php');
    ?>
</body>
</html>