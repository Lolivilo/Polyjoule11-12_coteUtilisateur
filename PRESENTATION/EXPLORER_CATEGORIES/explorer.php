<?php

$category = new CategorieBD();

$SuperParentcategoryID = NULL;
$SuperParentcategory = NULL;

$CategoryParenteID = NULL;
$CategoryParente = NULL;

$SousCategories = NULL;

$html = NULL;


/*
 *  RECUPERATION DE LA SUPER CATEGORIE
 *  +
 * 	RECUPERATION DE LA CATEGORIE DU NIVEAU SUPERRIEUR POUR UN ARTICLE. DONNE LA CATEGORIE DU $_GET SI LA CATEGORIE EST PASSEE EN PARAMETRE
 *
 */
if(	(isset( $_GET['article'] ) ) )
{// Si l'article est renseign� dans l'url, on recherche les cat�gories parentes 
	$SuperParentcategoryID = $category->getSuperParentCategoryOfArticle($_GET['article']);
	$CategoryParenteID = $category->getAsssociateCategoryIDForArticle($_GET['article']);
}
elseif( isset( $_GET['categorie'] ) )
{// Sinon si une cat�gorie est pass� en param�tre, on utilise la cat�gorie, puis on liste les sous cat�gories de cette derni�re, puis les articles pour chaque cat�gorie
	$SuperParentcategoryID = $category->getSuperParentCategoryOfCategory($_GET['categorie']);
	$CategoryParenteID = $_GET['categorie'];
}
// On instancie la super cat�gorie
$SuperParentcategory = $category->getCategorieWithId($SuperParentcategoryID);
// et la cat�gorie parente de niveau sup�rieur
$CategoryParente = $category->getCategorieWithId($CategoryParenteID);
echo $CategoryParente->getId();



//Recup�ration des sous cat�gories de la cat�gorie parente
$SousCategories = $category->getSousCategories($SuperParentcategoryID);

// DEBUT AFFICHAGE HTML

$html.="<h2>".$SuperParentcategory->getTitreFR()."</h2><ul>";
foreach ($SousCategories as $_Categorie)
{
	$html.="<li class='ExpN1";
	if($_Categorie->getID() == $CategoryParente->getID())
		$html.=" selected";
	$html.="'>".$_Categorie->getTitreFR();
	$SousCategoriesN2 = NULL; // Cat�gories filles de la cat�gorie du tour de boucle du foreach
	// Si la cat�gorie en cours � des filles
	if($SousCategoriesN2 = $category->getSousCategories($_Categorie->getId()))
	{
		$html.="<ul>";
		foreach ($SousCategoriesN2 as $CategorieN2)
		{
			$html.="<li class='ExpN2";
			if($CategorieN2->getID() == $CategoryParente->getID())
				$html.=" selected";
			$html.= "'>".$CategorieN2->getTitreFR()."</li>";
		}
		$html.="</ul>";
	}
	$html.="</li>";
	
	
	
}
$html.="</ul>";




echo $html;





?>