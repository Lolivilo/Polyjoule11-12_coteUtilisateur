<?php

$category = new CategorieBD();

$SuperParentCategoryID = NULL;
$SuperParentCategory = NULL;

$LinkedCategoryID = 0;
$LinkedCategory = NULL;

$SousCategories = NULL;

$html = NULL;

if(	(isset( $_GET['article'] ) ) )
{
	$LinkedCategoryID = $category->getAsssociateCategoryIDForArticle($_GET['article']);	
}
elseif( isset( $_GET['cat'] ) )
{
	$LinkedCategoryID = $_GET['cat'];
}

$LinkedCategory = $category->getCategorieWithId($LinkedCategoryID);    

$SuperParentCategory = $category->getSuperParentCategoryOfCategory($LinkedCategoryID);

//echo "SUPERPARENT : ".$SuperParentCategory->getId()."  CAT : ".$LinkedCategory->getId();

//    print_r($LinkedCategory);




//RecupŽration des sous catŽgories de la catŽgorie SuperParent
$SousCategories = $category->getSousCategories($SuperParentCategory->getId());
    //print_r($SousCategories);
// DEBUT AFFICHAGE HTML

$html.="<ul id='menuPage'><li><h2>".$SuperParentCategory->getTitre()."</h2></li>";
if($SuperParentCategory->getIdTemplate() == 2)	// Si c'est la rubrique de liste d'albums, on les affiche
{
	try
	{
		$tabAlb = getAllAlbums();
	}
	catch(RequestException $e)
	{
		echo( $e->getMessage() );
	}
	foreach($tabAlb as $tab)
	{
		$html .= "<li>";
		$html .= "<a href='".$tab->getUrl()."'>".$tab->getNom()."</a>";
	}
}

if($SuperParentCategory->getIdTemplate() == 6)	// Si c'est la rubrique des partenaires, on les affiche
{
	try
	{
		$tabPart = getTousPartners();
	}
	catch(RequestException $e)
	{
		echo( $e->getMessage() );
	}
	foreach($tabAlb as $tab)
	{
		$html .= "<li>";
		$html .= "<a href='".$part->getUrl()."'>".$part->getNom()."</a>";
	}
}

foreach ($SousCategories as $_Categorie)
{
	$html.="<li";
	if( $_Categorie->getID() == $LinkedCategory->getID() )
    {
		$html.=" class='Nactive'";//active
    }
    
    $html.="><a href='".$_Categorie->getUrl()."'>".$_Categorie->getTitre()."</a>";
   
	
	$SousCategoriesN2 = NULL; // CatŽgories filles de la catŽgorie du tour de boucle du foreach
	// Si la catŽgorie en cours ˆ des filles
	if($SousCategoriesN2 = $category->getSousCategories($_Categorie->getId()))
	{
		$html.="<ul>";
		foreach ($SousCategoriesN2 as $CategorieN2)
		{
			$html.="<li";
			if( $CategorieN2->getID() == $LinkedCategory->getID() )
            {
				$html.=" class='Nactive'";
            }
            
            $html.= "><a href='".$CategorieN2->getUrl()."'>".$CategorieN2->getTitre()."</a>";
            
            
			
            
            $SousCategoriesN3 = NULL; // CatŽgories filles de la catŽgorie du tour de boucle du foreach
            // Si la catŽgorie en cours ˆ des filles (Niveau 3 _MAX)
            if($SousCategoriesN3 = $category->getSousCategories($CategorieN2->getId()))
            {
                $html.="<ul>";
                foreach ($SousCategoriesN3 as $CategorieN3)
                {
                    $html.="<li";
                    if($CategorieN3->getID() == $LinkedCategory->getID())
                        $html.=" class='Nactive'";
                    $html.= "><a href='".$CategorieN3->getUrl()."'>".$CategorieN3->getTitre()."</a>";
                    
                }
                $html.="</ul>";
            }
            $html.="</li>";
		}
		$html.="</ul>";
	}
	$html.="</li>";
	
	
	
}
$html.="</ul>";




echo $html;





?>
