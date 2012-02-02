<?php 
	require_once('../BD/CategorieBD.php');
	require_once('../BD/AlbumPhotoBD.php');
	require_once('MENU/Menu.php');
    require_once('../BD/LangueParser.php');
	include_once('LANGUE/sessionLangue.php');
?>

<div id='header'>	
	<div id='topheader'>
		<a class="text" href=''>Nous contacter</a>
		<a class="text" href='http://localhost:8888/PRESENTATION/index.php?lang=EN'>EN</a> | 
		<a class="text" href='http://localhost:8888/PRESENTATION/index.php?lang=FR'>FR</a>
		<form action="" method="post" id='formsearch'>
			<span id='rechercher'>Rechercher</span>
			<input type="text" name="search" id='boxtextsearch'/>
			<input type="submit" value="ok" id='validsearch'/>
		</form>
		<a href=''>FB</a>
	</div>
	<div id='logo'>
		<a href="index.php">Ici, le logo<br/>de Polyjoule</a>
	</div>
	<ul id='menu'>
		<?php 
			$categoryBD = new CategorieBD('localhost', 'polyjoule', 'polyjoule', 'azerty');
			echo getMenu($categoryBD,'limenu','child');
		?>
	</ul>
	<a href='livreDOr.php'>
        <?php
            $parserLangue = new LangueParser();
            //print_r($parserlangue);
            echo $parserLangue->getWord("LivreOr")->getTraduction();
            //print_r($parserLangue->getWord("LivreOr"));
        ?>
    </a>

	<?php echo("<a href='albumPhoto.php?idAlbum=".getMostRecentAlbum()."'>Album Photo</a>") ?>
</div>