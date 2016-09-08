<?
$request = '';
if (isset($_REQUEST['refferer'])) {
	$ok = false;				
	$to = 'info@perun-shop.ru';
	$subject = 'Запрос "нашли цену дешевле?" с сайта perun-shop.ru';
	$message = "
				<h1>".$subject."</h1>
				<p><b>Имя:</b> " . strip_tags($_REQUEST['user-name']) . "</p>
				<p><b>Телефон:</b> " . strip_tags($_REQUEST['user-phone']) . "</p>";
	foreach($_REQUEST['name'] as $key=>$item){
	$message .= "---
				<p><b>Наименование товара:</b> " . strip_tags($_REQUEST['name'][$key]) . "</p>
				<p><b>Цена:</b> " . strip_tags($_REQUEST['price'][$key]) . "</p>
				<p><b>Ссылка на товар с меньшей ценой:</b> " . strip_tags($_REQUEST['url'][$key]) . "</p>";
	}
	$message .= "---
				<p>Отправлено со страницы <a href=".$_REQUEST['refferer'].">страницы</a></p>";	
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n";
	$headers .= "From: No Reply <perun-shop.ru>\r\n";
	$send = mail($to, $subject, $message, $headers);
	if ($send) $ok = true;
	$request = '
	<div style="text-align: center;">
		<h2 style="    font-size: 30px; margin: 50px 0;">Большое спасибо!</h2>
		<p><b>Ма свяжемся с вами сразу после проверки информации</b></p>
	</div>';
}
?>
<?=$request?>