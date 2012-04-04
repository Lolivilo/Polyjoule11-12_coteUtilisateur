<?php
	session_start();
	
	if(isset($_GET['action']) && $_GET['action'] == 'send' && isset($_POST['email']) && $_POST['email'] != '' && isset($_POST['objet']) && $_POST['objet'] != '' &&  isset($_POST['message']) && $_POST['message'] != '') // le formulaire a été envoyé
    {
    	//appel à la fonction php d'envoi de mail
    	require_once('../BD/send_mail.php');
    	$Mail = new EMail($_POST['email'], $_POST['objet'], $_POST['message']);
    	if($Mail->sendMail())
    		header('Location: http://localhost:8888/contact-us.php?action=succeded'); // redirection pour afficher le succes
    }
    else if( (isset($_POST['email']) && $_POST['email'] == '') || (isset($_POST['email']) && $_POST['objet'] == '') || ( isset($_POST['email']) &&$_POST['message'] == '') )
    {
    	header('Location: http://localhost:8888/contact-us.php?action=error'); // redirection pour afficher une erreur (champ non remplit)
    }
    else // ici on affiche le formulaire d'envoi de mail
    {
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
    ?>
        <div id="ariane">
            <a href="index.html"><?php echo $parserLangue->getWord("contact")->getTraduction(); ?></a>
        </div>
        <?php
            include('explorer/explorer.php');
        ?>
        <?php // AFFICHAGE DE L'ARTICLE ?>
        <div id="corps">
                <h2>
                    <?php 
                        echo $parserLangue->getWord("contact")->getTraduction(); 
                    ?>
                </h2> 
                <div class="article contact">
                <?php
                	if($_GET['action'] == 'succeded')
                	{
                ?>
                	<p>Votre message à été envoyé avec succès</p>
                <?php
                	}
                	else
                	{	
                		if($_GET['action'] == 'error')
                		{
                ?>
                		<p class='error'>Les informations fournies sont incomplètes</p>
                <?php
                		}
                ?>
                	<form method="POST" action="http://localhost:8888/contact-us.php?action=send">
                		<span>Votre Email *</span><input type="text" name="email" /><br/>
                		<span>Objet *</span><input type="text" name="objet" /><br/>
                		<span>Message *</span><textarea name="message"></textarea><br/>
                		<input type="submit" value="Envoyer" />
                	</form>
                <?php
                	}
                ?>
                </div> 
            <div id="footerCorps"></div>
        </div>
<?php
    include_once('footer.php');
    ?>
</body>
</html>
<?php 
}
?>