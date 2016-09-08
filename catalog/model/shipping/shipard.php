<?php
error_reporting(E_ALL);
class ModelShippingshipard extends Model {
	function getQuote($address) {
                $arrResponse = array();
		$status = false;
		$shipards = $this->config->get('shipard');

		foreach($shipards as $i => $flat) {
			if(!$flat['status']) {
				continue;
			}
                        if($this->config->get('shipard_inner')=='1'){
                        $myzone=$this->config->get('config_zone_id');} else {$myzone='';}
                        if($address['zone_id']==$myzone) {$check = false;} else {$check = true;}
                        if($this->config->get('shipard_php')=='1'){$o='xml';} else {$o='php';}
                        if($this->config->get('shipard_opis')=='1'){$v=$this->cart->getSubTotal();} else {$v='0';}
                        if($this->cart->getWeight() > 0) {
                            $wei=intval($this->weight->convert($this->cart->getWeight(), $this->config->get('config_weight_class_id'), 2)) + $this->config->get('shipard_weight_pack');
                        }
                        else{$wei = $this->config->get('shipard_weight');}
                        $Request=http_build_query(array (
                                        "Site" => $_SERVER['HTTP_HOST'],
                                        "Email" => $this->config->get('config_email'),
                                        "Person" => rawurlencode($this->config->get("shipard_parent")),
                                        "f" => $this->config->get("shipard_index"),
                                        "t" => $address["postcode"],
                                        "w" => $wei,
                                        "v" => $v,
                                        "o" => $o
                                        ));
                        $Request="http://api.postcalc.ru/?$Request";
                        $Response=file_get_contents($Request);
                        if($o=='xml'){
                        $arrResponse = wddx_deserialize($Response);}
                        else{$arrResponse = unserialize($Response);}
                        if(!$flat['geo_zone_id'] && $check) {
				$status = true;
			} else {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$flat['geo_zone_id'] . "'" .
										  " AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");
				if($query->num_rows) {
					$status = true;
				} else {
					$shipards[$i]['status'] = false;
				}
			}
		}

		$method_data = array();

