<?php
	function getMenu($CategorieBD,$classParent,$classChildren)
	{
		$html = "";
		$ParentsCategories = $CategorieBD->getSousCategories(NULL);// tableau d'objets categorie
		foreach ($ParentsCategories as $CatParent)// parcours des catégories parentes
		{
            if( $CatParent->isAlbum() )
            {
                $html.= "<li><a href='albumPhoto.php?idAlbum=1'>".$CatParent->getTitre()."</a>";
            }
            else
            {
                $HasChildren = FALSE;
                $idCatParent = $CatParent->getId();
                $html.= "<li><a href='".$CatParent->getUrl()."'>".$CatParent->getTitre()."</a>";
                $ChildrenCategories = $CategorieBD->getSousCategories($idCatParent);// tableau d'objets categorie
                if($ChildrenCategories != NULL)// Si la catégorie parente a des enfants
                {
                    $HasChildren = TRUE;
                    $html.= "<ul>";
                }
                foreach ($ChildrenCategories as $SousCat)// parcours des catgories de second niveau
                {
                    if( $SousCat->isLivreOr() ) // On teste vers quel template rediriger
                    {
                        $html.="<li><a href='livreDOr.php?numPage=1'>".$SousCat->getTitre()."</a></li>";
                    }
                    else if( $SousCat->isPersonne() )
                    {
                        // REDIRECTION VERS LE TEMPLATE DE PERSONNES
                    }
                    else
                    {
                        $html.= "<li><a href='".$SousCat->getUrl()."'>".$SousCat->getTitre()."</a></li>";
                    }
				
                }
                if($HasChildren)
                {
                    $html.= "</ul>";
                }
                $html.= "</li>";
            }
        }

		return $html;
	}   


?>
