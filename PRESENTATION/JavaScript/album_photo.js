jQuery().ready(function(){

               $("#albumPhoto #photos li a").click(
                                           function () {
                                                  alert('appel');
                                                  id__photo = $(this).children(".idImg").html();
                                                  id__album = $("#idAlb").html();
                                                  $("#loader").fadeIn();
                                                  $.post("localhost:8888/PRESENTATION/script_ajax_album_photo.php",
                                                         {id_photo:id__photo,id_album:id__album},
                                                           function(data){
                                                           alert(data);
                                                                if(data.success == 'yes')
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
                                                                $("#loader").fadeOut();
                                                         
                                                         },"json");
                                                  return false;
                                           }
               );
               //Reference = $(".ul#photos li:first-child");
               /*$("#albumPhoto .suivant").click(function()
                                    {
                                                alert('test');
                                        $("#photos").animate({    marginLeft : - (Reference.width() * 2 * 3)}); 
                                               return false;
                                    }
                                    
                );*/
               
              /* Reference = $("#photos li:first-child");
               $("#photos").wrap('<div class="carrousel-conteneur"></div>')
               $(".carrousel-conteneur").css("width",  Reference.width()  ).css("height", Reference.height() );
              */
               
               ///http://babylon-design.com/tutoriel-jquery-faire-un-carrousel/
});
