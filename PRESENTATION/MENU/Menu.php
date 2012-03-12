<?php
	function getMenu($CategorieBD,$classParent,$classChildren)
	{
		$html = "";
		$ParentsCategories = $CategorieBD->getSousCategories(NULL);// tableau d'objets categorie
		foreach ($ParentsCategories as $CatParent)// parcours des catégories parentes
		{
            if( $CatParent->isAlbum() )
            {
                $html.= "<li><a href='albumPhoto.php?idAlbum=".getMostRecentAlbum()."'>".$CatParent->getTitre()."</a>";
                $tabAlbums = getAllAlbums();    // Si on est sur les albums, on affiche non pas des sous-categories
                
                                            // mais des albums
                $html.= "<ul>";
                foreach($tabAlbums as $album)
                {
                    $html .= "<li><a href='albumPhoto.php?idAlbum=".$album->getId()."'>".$album->getNom()."</a></li>";
                }
                $html .= "</ul></li>";
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
                    if( $SousCat->isPersonne() )   // Redirection vers le template Personne
                    {
                        $html.="<li><a href='personne.php'>".$SousCat->getTitre()."</a></li>";
                    }
                    else if($SousCat->isLivreOr() ) // Redirection vers le template Livre d or
                    {
                        $html.="<li><a href='livreDOr.php?numPage=1'>".$SousCat->getTitre()."</a></li>";
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
