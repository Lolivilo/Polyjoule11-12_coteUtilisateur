<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml">  


<head>  
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
    <title>Polyjoule</title>  
    <link rel="stylesheet" type="text/css" href="Style/index.css" />
    <script  type="text/javascript" src="JavaScript/jquery.js"></script>
    <script  type="text/javascript" src="JavaScript/menu.js"></script>
    <script  type="text/javascript" src="JavaScript/dropDown.js"></script>
</head>


<body>
	<?php 
        include('header.php');
    ?>
    <div id='corps'>
    	<h1>
    		<?php
    			if($_GET['code'] == 0)
    			{
    				echo("L'URL n'est pas valide !");
    			}
    			else if($_GET['code'] == 1)
    			{
    				echo("Cette page n'existe pas dans la base de données !");
    			}
    		?>
    	</h1>
    	<div id="footerCorps"></div>
    </div>
	<?php
    include_once('footer.php');
    ?>

</body>


</html>
