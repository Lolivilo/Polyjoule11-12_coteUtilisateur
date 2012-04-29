<?php 
	include_once '../BD/acces_partenaire.php';
?>

<div id='footer'>
	<div id='partenaires'>
		<?php 
			//$tabPartenaires = getAllPartners();		// Tableau d'objets Partenaire
			$tabPartenaires = getFooterPartners();
			foreach($tabPartenaires as $part)
			{
				echo("<a href='partenaire.php?partenaire=".$part->getId()."'><img src='".$part->getLogo()."' width='10%' alt='".$part->getNom()."'></a>");
			}
		?>
	</div>
	<span id='signature'>Polyjoule 2012 - All rights reserved</span><br/>
	<span id='developpeurs'><a href='trombidev.php'>Développeurs 2012</a></span>
</div>