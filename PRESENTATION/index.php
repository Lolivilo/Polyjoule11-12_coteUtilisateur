<?php 
	include_once 'LANGUE/sessionLangue.php';
	include_once '../BD/CategorieBD.php';
	include_once 'MENU/Menu.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>

	
	<head>
  		<title>Polyjoule</title>
  		<link rel="stylesheet" href="index.css">
	</head>

	<body>

		<?php 
			$cat = new CategorieBD();
			echo($cat->getSuperParentCategoryOfCategory(5));	// Doit renvoyer 1
			
			echo($cat->getSuperParentCategoryOfArticle(1));	// Doit renvoyer 1
		?>

		<div id='page'>
			<?php 
				include 'HEADER/header.php';
			?>
			<div id='middle'>
				<div id='slider'>
				</div>
			</div>
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
				include 'FOOTER/footer.php';
			?>
			<!-- <div id='footerend'>
				<div id='partenaire'>
					<img class='imgpartenaire' src='images/partenaire1.jpg'/>
					<img class='imgpartenaire' src='images/partenaire2.jpg'/>
					<img class='imgpartenaire' src='images/partenaire3.jpg'/>
				</div>
				<span id='right'>polyjoule 2011 - All rights reserved</span>
			</div> -->
		</div>
	

	</body>
</html>