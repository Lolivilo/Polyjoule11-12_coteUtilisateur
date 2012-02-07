<?php
	session_start();
    require_once('../BD/LangueParser.php');
	require_once('../BD/AlbumPhotoBD.php');
    $album = NULL;
    if(isset($_GET['idAlbum']) && $_GET['idAlbum'] != '')
    {
        $album = getAlbumById($_GET['idAlbum']);
    }
    if($album == NULL)
    {
        header('Location: index.php');
    }
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="Style/albumPhoto.css" type="text/css">
<title>
	<?php
        $parserLangue = new LangueParser();
        echo $parserLangue->getWord('AlbPhoto')->getTraduction();
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
                            echo $parserLangue->getWord('AlbPhoto')->getTraduction();
						?>
                        </h1>
                        <h3>
                        <?php
                            echo( $album->getNom() );
                        ?>
					</div>
					<div id='deroulement'>
					</div>
					<div id='miniatures'>
					</div>
					<div id='description'>
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