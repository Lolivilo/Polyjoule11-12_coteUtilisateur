<?php 
	require_once('../BD/CategorieBD.php');
	require_once('../BD/AlbumPhotoBD.php');
	require_once('MENU/Menu.php');
	include_once('LANGUE/sessionLangue.php');
?>

<div id='header'>	
	<div id='topheader'>
		<a class="text" href=''>Nous contacter</a>
		<a class="text" href=''>EN</a> | 
		<a class="text" href=''>FR</a>
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
	<a href='livreDOr.php'>Livre d'Or</a>
	<?php echo("<a href='albumPhoto.php?idAlbum=".getMostRecentAlbum()."'>Album Photo</a>") ?>
</div>