<?php
	session_start();
	require_once('../BD/LivreDOrBD.php');
    require_once('../BD/LangueParser.php');
	$tabComment = getAllAcceptedLivreDOr();	// Creation de la liste des commentaires a afficher
    $parserLangue = new LangueParser();
    ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>



<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="Style/livreDOr.css" type="text/css">
<script language="javascript" src="JavaScript/checkLivreOr.js"></script>
<title>
<?php
    echo( $parserLangue->getWord('LivreOr')->getTraduction() );
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
                <div id='titre'>
                    <h1>
                        <?php
                            echo( $parserLangue->getWord('LivreOr')->getTraduction() );
                        ?>
                    </h1>
                </div>
                <div id='signatures'>
                    <?php
                        // Affichage des commentaires
                        /*foreach($tabComment as $com)
                        {
                            echo("<table id='signature_".$com->getId()."' class='signature'>");
                            echo("<tr>");
                            echo("<td>".$com->getPosteur()."</td><td>".$com->getDate()."</td>");
                            echo("</tr>");
                            echo("<tr>");
                            echo("<td colspan='2'>".$com->getMessage()."</td>");
                            echo("</tr>");
                            echo("</table>");
                        }*/
                        
                        for($i = 0 ; $i <= (getNbOnPageLivreOr($_GET['numPage'])-1) ; $i++)
                        {
                            echo("<table id='signature_".$tabComment[$i+(10*($_GET['numPage']-1))]->getId()."' class='signature'>");
                            echo("<tr>");
                            echo("<td>".$tabComment[$i+(10*($_GET['numPage']-1))]->getPosteur()."</td><td>".$tabComment[$i+(10*($_GET['numPage']-1))]->getDate()."</td>");
                            echo("</tr>");
                            echo("<tr>");
                            echo("<td colspan='2'>".$tabComment[$i+(10*($_GET['numPage']-1))]->getMessage()."</td>");
                            echo("</tr>");
                            echo("</table>");
                        }
                    ?>
                </div>
                <div id='otherPage'>
                    <a href='livreDOr.php?numPage=1'><<</a>
                    <?php echo("<a href='livreDOr.php?numPage=".getPreviousNumPageLivreOr($_GET['numPage'])."'><</a>"); ?>
                    <?php echo( $_GET['numPage'] ); ?>
                    <?php echo("<a href='livreDOr.php?numPage=".getNextNumPageLivreOr($_GET['numPage'])."'>></a>"); ?>
                    <?php echo("<a href='livreDOr.php?numPage=".getLastNumPageLivreOr()."'>>></a>"); ?>
                </div>
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

                    <form name='signer' action='../BD/AjoutSignature.php' method="post" onsubmit="return check()">
                        Pseudo<input type="text" name='pseudo'/>Mail<input type="text" name='mail'/>
                        Message<textarea name='message'></textarea>
                        <input type="submit" id='signer' value='Signez'/>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
        include_once('footer.php');
    ?>
</div>

</body>
</html>