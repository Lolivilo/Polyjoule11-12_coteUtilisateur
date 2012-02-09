<?php
    include_once('BD.php');
    include_once('../METIER/LivreDOr.php');
    
    /** getAllLivreDOr()
     *  Renvoie un tableau contenant tous les commentaires du livre d or sous forme d objets LivreDOr
     *  @return LivreDOr $tableauDeLivreDOr[] : un tableau contenant tous les LivreDOr existants
     */
    
    function getAllLivreDOr()
    {
        $bd = new BD();
        $tableauDeLivreDOr = array();
        
        try
        {
            $bd->connexion();											// Connexion a la BD
            $connexion = $bd->getConnexion();
            $resultQuery = $connexion->query("SELECT * FROM LIVRE_OR")->fetchAll();	// Execution de la requete
            
            foreach($resultQuery as $row)
            {
                $livre = new LivreDOr($row['id_post'], $row['posteur_post'], $row['mail_post'], $row['date_post'], $row['message_post']);
                array_push($tableauDeLivreDOr, $livre);
            }
        }
        catch(PDOException $e)
        {
            
        }
        $bd->deconnexion();	// Deconnexion de la BD
        
        return $tableauDeLivreDOr;
    }
    
    
    
    /** function getAllAcceptedLivreDOr()
     * Liste l'ensemble des signatures acceptées dans un tableau
     * @return LivreDOr $tableauDeLivreDOr[] : un tabeau contenant tous les LivreDOr listés
     **/
    function getAllAcceptedLivreDOr()
    {
        $bd = new BD();
        $tableauDeLivreDOr = array();
        
        try
        {
            $bd->connexion();											// Connexion a la BD
            $connexion = $bd->getConnexion();
            $resultQuery = $connexion->query("SELECT * FROM LIVRE_OR WHERE accept_post = 1 ORDER BY date_post DESC")->fetchAll();	// Execution de la requete
            
            foreach($resultQuery as $row)
            {
                $livre = new LivreDOr($row['id_post'], $row['posteur_post'], $row['mail_post'], $row['date_post'], $row['message_post']);
                array_push($tableauDeLivreDOr, $livre);
            }
        }
        catch(PDOException $e)
        {
            
        }
        $bd->deconnexion();	// Deconnexion de la BD
        
        return $tableauDeLivreDOr;
    }
    
    ?>