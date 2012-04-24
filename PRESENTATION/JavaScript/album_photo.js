jQuery().ready(function(){
	$("#mycarousel li img").click(
		function () {
			$(".loaderThumb").hide();
			imgLoader = $(this).parent().find(".loaderThumb");
			imgLoader.show();
			id__photo = $(this).next(".idImg").html();
        	id__album = $("#idAlb").html();
			$.post("http://polyjoule.org/site/PRESENTATION/getphoto", {id_photo:id__photo,id_album:id__album},
				function(data) {
					if(data.success == "yes")
                	{
                    	$("#photo > img").attr('src',data.url);
                    	$("#photo > p").html(data.commentaire);
                    	$("#corps > h3").html(data.titre);
                 	}
                 	else
                 	{
                    	$("#photo > p").html(data.texte);
                 	}
                 	$("#corps > h3").fadeOut();
                 	imgLoader.fadeOut();
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
	$("#description").click(
  		function () {
    		$(this).fadeOut();
    		return false;
  		}
	);
	
});
