jQuery().ready(function(){
               $("#menuPage li").hover(
                    function () {
                            if($(this).children("ul").is(":hidden")){
                                         $(this).children("ul").slideDown();
                            }
                    },
                    function(){
                    	if($(this).children("ul").is(":visible")){
                                         $(this).children("ul").slideUp();
                        }
                    }
                );
               
              /* $("#menuPage > li.active").parent("ul").slideDown();
               $("#menuPage > li.active").children("ul").slideDown();*/
               
});
