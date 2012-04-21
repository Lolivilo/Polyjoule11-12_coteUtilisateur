<script  type="text/javascript" src="JavaScript/jquery-1.4.1.min.js"></script>
<script language="javascript">
	jQuery().ready(function(){
		$(".changeLangue").click(function () 
			{
				$("#Formlangue > input").attr('value', $(this).attr("id"));
				$("#Formlangue").submit();
				return false;
			}
		);

	});
</script>