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
				
				echo("</div>");
			}
		?>
	</div>
	<?php
		include('footer.php');
	?>
</html>


