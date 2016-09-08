<?php
/*
*   misterspaun@gmail.com
*   demo: arduino55.ru
*/
?>
<?php
class ControllerShippingshipard extends Controller {
	private $error = array(); 
	
	public function index() {   
		$this->load->language('shipping/shipard');

		$this->document->setTitle(strip_tags($this->language->get('heading_title')));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('shipard', $this->request->post);
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_all_zones'] = $this->language->get('text_all_zones');
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_shipard_sort_order'] = $this->language->get('text_shipard_sort_order');
		$this->data['text_shipard_name'] = $this->language->get('text_shipard_name');
                $this->data['text_shipard_php'] = $this->language->get('text_shipard_php');

		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_cost'] = $this->language->get('entry_cost');
		$this->data['entry_tax_class'] = $this->language->get('entry_tax_class');
		$this->data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
                $this->data['entry_type'] = $this->language->get('entry_type');
                
                $this->data['text_shipard_inner'] = $this->language->get('text_shipard_inner');
                $this->data['text_shipard_index'] = $this->language->get('text_shipard_index');
                $this->data['text_shipard_weight'] = $this->language->get('text_shipard_weight');
                $this->data['text_shipard_weight_pack'] = $this->language->get('text_shipard_weight_pack');
                $this->data['text_shipard_opis'] = $this->language->get('text_shipard_opis');
                $this->data['text_shipard_time'] = $this->language->get('text_shipard_time');
                $this->data['text_shipard_parent'] = $this->language->get('text_shipard_parent');
                $this->data['text_shipard_noview'] = $this->language->get('text_shipard_noview');
                
                $this->data['text_post_banderol'] = $this->language->get('post_banderol');
                $this->data['text_post_zak_banderol'] = $this->language->get('post_zak_banderol');
                $this->data['text_post_zak_banderol_1'] = $this->language->get('post_zak_banderol_1');
                $this->data['text_post_cen_banderol'] = $this->language->get('post_cen_banderol');
                $this->data['text_post_cen_posilka'] = $this->language->get('post_cen_posilka');
                $this->data['text_post_cen_avio_banderol'] = $this->language->get('post_cen_avio_banderol');
                $this->data['text_post_cen_avio_posilka'] = $this->language->get('post_cen_avio_posilka');
                $this->data['text_post_cen_banderol_1'] = $this->language->get('post_cen_banderol_1');
                $this->data['text_post_ems'] = $this->language->get('post_ems');
                $this->data['text_post_fix'] = $this->language->get('post_fix');

		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_remove'] = $this->language->get('button_remove');


 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

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
			'href'      => $this->url->link('shipping/shipard', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('shipping/shipard', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['cancel'] = $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['modules'] = array();

		if (isset($this->request->post['shipard'])) {
			$this->data['modules'] = $this->request->post['shipard'];
		} else {
                    if ($this->config->get('shipard')) {
                    $this->data['modules'] = $this->config->get('shipard');}
		}
                
                               
		$this->data['shipard_sort_order'] = "";
		if (isset($this->request->post['shipard_sort_order'])) {
			$this->data['shipard_sort_order'] = $this->request->post['shipard_sort_order'];
		} else {
                    if ($this->config->get('shipard_sort_order')) {
                    $this->data['shipard_sort_order'] = $this->config->get('shipard_sort_order');}
                }
                
                $this->data['shipard_index'] = "";
		if (isset($this->request->post['shipard_index'])) {
			$this->data['shipard_index'] = $this->request->post['shipard_index'];
		} else {
                    if ((int)$this->config->get('shipard_index') > 0) {
                    $this->data['shipard_index'] = $this->config->get('shipard_index');
                    } else {$this->data['shipard_index'] = '143000';}
                }
                
                $this->data['shipard_weight'] = "";
		if (isset($this->request->post['shipard_weight'])) {
			$this->data['shipard_weight'] = $this->request->post['shipard_weight'];
		} else {
                    if ((int)$this->config->get('shipard_weight') == '') {
			$this->data['shipard_weight'] = 500;
                        
                    } else {
                        $this->data['shipard_weight'] = $this->config->get('shipard_weight');
                    }
                }
                
                $this->data['shipard_weight_pack'] = "";
		if (isset($this->request->post['shipard_weight_pack'])) {
			$this->data['shipard_weight_pack'] = $this->request->post['shipard_weight_pack'];
		} else {
                    if ($this->config->get('shipard_weight_pack') == '') {
			$this->data['shipard_weight_pack'] = 10;
                    } else {
                            $this->data['shipard_weight_pack'] = $this->config->get('shipard_weight_pack');
                    }
                }
                
                $this->data['shipard_noview'] = "";
		if (isset($this->request->post['shipard_noview'])) {
		    if($this->request->post['shipard_noview']=='1'){
                        $this->data['shipard_noview'] = '1';} else {$this->data['shipard_noview'] = '0';}
                } else {
                    $this->data['shipard_noview'] = $this->config->get('shipard_noview');
                }
                
                $this->data['shipard_time'] = "";
		if (isset($this->request->post['shipard_time'])) {
		    if($this->request->post['shipard_time']=='1'){
                        $this->data['shipard_time'] = '1';} else {$this->data['shipard_time'] = '0';}
                } else {
                    $this->data['shipard_time'] = $this->config->get('shipard_time');
                }
                
                $this->data['shipard_inner'] = "";
		if (isset($this->request->post['shipard_inner'])) {
			if($this->request->post['shipard_inner']=='1'){
                            $this->data['shipard_inner'] = '1';}
                } else {
                    $this->data['shipard_inner'] = $this->config->get('shipard_inner');
                }
                
                $this->data['shipard_opis'] = "";
		if (isset($this->request->post['shipard_opis'])) {
			if($this->request->post['shipard_opis']=='1'){
                            $this->data['shipard_opis'] = '1';}
                } else {
                    $this->data['shipard_opis'] = $this->config->get('shipard_opis');
                }
                
                $this->data['shipard_name'] = "";
		if (isset($this->request->post['shipard_name'])) {
			$this->data['shipard_name'] = $this->request->post['shipard_name'];
		} else {
                    if ($this->config->get('shipard_name')!='') {
			$this->data['shipard_name'] = $this->config->get('shipard_name');
                    } else {
                        $this->data['shipard_name'] = $this->language->get('text_shipard_title_default');}
                }
                
                $this->data['shipard_parent'] = "";
		if (isset($this->request->post['shipard_parent'])) {
                $this->data['shipard_parent'] = $this->request->post['shipard_parent'];
		} else {
                    if ($this->config->get('shipard_parent') != '') {
                        $this->data['shipard_parent'] = $this->config->get('shipard_parent');
                    } else {
                        $this->data['shipard_parent'] = $this->shipard_translit($this->config->get('config_owner'));}
                }
                
                $this->data['shipard_php'] = "";
		if (isset($this->request->post['shipard_php'])) {
			$this->data['shipard_php'] = $this->request->post['shipard_php'];
		} else {
                    if ($this->config->get('shipard_php')=='') {
                        $this->data['shipard_php'] = 1;
                    } else { $this->data['shipard_php'] = $this->config->get('shipard_php'); }
                }
        
                $this->load->model('localisation/tax_class');
		
		$this->data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();
		
		$this->load->model('localisation/geo_zone');
		
		$this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
								
		$this->template = 'shipping/shipard.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
        
        private function shipard_translit($str) 
					{
					    $translit = array(
					        "А"=>"A","Б"=>"B","В"=>"V","Г"=>"G",
					        "Д"=>"D","Е"=>"E","Ж"=>"J","З"=>"Z","И"=>"I",
					        "Й"=>"Y","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",
					        "О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",
					        "У"=>"U","Ф"=>"F","Х"=>"H","Ц"=>"TS","Ч"=>"CH",
					        "Ш"=>"SH","Щ"=>"SCH","Ъ"=>"","Ы"=>"YI","Ь"=>"",
					        "Э"=>"E","Ю"=>"YU","Я"=>"YA","а"=>"a","б"=>"b",
					        "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
					        "з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
					        "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
					        "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
					        "ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
					        "ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya"
					    );
					    return strtr($str,$translit);
					}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'shipping/shipard')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
?>
