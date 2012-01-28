<?php
	session_start();
	require_once('../BD/LivreDOrBD.php');
	$tabComment = getAllLivreDOr();	// Creation de la liste des commentaires a afficher
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="Style/livreDOr.css" type="text/css">
<title>
	<?php
		if( $_SESSION['langue'] == 'FR' )
		{
			echo( "Livre d'or" );
		}
		elseif( $_SESSION['langue'] == 'EN' )
		{
			echo( "Guest book" );
		}
		else
		{
			// TRAITEMENT D'ERREUR A EFFECTUER !!!!!???!!
		}
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
								// Affichage du titre de la page
								if( $_SESSION['langue'] == 'FR' )
								{
									echo( "Livre d'or" );
								}
								elseif( $_SESSION['langue'] == 'EN' )
								{
									echo( "Guest book" );
								}
								else
								{
									// TRAITEMENT D'ERREUR A EFFECTUER !!!!!???!!
								}
							?>
						</h1>
					</div>
					<div id='signatures'>
						<?php
						// Affichage des commentaires
						foreach($tabComment as $com)
						{
							echo("<table id='signature_".$com->getId()."' class='signature'>");
							echo("<tr>");
							echo("<td>".$com->getPosteur()."</td><td>".$com->getDate()."</td>");
							echo("</tr>");
							echo("<tr>");
							echo("<td colspan='2'>".$com->getMessage()."</td>");
							echo("</tr>");
							echo("</table>");
						}
						?>
					</div>
					<div id='ajoutSignature'>
						<form id='signer' action='../BD/AjoutSignature.php' method="post">
							<input type="text" name='pseudo' value='NOM'/><input type="text" name='mail' value='courriel'/>
							<br/>
							<input type="text" name='message'/>
							<br/>
							<input type="submit" id='signer' value='Signez' />
						</form>
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