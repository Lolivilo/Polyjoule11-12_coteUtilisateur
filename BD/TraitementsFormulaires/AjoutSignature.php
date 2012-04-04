<?php
	include_once('BD.php');
	
	$bd = new BD();
	
	try
	{
        $regExp = '`^[[:alnum:]]([-_.]?[[:alnum:]_?])*@[[:alnum:]]([-.]?[[:alnum:]])+\.([a-z]{2,6})$`';
        
        if( ($_POST['pseudo'] == "") || ($_POST['mail'] == "") || ($_POST['message'] == "") )   // Verifie les champs remplis
        {
            header('Location: ../PRESENTATION/livreDOr.php?emptyInput=true');   // On redirige vers la page avec un argument false

        }
        elseif ( !(preg_match($regExp, $_POST['mail'])) )  // Verification adresse mail
        {
            header('Location: ../PRESENTATION/livreDOr.php?mailSyntax=false');
        }
		else
        {
		
            $bd->connexion();	// Connexion a la BD
            $connexion = $bd->getConnexion();
            $lastId = $connexion->query("SELECT id_post FROM LIVRE_OR ORDER BY date_post ASC LIMIT 1")->fetch();
            $newId = $lastId['id_post'] + 1;
            $connexion->exec("INSERT INTO LIVRE_OR(id_post, posteur_post, mail_post, date_post, message_post) VALUES($newId, '".$_POST['pseudo']."', '".$_POST['mail']."', NOW(), '".$_POST['message']."')");
		
            // On recherche cette nouvelle signature pour verifier que l insertion s est bien passee
            if( ($connexion->query("SELECT * FROM LIVRE_OR WHERE id_post = $newId")->rowCount()) == 1 )
            {
                header('Location: ../PRESENTATION/livreDOr.php?signAttempt=true');
            }
            else
            {
                header('Location: ../PRESENTATION/livreDOr.php?signAttempt=false');
            }
        }
    }
    catch(PDOException $e)
    {
    	$ex = new ConnexionException();
    }
	
    $bd->deconnexion();
?>