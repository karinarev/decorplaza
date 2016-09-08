<?php
header('Content-Type: text/html; charset=utf-8');

$ioncube = false; 

foreach ( get_loaded_extensions() as $number => $extension_name ) {
	if ( (strpos( strtolower($extension_name) , "ioncube" )) === false) { 
	// do nothing 
	}
    else {
	    $ioncube = true;
	} 
}

echo '<h2>';
if ($ioncube) {
	echo '<span style="color: green">Ваш хостинг поддерживает Ioncube!</span>';
}
else {
	echo '<span style="color: red">Сейчас Ioncube на Вашем хостинге отключен или не установлен.</span>.<br />
	Свяжитесь с техподдержкой хостинга для решения вопроса по настройке Ioncube Loader для вас.';
}
echo '</h2>';
?>