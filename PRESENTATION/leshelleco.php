<?php
	session_start();

	require_once('../BD/acces_rubrique.php');
	require_once('../METIER/FonctionsMetier/verificationGet.php');
	
	//verifGet();
	
	$currentCat = getCategorieById($_GET['cat']);	// Categorie actuelle => le shell eco 2012
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml">  
<head>  
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
    <title>Polyjoule</title>  
    <link rel="stylesheet" type="text/css" href="Style/index.css" />
    <script type="text/javascript" src="JavaScript/jquery.js"></script>
    <script type="text/javascript" src="JavaScript/menu.js"></script>
    <script type="text/javascript" src="JavaScript/dropDown.js"></script>
</head>

<body>

</body>
	<?php
		include_once('header.php');
		include_once('explorer/explorer.php');
	?>
	<div id='corps'>
		<h2 id='titreArticle'><img src="Style/image/banniere_shellEco.png" alt="Image du Schell Eco"/></h2>
		<h3><?php echo( $currentCat->getTitre() );?></h3>
		<p>
			<?php
				echo($currentCat->getDesc());
			?>
		</p>
	
	</div>
	
	
	<?php
		include_once('footer.php');
	?>
</html>