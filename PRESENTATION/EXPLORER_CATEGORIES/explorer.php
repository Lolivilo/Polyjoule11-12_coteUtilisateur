<?php
require_once '../../BD/CategorieBD.php';
//require_once '../../BD/ArticleBD.php';

$article = NULL;
$category = NULL;
$html = NULL;

if(	(isset( $_GET['article'] ) ) )
{// Si l'article est renseign� dans l'url, on recherche les cat�gories parentes 
	
	$categoryBD = new CategorieBD();
	print_r($categoryBD->getSuperParentCategoryOfArticle($_GET['article']));


}
elseif( isset( $_GET['categorie'] ) )
{// Sinon si une cat�gorie est pass� en param�tre, on utilise la cat�gorie, puis on liste les sous cat�gories de cette derni�re, puis les articles pour chaque cat�gorie

}




$articleID = NULL;
$article = NULL;
/*$article = new ArticleBD();
$category = new CategorieBD();*/

$html.="<h2>";





?>