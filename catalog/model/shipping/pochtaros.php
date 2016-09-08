<?php
class ModelShippingPochtaros extends Model {
    private $error = array();
    private $type = 'shipping';
   	private $name = 'pochtaros';

    private $methods = array(
        array('name' => 'ПростаяБандероль', 'key' => 'prostaya_banderol', 'title' => 'Простая бандероль', 'price' => 'Тариф', 'max_weight' => 2000),
        array('name' => 'ЗаказнаяБандероль', 'key' => 'zakaznaya_banderol', 'title' => 'Заказная бандероль', 'price' => 'Тариф', 'max_weight' => 2000),
        array('name' => 'ЦеннаяБандероль', 'key' => 'tsennaya_banderol', 'title' => 'Ценная бандероль', 'price' => 'Тариф', 'max_weight' => 2000),
        array('name' => 'ЦеннаяБандероль', 'key' => 'tsennaya_banderol_obyavlennaya_stennost', 'title' => 'Ценная бандероль с объявленной ценностью', 'price' => 'Доставка', 'max_weight' => 2000),
        array('name' => 'ЦеннаяПосылка', 'key' => 'tsennaya_posylka', 'title' => 'Ценная посылка', 'price' => 'Тариф', 'max_weight' => 20000),
        array('name' => 'ЦеннаяПосылка', 'key' => 'tsennaya_posylka_obyavlennaya_stennost', 'title' => 'Ценная посылка с объявленной ценностью', 'price' => 'Доставка', 'max_weight' => 20000),
        array('name' => 'ЦеннаяАвиаБандероль', 'key' => 'tsennaya_aviabanderol', 'title' => 'Ценная авиабандероль', 'price' => 'Тариф', 'max_weight' => 2000),
        array('name' => 'ЦеннаяАвиаБандероль', 'key' => 'tsennaya_aviabanderol_obyavlennaya_stennost', 'title' => 'Ценная авиабандероль с объявленной ценностью', 'price' => 'Доставка', 'max_weight' => 2000),
        array('name' => 'ЦеннаяАвиаПосылка', 'key' => 'tsennaya_aviaposylka', 'title' => 'Ценная авиапосылка', 'price' => 'Тариф', 'max_weight' => 2500),
        array('name' => 'ЦеннаяАвиаПосылка', 'key' => 'tsennaya_aviaposylka_obyavlennaya_stennost', 'title' => 'Ценная авиапосылка с объявленной ценностью', 'price' => 'Доставка', 'max_weight' => 2500),
        array('name' => 'ЗаказнаяБандероль1Класс', 'key' => 'zakaznaya_banderol_1_class', 'title' => 'Заказная бандероль 1 класс', 'price' => 'Тариф', 'max_weight' => 2500),
        array('name' => 'ЦеннаяБандероль1Класс', 'key' => 'tsennaya_banderol_1_class', 'title' => 'Ценная бандероль 1 класс', 'price' => 'Тариф', 'max_weight' => 2500),
        array('name' => 'ЦеннаяБандероль1Класс', 'key' => 'tsennaya_banderol_1_class_obyavlennaya_stennost', 'title' => 'Ценная бандероль 1 класс с объявленной ценностью', 'price' => 'Доставка', 'max_weight' => 2000),

        array('name' => 'МждМешокМ', 'key' => 'mzhd_meshok_m', 'title' => 'Международный мешок М', 'price' => 'Тариф', 'max_weight' => 14500),
        array('name' => 'МждМешокМАвиа', 'key' => 'mzhd_meshok_m_avia', 'title' => 'Международный мешок М авиа', 'price' => 'Тариф', 'max_weight' => 14500),
        array('name' => 'МждМешокМЗаказной', 'key' => 'mzhd_meshok_m_zakaznoi', 'title' => 'Международный мешок М заказной', 'price' => 'Тариф', 'max_weight' => 14500),
        array('name' => 'МждМешокМАвиаЗаказной', 'key' => 'mzhd_meshok_m_avia_zakaznoi', 'title' => 'Международный мешок М авиа заказной', 'price' => 'Тариф', 'max_weight' => 14500),
        array('name' => 'МждБандероль', 'key' => 'mzhd_banderol', 'title' => 'Международная бандероль', 'price' => 'Тариф', 'max_weight' => 5000),
        array('name' => 'МждБандерольАвиа', 'key' => 'mzhd_banderol_avia', 'title' => 'Международная авиабандероль', 'price' => 'Тариф', 'max_weight' => 5000),
        array('name' => 'МждБандерольЗаказная', 'key' => 'mzhd_banderol_zakaznaya', 'title' => 'Международная бандероль заказная', 'price' => 'Тариф', 'max_weight' => 5000),
        array('name' => 'МждБандерольАвиаЗаказная', 'key' => 'mzhd_banderol_avia_zakaznaya', 'title' => 'Международная авиабандероль заказная', 'price' => 'Тариф', 'max_weight' => 5000),
        array('name' => 'МждМелкийПакет', 'key' => 'mzhd_paket', 'title' => 'Международный мелкий пакет', 'price' => 'Тариф', 'max_weight' => 2000),
        array('name' => 'МждМелкийПакетАвиа', 'key' => 'mzhd_paket_avia', 'title' => 'Международный мелкий пакет авиа', 'price' => 'Тариф', 'max_weight' => 2000),
        array('name' => 'МждМелкийПакетЗаказной', 'key' => 'mzhd_paket_zakaznoi', 'title' => 'Международный мелкий пакет заказной', 'price' => 'Тариф', 'max_weight' => 2000),
        array('name' => 'МждМелкийПакетАвиаЗаказной', 'key' => 'mzhd_paket_avia_zakaznoi', 'title' => 'Международный мелкий пакет авиа заказной', 'price' => 'Тариф', 'max_weight' => 2000)
    );

