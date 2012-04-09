<?php
	session_start();
	
	require_once('../BD/acces_albumPhoto.php');
	require_once('../BD/CategorieBD.php');
	require_once('../METIER/FonctionsMetier/verificationGet.php');
	
	verifGet();
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
		<?php
			$tabAlbums = getAllAlbums();	// Tableau de tous les albums photos existants
			if(empty($tabAlbums))
			{
				echo("<p>Il n'y a aucun album photo actuellement !</p>");
			}
			else
			{
				$debut = getIndexDebutFor($_GET['numPage'], 5);
				$fin = getIndexFinFor($debut, getNbAlbums(), 5);
				for($i = $debut ; $i < $fin ; $i++)
				{
					echo("<div id='album_".$tabAlbums[$i]->getId()."' class='listeArticle'>");
					if($tabAlbums[$i]->getFirstPhoto() != NULL)
					{
						echo("<img style='width:100px' src='".$tabAlbums[$i]->getFirstPhoto()."' />");
					}
					else
					{
						echo("<img style='width:100px' src='http://3.bp.blogspot.com/-iJYUeULd-W0/TbR5YTwfiRI/AAAAAAAAAJ0/zIDyFheQVyY/s1600/n.a.jpg' />");
					}
					echo("<div class='description'><h3>".$tabAlbums[$i]->getNom()."</h3>");
					echo("<div class='italic'>".$tabAlbums[$i]->getDate()."</div>" );
					echo("<p>".$tabAlbums[$i]->getDesc()."</p>");
					echo("<p>".$tabAlbums[$i]->getNbPhotos()." photos dans cet album</p>");
					echo("</div>");
					echo("<a href='".$tabAlbums[$i]->getUrl()."'>Visionner cet album</a>");
					echo("<div class='clear'></div>");
					echo("</div>");

				}
			}
		?>
		
		<?php
			echo(generatePagination(getNbAlbums(), $_GET['cat']));
		?>
	</div>
	
	
	<?php
		include_once('footer.php');
	?>
</html>