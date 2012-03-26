<?php
	session_start();
	require_once('../BD/MembreBD.php');
	
	$tab = getMembreByEquipe($_GET['equipe']);
?>

	
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml">  
<head>  
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
    <title>Polyjoule - Trombinoscope</title>  
    <link rel="stylesheet" type="text/css" href="Style/index.css" />
    <script type="text/javascript" src="JavaScript/jquery.js"></script>
    <script type="text/javascript" src="JavaScript/menu.js"></script>
    <script type="text/javascript" src="JavaScript/dropDown.js"></script>
</head>


<body>
</body>
	<?php
		include('header.php');
		include('explorer/explorer.php');
	?>
	<div id='corps'>
		<?php
			foreach($tab as $m)
			{
				echo("<div id='membre_".$m->getId()."'>");
				echo("<div id='left'>");
				echo("<img src='".$m->getPhoto()."' alt='Photo de ".$m->getPrenom()."'/>");
				echo("<h5>".$m->getPrenom()." ".strtoupper($m->getNom())."</h5>");
				echo("<p>Département</p>");
				echo("<p>Promo</p>");
				echo("<p>Statut</p>");
				echo("<p>Adresse</p>");
				echo("</div>");
				echo("<div id='right'>");
				echo($m->getDepartement());
				echo($m->getPromotion());
				echo($m->getStatut());
				echo($m->getMail());
				echo("</div>");
				echo("</div>");
			}
		?>
	</div>
	<?php
		include('footer.php');
	?>
</html>