	public function getQuote($address) {

        $this->language->load($this->type . '/' . $this->name);

        $method_data = array();

        //print_r($this->config->get('pochtaros_fragmentation'));

        $total = $this->cart->getSubTotal();

        if (is_array($this->config->get('pochtaros_store')) and in_array((int)$this->config->get('config_store_id'), $this->config->get('pochtaros_store'))) {

            $status = true;
        }
        else {
            $status = false;
        }


        if ($status and count($this->config->get('pochtaros_geo_zone')) > 0) {
            if (!isset($address['country_id']) or (isset($address['country_id']) and $address['country_id'] == '')) {
                $address['country_id'] = 176;
            }

            if (!isset($address['zone_id']) or (isset($address['zone_id']) and $address['zone_id'] == '')) {
                $address['zone_id'] = $this->config->get('pochtaros_zone_id');

                if ((int)$address['zone_id'] > 0) {
                    $this->load->model('localisation/zone');
                    $zone_info = $this->model_localisation_zone->getZone($address['zone_id']);

                    //print_r($zone_info);

                    if (isset($zone_info['name'])) {
                        $address['zone'] = $zone_info['name'];
                    }
                }
            }

            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone
                WHERE geo_zone_id IN (" . implode(',', $this->config->get('pochtaros_geo_zone')) . ") AND
                country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");

            if ($query->num_rows) {
                $status = true;
            }
            else {
                $status = false;
            }
        }
        else {
            $status = false;
        }

        $weight = $this->weight->convert($this->cart->getWeight(), $this->config->get('config_weight_class_id'), $this->config->get('pochtaros_weight_class_id'));

        if ($status) {

            if ($this->config->get('pochtaros_upakovka') and (int)$this->config->get('pochtaros_upakovka') > 0 ) {
                $weight = $weight + $this->config->get('pochtaros_upakovka');
            }
 
            if ($this->config->get('pochtaros_min_weight') and $weight < $this->config->get('pochtaros_min_weight') ) {
                $status = false;
            }
//echo($weight." ".$this->config->get('pochtaros_min_weight'));exit;
            if ($this->config->get('pochtaros_max_weight') and $weight > $this->config->get('pochtaros_max_weight') ) {
                $status = false;
            }

            if ((int)$this->config->get('pochtaros_max_total') > 0 and $total >= (int)$this->config->get('pochtaros_max_total')) {
                $status = false;
            }

        }


		if ($status) {


            $weight = $this->weight->convert($weight, $this->config->get('pochtaros_weight_class_id'), $this->config->get('config_weight_class_id'));

            if ($this->weight->getUnit($this->config->get('config_weight_class_id')) == 'кг') {
                $weight = $weight*1000;
            }

            $region = array();
            $region['from'] = $this->config->get('pochtaros_city');

            if (isset($address['postcode']) and $address['postcode'] != '') {
                $region['to'] = $address['postcode'];
            }
            else {
                $region['to'] = $address['zone'];

                $this->load->model('localisation/zone_dv');
                $new_region = $this->model_localisation_zone_dv->getZone($region);

                if (isset($new_region['to']) and $new_region['to']) {
                    $region['to'] = $new_region['to'];
                }
            }

            $from = urlencode($region['from']);
            $to = urlencode($region['to']);

            //print_r($address);

            $server = str_replace("http:", '', HTTP_SERVER);
            $server = str_replace("www.", '', $server);
            $server = str_replace("/", '', $server);

            if ($address['iso_code_2'] != 'RU') {
                $Request = 'http://api.postcalc.ru/?f='.$from.'&t='.$to.'&c='.$address['iso_code_2'].'&w='.$weight.'&v='.$total.'&o=php&e=0&st='.$server.'&ml='.$this->config->get('config_email').'&cs=utf-8&pn='.to_seo($this->config->get('config_owner'));
            }
            else {
                $Request = 'http://api.postcalc.ru/?f='.$from.'&t='.$to.'&w='.$weight.'&v='.$total.'&o=php&e=0&st='.$server.'&ml='.$this->config->get('config_email').'&cs=utf-8&pn='.to_seo($this->config->get('config_owner'));
            }

            


            if ($total < $this->config->get('pochtaros_total')) {
                $error_text = html_entity_decode(sprintf($this->language->get('error_description'), $this->currency->format($this->config->get('pochtaros_total')), $this->currency->format($this->tax->calculate($this->config->get('pochtaros_total')-$total,'', $this->config->get('config_tax')))), ENT_QUOTES, 'UTF-8');
            }


            if (isset($error_text)){
                 $error = $error_text;
            }
            else {
                 $error = false;
            }


            if ($error == false) {
                $curl = curl_init();

                curl_setopt($curl, CURLOPT_URL, $Request);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

                $Response = curl_exec($curl);

                curl_close($curl);

                if ( substr($Response,0,3) == "\x1f\x8b\x08" ) {
                    $Response=gzinflate(substr($Response,10,-8));
                }

                $arrResponse = unserialize($Response);

                //print_r($arrResponse);

                if (isset($arrResponse['Status']) and $arrResponse['Status'] != 'OK') {
                    $error = $arrResponse['Message'].'<br>'.html_entity_decode($this->language->get('error_postcode'));
                }
            }
            else {
                $arrResponse = array();
            }

            $quote_data = array();

            $active = false;
            foreach ($this->config->get('pochtaros_mstatus') as $val) {
                if ($val == 1) {
                    $active = true;
                }
            }

            if ($active == true and $error == false) {
                foreach ($this->config->get('pochtaros_mstatus') as $key => $value) {

                    $local = '';
                    foreach ($this->methods as $val) {
                        if ($value == 1 and $val['key'] == $key) {
                            $local = $val;
                            break;
                        }
                    }

                    if (isset($local['name'])  and
                        isset($arrResponse['Отправления'][$local['name']]['Тариф']) and $arrResponse['Отправления'][$local['name']]['Тариф'] > 0 and
                        isset($arrResponse['Отправления'][$local['name']]['Доставка']) and $arrResponse['Отправления'][$local['name']]['Доставка'] > 0 and

                        ( $this->config->get('pochtaros_fragmentation') or (!$this->config->get('pochtaros_fragmentation') and
                            isset($arrResponse['Отправления'][$local['name']]['ПредельныйВес']) and $weight <= $arrResponse['Отправления'][$local['name']]['ПредельныйВес']) )
                    ) {

                        /*if ($weight >= $local['max_weight']) {
                            $error = "Отправка авиапочтой доступна для товаров общим весом не более 2.5 кг и только по предоплате";
                        }*/

                        $price = floor($arrResponse['Отправления'][$local['name']]['Доставка']);
                        $delivery_time = floor($arrResponse['Отправления'][$local['name']]['СрокДоставки']);
                        //var_dump($local['price']);
                        //$price = $this->currency->convert($price, 'RUB', 'EUR');

                        //$price += $price*18/100;

                        $local['title_more'] = $local['title'];

                        if ($local['price'] == 'Доставка') {
                            $local['title_more'] .= ' '.$this->currency->format($this->tax->calculate($total,'', $this->config->get('config_tax')));
                        }

                        $arr_tara_price = $this->config->get('pochtaros_price');

                        if (isset($price) and (int)$price > 0) {
                            if (!isset($arrResponse['Отправления'][$local['name']]['Количество'])) {
                                $arrResponse['Отправления'][$local['name']]['Количество'] = 1;
                            }

                            $cost = (int)$this->config->get('pochtaros_cost') + $price + (int)$arr_tara_price[$key]*$arrResponse['Отправления'][$local['name']]['Количество'];
                            //$cost = (int)$this->config->get('pochtaros_cost') + $price + (int)$arr_tara_price[$key]*$arrResponse['Отправления'][$local['name']]['Количество'];
                            
                            $text = $this->currency->format($this->tax->calculate($cost,'', $this->config->get('config_tax')));

                        }
                        else {
                            $cost = '';
                            $text = '';
                        }

                        $key = $local['key'];


                        $text_fragmentation = '';

                        if ($this->config->get('pochtaros_fragmentation')) {
                            $text_fragmentation = ' ('.$arrResponse['Отправления'][$local['name']]['Количество'].' '.$this->language->get('text_items').')';
                        }


                        if ($cost > 0) {
                            $quote_data[$key] = array(
                                'code'         => $this->name.'.'.$key,
                                'title'        => 'Почта России',
                                'cost'         => $cost,
                                'tax_class_id' => '',
                                'text'         => $text,
                                'delivery_time'=> '(' . $delivery_time . ' дней)'
                            );
                        }
                    }
                }
            }


            if ((isset($quote_data) and count($quote_data) > 0) or $error) {
                $method_data = array(
                        'code'       => 'pochtaros',
                        'title'      => 'Почта России (' . $delivery_time . ' дней)',
                        'quote'      => $quote_data,
                        'sort_order' => $error ? ($this->config->get('pochtaros_sort_order') + 100) : $this->config->get('pochtaros_sort_order'),
                        'error'      => $error
                );
            }
		}
		$min_price = 9999999;
		foreach ($method_data["quote"] as $key => $method) {
			if ($min_price > $method["cost"]) {
				$tekcode = $key;
				$min_price = $method["cost"];
			}
		}
		if ($tekcode) {
			foreach ($method_data["quote"] as $key => $method) {
				if ($tekcode != $key) {
					unset($method_data["quote"][$key]);
				}
			}
		}
		return $method_data;
	}
}
?>