<?php 
	session_start();
	include_once 'MENU/Menu.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>

	
	<head>
  		<title>Polyjoule - Site Web</title>
  		<link rel="stylesheet" href="Style/index.css">
	</head>

	<body>
		<div id='page'>
			<?php 
				include_once('header.php');
			?>
			<div id='middle'>
				<div id='slider'>
					Ici, le slider
				</div>
			</div>
			<a href="article.php?article=1">TEST : accès article 1</a>
			<div id='directLinks'>
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
			<?php
				include_once('footer.php');
			?>
		</div>
	

	</body>
</html>