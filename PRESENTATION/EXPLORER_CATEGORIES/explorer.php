<?php
require_once '../BD/CategorieBD.php';
require_once '../BD/ArticleBD.php';

$article = NULL;
$category = NULL;


if(	(isset($_GET['article']))
{// Si l'article est renseign� dans l'url, on recherche les cat�gories parentes 



}
elseif(isset($_GET['categorie']))
{// Sinon si une cat�gorie est pass� en param�tre, on utilise la cat�gorie, puis on liste les sous cat�gories de cette derni�re, puis les articles pour chaque cat�gorie

}




$articleID = NULL;
$article = NULL;
$article = new ArticleBD('localhost', 'polyjoule', 'polyjoule', 'azerty');
$category = new CategorieBD('localhost', 'polyjoule', 'polyjoule', 'azerty');

$html.="<h2>





?>