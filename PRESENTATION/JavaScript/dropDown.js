jQuery().ready(function(){
               $("#menuPage li > a").click(
                    function () {
                            if($(this).next("ul").is(":hidden")){
                                         $(this).next("ul").slideDown();
                            }
                            else
                            {
                                         $(this).next("ul").slideUp();
                            }
                            return false;
                    }
                );
               
              /* $("#menuPage > li.active").parent("ul").slideDown();
               $("#menuPage > li.active").children("ul").slideDown();*/
               
});
