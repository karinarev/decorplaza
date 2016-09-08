$(document).ready(function() {
	
	$('.we-found-cheaper')
		.fancybox({
			href: '#we-found-cheaper',
			/*href: '/seo/we-found-cheaper/we-found-cheaper_form.php',*/
			/*type: 'iframe'*/
		});
		/*.click(function(){
			$('#we-found-cheaper_form input[type="text"]').val('123');
			alert($('#we-found-cheaper_form input[name="name"]').val());
		});*/
		
	$('.we-found-cheaper').click(function(){
		$.ajax({
			url: "/seo/we-found-cheaper/we-found-cheaper_form.php",
			success: function(data){
				$('#we-found-cheaper').html(data);
				if($("div").is(".product-info")){
					$("#we-found-cheaper_form .item").each(function(indx){
						$(this).find('input').each(function(indx1){
							$(this).attr('rel', $(this).attr('rel') + '_' + indx);
						});
					});
					$('#we-found-cheaper_form input[rel="name_0"]').val($('h1').html());
					$('#we-found-cheaper_form input[rel="price_0"]').val($.trim($('span[itemprop="price"]').html()));
				}
				if($("table").is(".simplecheckout-cart")){
					
					var block_item = '<div class="item">'+$('#we-found-cheaper_form .item').html()+'</div>';
					$(".simplecheckout-cart tr").each(function(indx){
						if(indx>1) {
							$("#we-found-cheaper_form .item:last").after(block_item);
						}
					});
					$("#we-found-cheaper_form .item").each(function(indx){
						$(this).find('input').each(function(indx1){
							$(this).attr('rel', $(this).attr('rel') + '_' + indx);
						});
					});
					$(".simplecheckout-cart tr").each(function(indx){
						if(indx>0) {
							$('#we-found-cheaper_form input[rel="name_'+(indx-1)+'"]').val($(this).find('.name>a').html());
							$('#we-found-cheaper_form input[rel="price_'+(indx-1)+'"]').val($(this).find('.price nobr').html());
						}
					});
				}
				$("#refferer").val(parent.window.location);
			}
		});
	});
	
});

	function send_form_we_found_cheaper() {

			$.ajax({
				type : 'post',
				url : '/seo/we-found-cheaper/we-found-cheaper.php',
				data : $("#we-found-cheaper_form").serializeArray(),
				dataType : 'html',
				success: function (data) {
					$('#we-found-cheaper').html(data);
				}
			});
			
	}