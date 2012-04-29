<?php
	session_start();

	if($_SERVER['QUERY_STRING'] != NULL)		// Si des variables sont passees en parametre GET
	{
		header("location: erreur.php?code=0");
	}
?>

	
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml">  
<head>  
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
    <title>Polyjoule</title>  
    <link rel="stylesheet" type="text/css" href="Style/index.css" />
    <script type="text/javascript" src="JavaScript/jquery.js"></script>
    <script type="text/javascript" src="JavaScript/menu.js"></script>
    <script type="text/javascript" src="JavaScript/dropDown.js"></script>
</head>


<body>
</body>
	<?php
		include('header.php');
	?>
	<div id='corps' class='sansMenu'>
		<h2><?php echo($parserLangue->getWord("trombiDev")->getTraduction()); ?></h2>
			<div class='personne'>
				<h3>Olivier MANDIN</h3>
				<?php
					$srcPhoto = NULL;
					if($srcPhoto == NULL)
					{
						echo("<img src='Style/image/photo.png' />");
					}
					else
					{
						echo("<img src='$srcPhoto' alt='Ma tete' />");
					}
				?>
				<table>
					<tr>
						<th><?php echo($parserLangue->getWord("status")->getTraduction()); ?></th>
						<td>Responsable de l'équipe Web / Développeur frontOffice (PHP ++)</td>
					</tr>
					<tr>
						<th><?php echo($parserLangue->getWord("mail")->getTraduction()); ?></th>
						<td>olivier.mandin@etu.univ-nantes.fr</td>
					</tr>
				</table>
			</div>
			
			<div class='personne'>
				<h3>Antonin BIRET</h3>
				<?php
					$srcPhoto = NULL;
					if($srcPhoto == NULL)
					{
						echo("<img src='Style/image/photo.png' />");
					}
					else
					{
						echo("<img src='$srcPhoto' alt='Ma tete' />");
					}
				?>
				<table>
					<tr>
						<th><?php echo($parserLangue->getWord("status")->getTraduction()); ?></th>
						<td>Développeur frontOffice (PHP / Ajax / JQuery)</td>
					</tr>
					<tr>
						<th><?php echo($parserLangue->getWord("mail")->getTraduction()); ?></th>
						<td>antonin.biret@etu.univ-nantes.fr</td>
					</tr>
				</table>
			</div>
			<div class='personne'>
				<h3>Josselin ROUSSEAU</h3>
				<?php
					$srcPhoto = NULL;
					if($srcPhoto == NULL)
					{
						echo("<img src='Style/image/photo.png' />");
					}
					else
					{
						echo("<img src='$srcPhoto' alt='Ma tete' />");
					}
				?>
				<table>
					<tr>
						<th><?php echo($parserLangue->getWord("status")->getTraduction()); ?></th>
						<td>Développeur de la grande majorité du design du frontOffice (CSS)</td>
					</tr>
					<tr>
						<th><?php echo($parserLangue->getWord("mail")->getTraduction()); ?></th>
						<td>josselin.rousseau@etu.univ-nantes.fr</td>
					</tr>
				</table>
			</div>
			
			<div class='personne'>
				<h3>Olivier BLIN</h3>
				<?php
					$srcPhoto = NULL;
					if($srcPhoto == NULL)
					{
						echo("<img src='Style/image/photo.png' />");
					}
					else
					{
						echo("<img src='$srcPhoto' alt='Ma tete' />");
					}
				?>
				<table>
					<tr>
						<th><?php echo($parserLangue->getWord("status")->getTraduction()); ?></th>
						<td>Développeur de la partie administration (PHP)</td>
					</tr>
					<tr>
						<th><?php echo($parserLangue->getWord("mail")->getTraduction()); ?></th>
						<td>olivier.blin@etu.univ-nantes.fr</td>
					</tr>
				</table>
			</div>
			
			<div class='personne'>
				<h3>Alexandre BISIAUX</h3>
				<?php
					$srcPhoto = NULL;
					if($srcPhoto == NULL)
					{
						echo("<img src='Style/image/photo.png' />");
					}
					else
					{
						echo("<img src='$srcPhoto' alt='Ma tete' />");
					}
				?>
				<table>
					<tr>
						<th><?php echo($parserLangue->getWord("status")->getTraduction()); ?></th>
						<td>Développeur de la partie administration (PHP) + design (CSS)</td>
					</tr>
					<tr>
						<th><?php echo($parserLangue->getWord("mail")->getTraduction()); ?></th>
						<td>alexandre.bisiaux@etu.univ-nantes.fr</td>
					</tr>
				</table>
			</div>
			
			<div class='personne'>
				<h3>Simon ROUSSEAU</h3>
				<?php
					$srcPhoto = NULL;
					if($srcPhoto == NULL)
					{
						echo("<img src='Style/image/photo.png' />");
					}
					else
					{
						echo("<img src='$srcPhoto' alt='Ma tete' />");
					}
				?>
				<table>
					<tr>
						<th><?php echo($parserLangue->getWord("status")->getTraduction()); ?></th>
						<td>Développeur de la partie administration (PHP)</td>
					</tr>
					<tr>
						<th><?php echo($parserLangue->getWord("mail")->getTraduction()); ?></th>
						<td>simon.rousseau@etu.univ-nantes.fr</td>
					</tr>
				</table>
			</div>
			
			<div class='personne'>
				<h3>Sébastien SORS</h3>
				<?php
					$srcPhoto = NULL;
					if($srcPhoto == NULL)
					{
						echo("<img src='Style/image/photo.png' />");
					}
					else
					{
						echo("<img src='$srcPhoto' alt='Ma tete' />");
					}
				?>
				<table>
					<tr>
						<th><?php echo($parserLangue->getWord("status")->getTraduction()); ?></th>
						<td>Maquetteur / Designer du site (frontOffice)</td>
					</tr>
					<tr>
						<th><?php echo($parserLangue->getWord("mail")->getTraduction()); ?></th>
						<td>sebastien.sors@etu.univ-nantes.fr</td>
					</tr>
				</table>
			</div>
			
		<div id="footerCorps"></div>
	</div>
	
	<?php
		include('footer.php');
	?>
</html>


