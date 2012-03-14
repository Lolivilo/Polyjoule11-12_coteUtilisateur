<?php 
	include_once '../BD/PartenaireBD.php';
?>

<div id='footer'>
	<div id='partenaires'>
		<?php 
			$tabPartenaires = getAllPartners();		// Tableau d'objets Partenaire
			foreach($tabPartenaires as $part)
			{
				echo("<a href='article.php?article=".$part->getIdArticle()."'><img src='".$part->logo."' alt='".$part->nom."'></a>");
			}
		?>
	</div>
	<span id='signature'>Polyjoule 2012 - All rights reserved</span>
</div>