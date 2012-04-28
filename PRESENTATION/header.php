<?php 
	require_once('../BD/acces_rubrique.php');
	require_once('MENU/Menu.php');
    require_once('../METIER/LangueParser.php');
	require_once('LANGUE/sessionLangue.php');
    require_once('../BD/acces_albumPhoto.php');
    require_once('../METIER/FonctionsMetier/pagination.php');
    require_once('../METIER/FonctionsMetier/calendrier.php');
    
    $parserLangue = new LangueParser();
?>

<div id="header">
<h1><a href=<?php echo("'index.php'"); ?>><img src="Style/image/logoPolyjoule.png" alt="Polyjoule"/></a></h1>
<div id="barre">
<a href="contact"><?php echo $parserLangue->getWord("contact")->getTraduction(); ?></a>
<span class="lang">
<?php $link = $_SERVER['REQUEST_URI']; ?>
<form style="display:none;" id="Formlangue" method="post" action="<?php echo $link; ?>">
		<input type="hidden" name="lang" value="FR">
</form>
<?php
	if($_POST['lang'] == 'EN')
	{
		echo("<a href='' class='changeLangue' id='FR'>FR</a> | <a href='' class='changeLangue active' id='EN'>EN</a>");
	}
	else
	{
		echo("<a href='' class='changeLangue active' id='FR'>FR</a> | <a href='' class='changeLangue' id='EN'>EN</a>");
	}
?>
<a href="" class="changeLangue active" id="FR">FR</a> | <a href="" class="changeLangue" id="EN">EN</a>
<script language="javascript">
	jQuery().ready(function(){
		$(".changeLangue").click(function () 
			{
				$("#Formlangue > input").attr('value', $(this).attr("id"));
				$("#Formlangue").submit();
				return false;
			}
		);

	});
</script>
</span>
<form method="get" action="recherche.php">
	<label for="search"><?php echo($parserLangue->getWord("search")->getTraduction()); ?></p></label>
	<input type="text" id="search" name="w">
	<input type="submit" value="ok">
</form>
<iframe src="https://www.facebook.com/plugins/like.php?href=https://www.facebook.com/pages/Polyjoule/121213844627305"
        scrolling="no" frameborder="0"
        style="border:none; width:450px; height:80px"></iframe>
</div>		
<div class="clear"></div>
</div>
<ul id="menuHeader">
    <?php
        $menu = new CategorieBD();
    	echo getMenu($menu,'limenu','child');
    ?>
</ul>
