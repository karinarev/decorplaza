<?php
$db = mysql_connect("localhost", "decor-plaza", "J1e6G2t0"); #подключение к MySQL с передачей имени пользователя (user5) и пароля (password5)
mysql_select_db("decor-plaza"); #выбираем базу cj18282_perun
mysql_query("SET NAMES utf8");
$_POST[product_id] = mysql_real_escape_string($_POST[product_id]); #экранируем специальные символы в полученных от Content Downloader POST-данных id
$_POST[model] = mysql_real_escape_string($_POST[model]);
$_POST[stock_status_id] = mysql_real_escape_string($_POST[stock_status_id]); 
$_POST[quantity] = mysql_real_escape_string($_POST[quantity]); 
$_POST[name] = mysql_real_escape_string($_POST[descr]); 
mysql_query("INSERT INTO oc_product (product_id, model, stock_status_id, quantity, date_available) VALUES ('$_POST[product_id]', '$_POST[model]', '$_POST[stock_status_id]', '$_POST[quantity]', curdate())"); 
mysql_query("INSERT INTO oc_product_description (product_id, language_id, name) VALUES ('$_POST[product_id]', '1', '$_POST[name]')");
?>