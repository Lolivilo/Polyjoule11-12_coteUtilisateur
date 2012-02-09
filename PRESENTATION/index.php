<?php 
	session_start();
?>
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
        <div id="ariane">
            <a href="index.html">Notre Association</a> > <a href="index.html">Notre aaa</a> > <a href="index.html">Nzevgzg</a>
        </div>
            <?php
                include('explorer/explorer.php');
            ?>
        <div id="corps">

            <div id="footerCorps">
            </div>
        </div>

        <div id="footer">
            <img src="image/a.png" /> <img src="image/b.png" />

            <p>PolyJoule 2012 - Tous droits reservés</p>
        </div>
    </body>
</html>
