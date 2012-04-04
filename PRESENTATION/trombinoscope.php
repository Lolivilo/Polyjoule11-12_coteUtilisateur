<?php
	session_start();
	require_once('../BD/ParticipantBD.php');
	require_once('../BD/EquipeBD.php');
	
	
	$tab = createTrombinoscopeByEquipe($_GET['equipe']);	// Tableau de membre de l'équipe courante
	$equipe = getEquipeById($_GET['equipe']);	// Equipe courante
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
		<h2><?php echo($parserLangue->getWord("trombinoscope")->getTraduction()); ?> / <?php echo($parserLangue->getWord("team")->getTraduction()); ?> <?php echo($equipe->getAnnee());?></h2>
		<?php
			foreach($tab as $m)
			{
				echo("<div class='personne' id='membre_".$m->getId()."'>");
				echo("<h3>".$m->getPrenom()." ".strtoupper($m->getNom())."</h3>");
				echo("<img src='".$m->getPhoto()."' alt='Photo de ".$m->getPrenom()."'/>");
				echo("<table>");
				echo("<tr>");
				echo("<th>".$parserLangue->getWord("department")->getTraduction()."</th><td><a href='".$m->getLienFormation()."'>".$m->getFormation()."</a></td>");
				echo("</tr>");
				echo("<th>Promotion</th><td>".$m->getAnnee()."</td>");
				echo("</tr>");
				echo("<tr>");
				echo("<th>".$parserLangue->getWord("status")->getTraduction()."</th><td>".$m->getRole()."</td>");
				echo("</tr>");
				echo("<tr>");
				echo("<th>".$parserLangue->getWord("mail")->getTraduction()."</th><td>".$m->getMail()."</td>");
				echo("</tr>");
				echo("</table>");
				echo("</div>");
				
			}
		?>
		<div id="footerCorps"></div>
	</div>
	
	<?php
		include('footer.php');
	?>
</html>


