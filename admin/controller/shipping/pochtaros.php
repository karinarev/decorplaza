<?php
class ControllerShippingPochtaros extends Controller {
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


	public function index() {
        $this->data = array_merge($this->data, $this->load->language($this->type . '/' . $this->name));

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('pochtaros', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'));
		}

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

        if (isset($this->error['geo_zone'])) {
            $this->data['error_geo_zone'] = $this->error['geo_zone'];
        } else {
            $this->data['error_geo_zone'] = '';
        }

        if (isset($this->error['store'])) {
            $this->data['error_store'] = $this->error['store'];
        } else {
            $this->data['error_store'] = '';
        }

        if (isset($this->error['min_weight'])) {
            $this->data['error_min_weight'] = $this->error['min_weight'];
        } else {
            $this->data['error_min_weight'] = '';
        }

        if (isset($this->error['max_weight'])) {
            $this->data['error_max_weight'] = $this->error['max_weight'];
        } else {
            $this->data['error_max_weight'] = '';
        }

        if (isset($this->error['cost'])) {
            $this->data['error_cost'] = $this->error['cost'];
        } else {
            $this->data['error_cost'] = '';
        }

        if (isset($this->error['price'])) {
            $this->data['error_price'] = $this->error['price'];
        } else {
            $this->data['error_price'] = '';
        }

        if (isset($this->error['total'])) {
            $this->data['error_total'] = $this->error['total'];
        } else {
            $this->data['error_total'] = '';
        }

        if (isset($this->error['max_total'])) {
            $this->data['error_max_total'] = $this->error['max_total'];
        } else {
            $this->data['error_max_total'] = '';
        }

        if (isset($this->error['upakovka'])) {
            $this->data['error_upakovka'] = $this->error['upakovka'];
        } else {
            $this->data['error_upakovka'] = '';
        }

        $this->data['methods'] = $this->methods;

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_shipping'),
			'href'      => $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('shipping/pochtaros', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

		$this->data['action'] = $this->url->link('shipping/pochtaros', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['cancel'] = $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL');


        if (isset($this->request->post['pochtaros_name'])) {
			$this->data['pochtaros_name'] = $this->request->post['pochtaros_name'];
		} else {
			$this->data['pochtaros_name'] = $this->config->get('pochtaros_name');
		}

        if (isset($this->request->post['pochtaros_city'])) {
			$this->data['pochtaros_city'] = $this->request->post['pochtaros_city'];
		} else {
			$this->data['pochtaros_city'] = $this->config->get('pochtaros_city');
		}

		if (isset($this->request->post['pochtaros_cost'])) {
			$this->data['pochtaros_cost'] = $this->request->post['pochtaros_cost'];
		} else {
			$this->data['pochtaros_cost'] = $this->config->get('pochtaros_cost');
		}


        if (($this->request->server['REQUEST_METHOD'] == 'POST') and isset($this->request->post['pochtaros_geo_zone'])) {
			$this->data['pochtaros_geo_zone'] = $this->request->post['pochtaros_geo_zone'];
		}
        elseif (($this->request->server['REQUEST_METHOD'] == 'POST') and !isset($this->request->post['pochtaros_geo_zone'])) {
            $this->data['pochtaros_geo_zone'] = array();
        }
        else {
			$this->data['pochtaros_geo_zone'] = $this->config->get('pochtaros_geo_zone');
		}


        if (($this->request->server['REQUEST_METHOD'] == 'POST') and isset($this->request->post['pochtaros_store'])) {
            $this->data['pochtaros_store'] = $this->request->post['pochtaros_store'];
        }
        elseif (($this->request->server['REQUEST_METHOD'] == 'POST') and !isset($this->request->post['pochtaros_store'])) {
            $this->data['pochtaros_store'] = array();
        }
        else {
            $this->data['pochtaros_store'] = $this->config->get('pochtaros_store');
        }


        if (isset($this->request->post['pochtaros_method'])) {
            $this->data['pochtaros_method'] = $this->request->post['pochtaros_method'];
        } else {
            $this->data['pochtaros_method'] = $this->config->get('pochtaros_method');
        }

		if (isset($this->request->post['pochtaros_status'])) {
			$this->data['pochtaros_status'] = $this->request->post['pochtaros_status'];
		} else {
			$this->data['pochtaros_status'] = $this->config->get('pochtaros_status');
		}

        if (isset($this->request->post['pochtaros_fragmentation'])) {
            $this->data['pochtaros_fragmentation'] = $this->request->post['pochtaros_fragmentation'];
        } else {
            $this->data['pochtaros_fragmentation'] = $this->config->get('pochtaros_fragmentation');
        }

		if (isset($this->request->post['pochtaros_sort_order'])) {
			$this->data['pochtaros_sort_order'] = $this->request->post['pochtaros_sort_order'];
		} else {
			$this->data['pochtaros_sort_order'] = $this->config->get('pochtaros_sort_order');
		}

        if (isset($this->request->post['pochtaros_total'])) {
            $this->data['pochtaros_total'] = $this->request->post['pochtaros_total'];
        } else {
            $this->data['pochtaros_total'] = $this->config->get('pochtaros_total');
        }

        if (isset($this->request->post['pochtaros_max_total'])) {
            $this->data['pochtaros_max_total'] = $this->request->post['pochtaros_max_total'];
        } else {
            $this->data['pochtaros_max_total'] = $this->config->get('pochtaros_max_total');
        }

        if (isset($this->request->post['pochtaros_min_weight'])) {
            $this->data['pochtaros_min_weight'] = $this->request->post['pochtaros_min_weight'];
        } else {
            $this->data['pochtaros_min_weight'] = $this->config->get('pochtaros_min_weight');
        }

        if (isset($this->request->post['pochtaros_max_weight'])) {
            $this->data['pochtaros_max_weight'] = $this->request->post['pochtaros_max_weight'];
        } else {
            $this->data['pochtaros_max_weight'] = $this->config->get('pochtaros_max_weight');
        }

        if (isset($this->request->post['pochtaros_upakovka'])) {
            $this->data['pochtaros_upakovka'] = $this->request->post['pochtaros_upakovka'];
        } else {
            $this->data['pochtaros_upakovka'] = $this->config->get('pochtaros_upakovka');
        }

        if (isset($this->request->post['pochtaros_mstatus'])) {
            $this->data['pochtaros_mstatus'] = $this->request->post['pochtaros_mstatus'];
        } else {
            $this->data['pochtaros_mstatus'] = $this->config->get('pochtaros_mstatus');
        }

        if (isset($this->request->post['pochtaros_price'])) {
            $this->data['pochtaros_price'] = $this->request->post['pochtaros_price'];
        }
        else {
            $this->data['pochtaros_price'] = $this->config->get('pochtaros_price');
        }


        $this->load->model('localisation/weight_class');
        $this->data['weight_classes'] = $this->model_localisation_weight_class->getWeightClasses();

        if (isset($this->request->post['pochtaros_weight_class_id'])) {
            $this->data['pochtaros_weight_class_id'] = $this->request->post['pochtaros_weight_class_id'];
        }
        elseif ($this->config->get('pochtaros_weight_class_id')) {
            $this->data['pochtaros_weight_class_id'] = $this->config->get('pochtaros_weight_class_id');
        }
        elseif (isset($weight_info)) {
            $this->data['pochtaros_weight_class_id'] = $this->config->get('config_weight_class_id');
        }


        if (isset($this->request->post['pochtaros_zone_id'])) {
            $this->data['pochtaros_zone_id'] = $this->request->post['pochtaros_zone_id'];
        }
        else {
            $this->data['pochtaros_zone_id'] = $this->config->get('pochtaros_zone_id');
        }


        $this->load->model('localisation/zone');
        $this->data['zones'] = $this->model_localisation_zone->getZonesByCountryId(176);

        $this->load->model('setting/store');
        $this->data['stores'] = $this->model_setting_store->getStores();

        $this->load->model('localisation/geo_zone');
        $this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

        $this->data['text_default'] = $this->config->get('config_name');

		$this->template = 'shipping/pochtaros.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'shipping/pochtaros')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

        $active = false;

        //print_r($this->request->post['pochtaros_mstatus']);
        foreach ($this->request->post['pochtaros_mstatus'] as $key => $val) {
            if ($val == 1) {
                $active = true;

                if (isset($this->request->post['pochtaros_price'][$key]) and !empty($this->request->post['pochtaros_price'][$key]) and !ctype_digit($this->request->post['pochtaros_price'][$key])) {
                    $this->error['price'][$key] = $this->language->get('error_number');
                }
            }
        }

        if ($active == false) {
            $this->error['warning'] = $this->language->get('error_methods');
        }

        if (!isset($this->request->post['pochtaros_geo_zone'])) {
            $this->error['geo_zone'] = $this->language->get('error_geo_zone');
        }

        if (!isset($this->request->post['pochtaros_store'])) {
            $this->error['store'] = $this->language->get('error_store');
        }

        if (isset($this->request->post['pochtaros_min_weight']) and !empty($this->request->post['pochtaros_min_weight']) and !preg_match("/^[0-9]{1,}(\.[0-9]{0,5})?$/", $this->request->post['pochtaros_min_weight'])) {
            $this->error['min_weight'] = $this->language->get('error_decimal');
        }

        if (isset($this->request->post['pochtaros_max_weight']) and !empty($this->request->post['pochtaros_max_weight']) and !preg_match("/^[0-9]{1,}(\.[0-9]{0,5})?$/", $this->request->post['pochtaros_max_weight'])) {
            $this->error['max_weight'] = $this->language->get('error_decimal');
        }

        if (isset($this->request->post['pochtaros_cost']) and !empty($this->request->post['pochtaros_cost']) and !ctype_digit($this->request->post['pochtaros_cost'])) {
            $this->error['cost'] = $this->language->get('error_number');
        }

        if (isset($this->request->post['pochtaros_total']) and !empty($this->request->post['pochtaros_total']) and !ctype_digit($this->request->post['pochtaros_total'])) {
            $this->error['total'] = $this->language->get('error_number');
        }

        if (isset($this->request->post['pochtaros_max_total']) and !empty($this->request->post['pochtaros_max_total']) and !ctype_digit($this->request->post['pochtaros_max_total'])) {
            $this->error['max_total'] = $this->language->get('error_number');
        }

        if (isset($this->request->post['pochtaros_upakovka']) and !empty($this->request->post['pochtaros_upakovka']) and !preg_match("/^[0-9]{1,}(\.[0-9]{0,5})?$/", $this->request->post['pochtaros_upakovka'])) {
            $this->error['upakovka'] = $this->language->get('error_decimal');
        }

        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
}
?>