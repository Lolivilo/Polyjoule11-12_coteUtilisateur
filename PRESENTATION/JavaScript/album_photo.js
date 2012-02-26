jQuery().ready(function(){

               $("#albumPhoto #photos > a").click(
                                           function () {
                                                  id__photo = $(this).children(".idImg").html();
                                                  id__album = $("#idAlb").html();
                                                  $("#loader").fadeIn();
                                                  $.post("http://localhost:8888/script_ajax_album_photo.php",
                                                         {id_photo:id__photo,id_album:id__album},
                                                           function(data){
                                                                if(data.success == 'yes')
                                                                {
                                                                    $("#corps #photo > img#mainPhoto").attr('src',data.url);
                                                                    $("#corps #photo > p").html(data.commentaire);
                                                                    $("#corps > h4").html(data.titre);
                                                         
                                                                }
                                                                else
                                                                {
                                                                     $("#corps #photo > p").html(data.texte);
                                                                }
                                                                $("#loader").fadeOut();
                                                         
                                                         },"json");
                                                  return false;
                                           }
               );               
});
