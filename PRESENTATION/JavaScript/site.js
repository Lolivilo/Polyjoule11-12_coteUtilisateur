jQuery(document).ready(function($) {
$('.scroll-pane').jScrollPane();
$(window).resize(function() {$('.scroll-pane').jScrollPaneRemove();$('.scroll-pane').jScrollPane();});
 });