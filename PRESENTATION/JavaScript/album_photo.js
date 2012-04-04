jQuery().ready(function(){$("#mycarousel li img").click(
	function () {
		id__photo = $(this).next(".idImg").html();
        id__album = $("#idAlb").html();
		$.post("http://localhost:8888/PRESENTATION/script_ajax_album_photo.php", {id_photo:id__photo,id_album:id__album},
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
                 return false;
			}
		,"json");
		return false;
	}
);
});
/* */

/*


$.post("localhost:8888/PRESENTATION/script_ajax_album_photo.php",
                                                         {id_photo:id__photo,id_album:id__album},
                                                           function(data){
                                                           alert(data);
                                                                /*if(data.success == 'yes')
                                                                {
                                                                	 alert('success');
                                                                    $("#corps #photo > img#mainPhoto").attr('src',data.url);
                                                                    $("#corps #photo > p").html(data.commentaire);
                                                                    $("#corps > h4").html(data.titre);
                                                         
                                                                }
                                                                else
                                                                {
                                                                	 alert('echec');
                                                                     $("#corps #photo > p").html(data.texte);
                                                                }
                                                               // $("#loader").fadeOut();
                                                         
                                                         },"json");
                                                         
                                                         
                                                        */