<?php 
	include_once '../BD/PartenaireBD.php';
?>

<div id='footer'>
	<div id='partenaires'>
		<?php 
			$tabPartenaires = getAllPartners();		// Tableau d'objets Partenaire
			foreach($tabPartenaires as $part)
			{
<<<<<<< HEAD
				// Affichage de suite de liens en images, ˆ modifier
=======
>>>>>>> de6b33b4e1382fe107a36ec0dd2c7b1df7bc0226
				echo('<a href='.$part->site.'><img src='.$part->logo.' alt='.$part->nom.'></a>');
			}
		?>
	</div>
	<span id='signature'>Polyjoule 2012 - All rights reserved</span>
</div>