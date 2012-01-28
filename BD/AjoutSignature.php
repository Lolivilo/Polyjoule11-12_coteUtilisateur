<?php
	include_once('BD.php');
	
	$bd = new BD();
	
	try
	{
		// VERIFIER LES CHAMPS VIDES !!!!!
		
		
		$bd->connexion();	// Connexion a la BD
		$connexion = $bd->getConnexion();
		$lastId = $connexion->query("SELECT id_post FROM LIVRE_OR ORDER BY date_post ASC LIMIT 1")->fetch();
		$newId = $lastId['id_post'] + 1;
		$connexion->exec("INSERT INTO LIVRE_OR(id_post, posteur_post, mail_post, date_post, message_post) VALUES($newId, '".$_POST['pseudo']."', '".$_POST['mail']."', NOW(), '".$_POST['message']."')");
		//$connexion->exec("INSERT INTO LIVRE_OR(id_post, posteur_post, mail_post, date_post, message_post) VALUES(3, 'Oliv', 'oliv@toto.com', NOW(), 'ceci est un test')");
		// On recherche cette nouvelle signature pour verifier que l insertion s est bien passee
		if( ($connexion->query("SELECT * FROM LIVRE_OR WHERE id_post = $newId")->rowCount()) == 1 )
		{
			echo("Ajout OK");
		}
		else
		{
			echo("Ajout KO");
		}
	}
	catch(PDOException $e)
	{
	}
	
	$bd->deconnexion();
?>