<?php 
	include_once 'LANGUE/sessionLangue.php';
	include_once '../BD/CategorieBD.php';
	include_once 'MENU/Menu.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
	<head>
  		<title>Polyjoule</title>
  		<link rel="stylesheet" href="style.css">
	</head>

	<body>
		<div id='page'>
			<div id='header'>
				<div id='topheder'>
					<a class="text" href=''>Nous contacter</a>
					<a class="text" href=''>EN</a>
					<form action="" method="post" id='formsearch'>
						<span id='rechercher'>Rechercher</span>
						<input type="text" name="search" id='boxtextsearch'/>
						<input type="submit" value="ok" id='validsearch'/>
					</form>
					<a href=''>FB</a>
				</div>
				<div id='logo'></div>
				<ul id='menu'>
					<?php 
						$categoryBD = new CategorieBD('localhost', 'polyjoule', 'polyjoule', 'azerty');
						echo getMenu($categoryBD,'limenu','child');
						echo $_SESSION['langue'];
					?>
				</ul>
			</div>
			<div id='middle'>
				<div id='slider'>
				</div>
			</div>
			<div id='footer'>
				<div id='blockcontener'>
					<div class='block'>
						<img class='imgblocks' src='images/block_polytech.jpg'/>
						<img class='ombreblock' src='images/ombre_block.jpg'/>
					</div>
					<div class='block'>
						<img class='imgblocks' src='images/block_cahute.jpg'/>
						<img class='ombreblock' src='images/ombre_block.jpg'/>
					</div>
					<div class='block'>					
						<img class='imgblocks' src='images/block_mondeH2.jpg'/>
						<img class='ombreblock' src='images/ombre_block.jpg'/>
					</div>
				</div>
			</div>
			<div id='footerend'>
				<div id='partenaire'>
					<img class='imgpartenaire' src='images/partenaire1.jpg'/>
					<img class='imgpartenaire' src='images/partenaire2.jpg'/>
					<img class='imgpartenaire' src='images/partenaire3.jpg'/>
				</div>
				<span id='right'>polyjoule 2011 - All rights reserved</span>
			</div>
		</div>
	

	</body>
</html>