<?php
	session_start();
	
	
	
	// Redirection si erreur de GET
	if( (!(isset($_GET['partenaire']))) || (!(intval($_GET['partenaire']))) )
	{
		header("location: index.php");
	}
	
	require_once("../BD/PartenaireBD.php");
	
	try
	{
		$partenaire = getPartenaireById($_GET['partenaire']);	// Le partenaire courant
	}
	catch(RequestException $e)
	{
	}
	

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
        
    <?php
    	include('explorer/explorer.php');
    ?>
   	<div id="corps">
    	<h2 id='titrePartenaire'>
    		La il faudrait un lien vers une photo
            <div><?php echo($partenaire->getNom()); ?><span class='sousTitre'>SOUS TITRE</span></div>
            <img src=<?php echo("'".$partenaire->getLogo()."' alt='Logo de ".$partenaire->getNom()."'") ?>/>
        </h2>
        <h3><?php echo($parserLangue->getWord("company")->getTraduction()); ?></h3>
        <p><?php echo($partenaire->getDesc()); ?></p>
        <h3><?php echo($parserLangue->getWord("assistant")->getTraduction()); ?></h3>
        <p>Manque dans la base ?!</p>
        <p><a class="lienImportant" href='<?php echo($partenaire->getSite()); ?>'>Nous soutenir</a></p>
    
        <div id="footerCorps"></div>
	</div>
	<?php
    	include_once('footer.php');
    ?>
</body>

</html>