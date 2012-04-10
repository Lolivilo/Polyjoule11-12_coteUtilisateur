jQuery().ready(function(){
	$("#mycarousel li img").click(
		function () {
			id__photo = $(this).next(".idImg").html();
        	id__album = $("#idAlb").html();
			$.post("http://localhost:8888/PRESENTATION/script_ajax_album_photo.php", {id_photo:id__photo,id_album:id__album},
				function(data) {
					if(data.success == "yes")
                	{
                    	$("#photo > img").attr('src',data.url);
                    	$("#photo > p").html(data.commentaire);
                    	$("#corps p").html(data.titre);
                 	}
                 	else
                 	{
                    	$("#photo > p").html(data.texte);
                 	}
                 	$("#photo > p").fadeOut();
                 	return false;
				}
			,"json");
			return false;
		}
	);
	
	$("#descriptionLien").click(
  		function () {
    		$(this).next("p").fadeIn();
  		}
	);
	
});
