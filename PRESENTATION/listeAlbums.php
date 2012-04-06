<?php
	session_start();
	
	require_once('../BD/acces_albumPhoto.php');
	require_once('../BD/CategorieBD.php');
	
	if( (!(isset($_GET['cat']))) || (!(intval($_GET['cat']))) )		// Si GET n est pas valide
    {
    	header('location: erreur.php?code=0');
    }
    else if( !(categorieExists($_GET['cat'])) )
    {
    	header('location: erreur.php?code=1');
    }
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
				foreach($tabAlbums as $row)
				{
					echo("<div id='album_".$row->getId()."' class='listeArticle'>");
					if($row->getFirstPhoto() != NULL)
					{
						echo("<img style='width:100px' src='".$row->getFirstPhoto()."' />");
					}
					else
					{
						echo("<img style='width:100px' src='http://3.bp.blogspot.com/-iJYUeULd-W0/TbR5YTwfiRI/AAAAAAAAAJ0/zIDyFheQVyY/s1600/n.a.jpg' />");
					}
					echo("<div class='description'><h3>".$row->getNom()."</h3>");
					echo("<div class='italic'>".$row->getDate()."</div>" );
					echo("<p>".$row->getDesc()."</p>");
					echo("<p>".$row->getNbPhotos()." photos dans cet album</p>");
					echo("</div>");
					echo("<a href='".$row->getUrl()."'>Visionner cet album</a>");
					echo("<div class='clear'></div>");
					echo("</div>");
				}
			}
		?>
	</div>
	<div id='pagination'>
		<?php
			
		?>
	</div>
	<?php
		include_once('footer.php');
	?>
</html>