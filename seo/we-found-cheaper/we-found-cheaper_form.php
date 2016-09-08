<style>
	#we-found-cheaper_form label {
		font-weight: bold;
		padding: 10px 0;
		display: inline-block;
	}
	/*#we-found-cheaper_form .form-group {
	    padding: 0 20px;
	}*/
	#we-found-cheaper_form .item {
		border-bottom: solid 1px grey;
		padding: 10px 20px;
	}
	#we-found-cheaper_form .item input {
		width: 400px;
	}
	#we-found-cheaper_form .user {
		padding: 10px 20px;
	}
	/*#we-found-cheaper_form .user label {
		width: 200px;
	}*/
	#we-found-cheaper_form .user .col-sm-7 {
		display: inline-block;
	}
	#we-found-cheaper_form .user input {
		width: 196px;
	}
	#we-found-cheaper_form .buttons {
	    display: inline-block;
		padding: 0 10px;
	}
	#we-found-cheaper_form .buttons p {
	    display: inline-block;
		text-decoration: none;
		background: #FEA904;
		font-size: 16px;
		line-height: 24px;
		color: #fff;
		padding: 7px;
		margin: 0;
	}
</style>
<!--script type="text/javascript" src="/catalog/view/theme/theme331/js/jquery/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="/catalog/view/theme/theme331/js/fancybox3/jquery.fancybox.pack.js"></script>
<link rel="stylesheet" type="text/css" href="/catalog/view/theme/theme331/js/fancybox3/jquery.fancybox.css" media="screen" />
<script type="text/javascript" language="javascript" src="/seo/we-found-cheaper/we-found-cheaper.js"></script-->
<form action="" method="post" enctype="multipart/form-data" id="we-found-cheaper_form" class="form-horizontal" onsubmit="send_form_we_found_cheaper(); return false;">
	<div class="content contact-f form-horizontal">
		<label>Нашли цену ниже?</label>
		<div class="item">
			<div class="form-group">
				<label class="control-label col-sm-5" for="name">Наименование товара</label>
				<div class="col-sm-7">
					<input  type="text" name="item_name" rel="name" value="" disabled="disabled" />
					<input  type="hidden" name="name[]" rel="name" value="" />
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-5" for="price">Цена</label>
				<div class="col-sm-7">
					<input  type="text" name="item_price" value="" rel="price" disabled="disabled" />
					<input  type="hidden" name="price[]" value="" rel="price" />
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-5" for="url">Ссылка на товар с меньшей ценой</label>
				<div class="col-sm-7">
					<input  type="text" name="url[]" value="" rel="url" required="required" />
				</div>
			</div>
		</div>
		<div class="user">
			<div class="form-group">
				<label class="control-label col-sm-5" for="email">Номер вашего телефона</label>
				<div class="controls col-sm-7">
					<input  type="text" name="user-phone" value="" required="required" />
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-5" for="name">Ваше имя</label>
				<div class="col-sm-7">
					<input  type="text" name="user-name" value="" required="required" />
				</div>
			</div>	
		</div>
		<div class="form-group" style="text-align: center;">			
			<div class="buttons"><button type="submit" class="button"><span>Отправить</span></button></div>
			<div class="buttons"><a href="/we-found-cheaper" target="_blank"><p>Подробнее об акции</p></a></div>
		</div>
	</div>
	<input type="hidden" name="refferer" id="refferer">
</form>