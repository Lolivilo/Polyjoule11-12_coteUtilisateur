jQuery().ready(function(){
               $("#menuPage li > a").hover(
                    function () {
                            if($(this).next("ul").is(":hidden")){
                                         $(this).next("ul").slideDown();
                            }
                    },
                    function(){
                    	if($(this).next("ul").is(":visible")){
                                         $(this).next("ul").slideUp();
                        }
                    }
                );
               
              /* $("#menuPage > li.active").parent("ul").slideDown();
               $("#menuPage > li.active").children("ul").slideDown();*/
               
});
