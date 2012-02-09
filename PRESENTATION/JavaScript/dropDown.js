jQuery().ready(function(){
               $("#menuPage > li > a").click(
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
});
