<?php
include_once '../BD/ArticleBD.php';


	$ArticleBD = new ArticleBD('localhost', 'polyjoule', 'polyjoule', 'azerty');

	$ArticleBD->getArticleWithId(21);
	
	
	print_r($ArticleBD->getArticlesWithCategory(1));
	
		




?>