<div id='header'>		
	<div id='topheader'>
		<a class="text" href=''>Nous contacter</a>
		<a class="text" href=''>EN</a>
		<form action="" method="post" id='formsearch'>
			<span id='rechercher'>Rechercher</span>
			<input type="text" name="search" id='boxtextsearch'/>
			<input type="submit" value="ok" id='validsearch'/>
		</form>
		<a href=''>FB</a>
	</div>
	<div id='logo'>
		Ici, le logo<br/>
		de Polyjoule
	</div>
	<ul id='menu'>
		<?php 
			$categoryBD = new CategorieBD('localhost', 'polyjoule', 'polyjoule', 'azerty');
			echo getMenu($categoryBD,'limenu','child');
			echo $_SESSION['langue'];
		?>
	</ul>
</div>