		if($status) {
			$quote_data = array();
			$sort_order = array();

			foreach($shipards as $i => $flat) {
				if(!$flat['status']) {
					continue;
				}
                                if(@$this->config->get('shipard_type')=='9'){
                                    $quote_data['shipard' . $i] = array(
                                            'code' => 'shipard.shipard' . $i,
                                            'title' => $flat['name'],
                                            'cost' => $flat['cost'],
                                            'tax_class_id' => $flat['tax_class_id'],
                                            'text' => $this->currency->format($this->tax->calculate($flat['cost'], $flat['tax_class_id'], $this->config->get('config_tax')))
                                    );
                                    
                                } else {
                                    if(isset($flat['shipard_type'])) {
                                    switch ($flat['shipard_type']) {
                                                    case "0":
                                                        $ship_cost=isset($arrResponse['ПростаяБандероль']['Тариф']) ? @$arrResponse['ПростаяБандероль']['Тариф'] : 0;
                                                        $time_post=isset($arrResponse['ПростаяБандероль']['СрокДоставки']) ? @$arrResponse['ПростаяБандероль']['СрокДоставки'] : 0;
                                                        break;
                                                    case "1":
                                                        $ship_cost=isset($arrResponse['ЗаказнаяБандероль']['Тариф']) ? @$arrResponse['ЗаказнаяБандероль']['Тариф'] : 0;
                                                        $time_post=isset($arrResponse['ЗаказнаяБандероль']['СрокДоставки']) ? @$arrResponse['ЗаказнаяБандероль']['СрокДоставки'] : 0;
                                                        break;
                                                    case "2":
                                                        $ship_cost=isset($arrResponse['ЗаказнаяБандероль1Класс']['Тариф']) ? @$arrResponse['ЗаказнаяБандероль1Класс']['Тариф'] : 0;
                                                        $time_post=isset($arrResponse['ЗаказнаяБандероль1Класс']['СрокДоставки']) ? @$arrResponse['ЗаказнаяБандероль1Класс']['СрокДоставки'] : 0;
                                                        break;
                                                    case "3":
                                                        $ship_cost=isset($arrResponse['ЦеннаяБандероль']['Тариф']) ? @$arrResponse['ЦеннаяБандероль']['Тариф'] : 0;
                                                        $time_post=isset($arrResponse['ЦеннаяБандероль']['СрокДоставки']) ? @$arrResponse['ЦеннаяБандероль']['СрокДоставки'] : 0;
                                                        break;
                                                    case "4":
                                                        $ship_cost=isset($arrResponse['ЦеннаяПосылка']['Тариф'] )? @$arrResponse['ЦеннаяПосылка']['Тариф'] : 0;
                                                        $time_post=isset($arrResponse['ЦеннаяПосылка']['СрокДоставки']) ? @$arrResponse['ЦеннаяПосылка']['СрокДоставки'] : 0;
                                                        break;
                                                    case "5":
                                                        $ship_cost=isset($arrResponse['ЦеннаяАвиаБандероль']['Тариф']) ? @$arrResponse['ЦеннаяАвиаБандероль']['Тариф'] : 0;
                                                        $time_post=isset($arrResponse['ЦеннаяАвиаБандероль']['СрокДоставки']) ? @$arrResponse['ЦеннаяАвиаБандероль']['СрокДоставки'] : 0;
                                                        break;
                                                    case "6":
                                                        $ship_cost=isset($arrResponse['ЦеннаяАвиаПосылка']['Тариф']) ? @$arrResponse['ЦеннаяАвиаПосылка']['Тариф'] : 0;
                                                        $time_post=isset($arrResponse['ЦеннаяАвиаПосылка']['СрокДоставки']) ? @$arrResponse['ЦеннаяАвиаПосылка']['СрокДоставки'] : 0;
                                                        break;
                                                    case "7":
                                                        $ship_cost=isset($arrResponse['ЦеннаяБандероль1Класс']['Тариф']) ? @$arrResponse['ЦеннаяБандероль1Класс']['Тариф'] : 0;
                                                        $time_post=isset($arrResponse['ЦеннаяБандероль1Класс']['СрокДоставки']) ? @$arrResponse['ЦеннаяБандероль1Класс']['СрокДоставки'] : 0;
                                                        break;
                                                    case "8":
                                                        $ship_cost=isset($arrResponse['EMS']['Тариф']) ? $arrResponse['EMS']['Тариф'] : 0;
                                                        $time_post=isset($arrResponse['EMS']['СрокДоставки']) ? @$arrResponse['EMS']['СрокДоставки'] : 0;
                                                        break;
                                    }}
                                if((int)$flat['cost']>0){$ship_cost=(int)$ship_cost+(int)$flat['cost'];}                
                                   if($this->config->get('shipard_time')=='1'){$titl=$flat['name'].' (примерно: '.$time_post.' дней)';}
                                   else {$titl=$flat['name'];}
                                $quote_data['shipard' . $i] = array(
					'code' => 'shipard.shipard' . $i,
					'title' => $titl,
					'cost' => $ship_cost,
					'tax_class_id' => $flat['tax_class_id'],
					'text' => $this->currency->format($this->tax->calculate($ship_cost, $flat['tax_class_id'], $this->config->get('config_tax')))
                                ); 
                                    
                                }
                                
				$sort_order[$i] = $flat['sort_order'];
			}

			array_multisort($sort_order, SORT_ASC, $quote_data);
                        if(@$this->config->get('shipard_noview')!='1') $sh_title=$this->config->get('shipard_name'); else $sh_title='';
			$method_data = array(
				'code' => 'shipard',
				'title' => $sh_title,
				'quote' => $quote_data,
				'sort_order' => $this->config->get('shipard_sort_order'),
				'error' => false
			);
		}

		return $method_data;
	}
        
         
                
        
}

?>
