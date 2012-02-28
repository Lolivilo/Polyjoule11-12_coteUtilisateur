<?php 
	require_once('../BD/CategorieBD.php');
	require_once('MENU/Menu.php');
    require_once('../BD/LangueParser.php');
	include_once('LANGUE/sessionLangue.php');
    $parserLangue = new LangueParser();
    ?>
<div id="header">
<h1><a href=<?php echo("'http://".$_SERVER['HTTP_HOST']."/PRESENTATION/index.php'");?>><img src="Style/image/logoPolyjoule.png" alt="Polyjoule"/></a></h1>
<div id="barre">
<a href=""><?php echo $parserLangue->getWord("contact")->getTraduction(); ?></a>
<a href="http://localhost:8888/index.php?lang=FR" class="active">FR</a> | <a href="http://localhost:8888/index.php?lang=EN">EN</a>
<form method="get" action="http://localhost:8888/search.php"> 
	<input type="text" id="search" name="w">
	<input type="submit" value="Search">
</form>
</div>		
<div class="clear"></div>
</div>
<ul id="menuHeader">
    <?php
        $categoryBD = new CategorieBD('localhost', 'polyjoule', 'polyjoule', 'azerty');
    	echo getMenu($categoryBD,'limenu','child');
    ?>
</ul>
