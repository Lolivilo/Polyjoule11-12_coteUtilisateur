<?php
	include_once('../BD.php');
	
	$bd = new BD();
	
	try
	{
        $regExp = '`^[[:alnum:]]([-_.]?[[:alnum:]_?])*@[[:alnum:]]([-.]?[[:alnum:]])+\.([a-z]{2,6})$`';
        
        if( ($_POST['pseudo'] == "") || ($_POST['mail'] == "") || ($_POST['message'] == "") )   // Verifie les champs remplis
        {
            //header('Location: ../../PRESENTATION/livredor.php?signAttempt=i');   // On redirige vers la page avec un argument false
			header('location: ../../PRESENTATION/livreor--i');
        }
        elseif ( !(preg_match($regExp, $_POST['mail'])) )  // Verification adresse mail
        {
            //header('Location: ../../PRESENTATION/livredor.php?signAttempt=m');
            header('location: ../../PRESENTATION/livreor--m');
        }
		else
        {
		
            $bd->connexion();	// Connexion a la BD
            $connexion = $bd->getConnexion();
            $lastId = $connexion->query("SELECT id_post FROM LIVRE_OR ORDER BY date_post ASC LIMIT 1")->fetch();
            //$newId = $lastId['id_post'] + 1;
            $nbAnciensPost = $connexion->query("SELECT COUNT(*) FROM LIVRE_OR")->rowCount();
            //$connexion->exec("INSERT INTO LIVRE_OR(id_post, posteur_post, mail_post, date_post, message_post) VALUES($newId, '".$_POST['pseudo']."', '".$_POST['mail']."', NOW(), '".$_POST['message']."')");
            $msg = NoHtml($_POST['message']);
            $connexion->exec("INSERT INTO LIVRE_OR(posteur_post, mail_post, date_post, message_post) VALUES('".$_POST['pseudo']."', '".$_POST['mail']."', NOW(), '".$msg."')");
		
            // On recherche cette nouvelle signature pour verifier que l insertion s est bien passee
            $nbPosts = $connexion->query("SELECT COUNT(*) FROM LIVRE_OR")->rowCount();
            
            if( $nbPosts == ($nbAncienPost+1) )
            {
                //header('Location: ../../PRESENTATION/livredor.php?signAttempt=o');
                header('location: ../../PRESENTATION/livreor--o');
            }
            else
            {
                //header('Location: ../../PRESENTATION/livredor.php?signAttempt=k');
                header('location: ../../PRESENTATION/livreor--k');
            }
        }
    }
    catch(PDOException $e)
    {
    	$ex = new ConnexionException();
    }
	
    $bd->deconnexion();
?>