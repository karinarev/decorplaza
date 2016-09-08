<?php
class ControllerModuleocScroll extends Controller {
	
	
	public function index() { 
		
		$this->data['current_version']='1.3';
	   
		$this->load->language('module/ocscroll');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('ocscroll', $this->request->post);		
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['text_yes'] 	= $this->language->get('text_yes');
		$this->data['text_no'] 		= $this->language->get('text_no');
		$this->data['entry_loading_text'] = $this->language->get('entry_loading_text');
		$this->data['entry_end_text'] = $this->language->get('entry_end_text');
		$this->data['entry_image'] = $this->language->get('entry_image');
		$this->data['entry_enable_module'] = $this->language->get('entry_enable_module');
		$this->data['entry_chk_image_text'] = $this->language->get('entry_chk_image_text');				
		$this->data['entry_content'] = $this->language->get('entry_content');
		$this->data['entry_item_selector'] = $this->language->get('entry_item_selector');
		$this->data['tab_contact'] = $this->language->get('tab_contact');				
		$this->data['tab_general'] = $this->language->get('tab_general');
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

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
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/ocscroll', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/ocscroll', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

				
		$this->data['settings'] = array();
		
		if (isset($this->request->post['oc_scroll_settings'])) {
			$this->data['settings'] = $this->request->post['oc_scroll_settings'];
		} elseif ($this->config->get('oc_scroll_settings')) { 
			$this->data['settings'] = $this->config->get('oc_scroll_settings');
		}			
		
		
		if (isset($this->data['settings']['enable'])){
			$this->data['settings_enable']=$this->data['settings']['enable'];
			
		}else{
			$this->data['settings_enable']=1;
		}
		
		if (isset($this->data['settings']['image'])){
			$this->data['settings_image']=$this->data['settings']['image'];
			
		}else{
			$this->data['settings_image']=0;
		}
		if (isset($this->data['settings']['selector'])){
			$this->data['settings_selector']=$this->data['settings']['selector'];
			
		}else{
			$this->data['settings_selector']="#content";
		}
		
		if (isset($this->data['settings']['item_selector'])){
			$this->data['settings_item_selector']=$this->data['settings']['item_selector'];
			
		}else{
			$this->data['settings_item_selector']=".product-list";
		}
		
		
		$this->load->model('localisation/language');
		
		$this->data['languages'] = $this->model_localisation_language->getLanguages();
		
		
		foreach ($this->data['languages'] as $language){
			
			if (isset($this->data['settings'][$language['language_id']]['txtloading'])){
			
				$this->data['settings_txtloading'][$language['language_id']]=$this->data['settings'][$language['language_id']]['txtloading'];
			
			}else{
			
				$this->data['settings_txtloading'][$language['language_id']]='';
			}
		
			
			if (isset($this->data['settings'][$language['language_id']]['txtend'])){
			
				$this->data['settings_txtend'][$language['language_id']]=$this->data['settings'][$language['language_id']]['txtend'];
			
			}else{
			
				$this->data['settings_txtend'][$language['language_id']]='';
			}
	
		
		}
		
		$ch = curl_init();
 			 // Now set some options (most are optional)
 		     // Set URL to download
  			 curl_setopt($ch, CURLOPT_URL,"http://www.ocmodules.com/version/versionocscroll.xml");
 		    // Include header in result? (0 = yes, 1 = no)
    		 curl_setopt($ch, CURLOPT_HEADER, 0);
     		// Should cURL return or print out the data? (true = return, false = print)
    		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 		    // Timeout in seconds
    		 curl_setopt($ch, CURLOPT_TIMEOUT, 10);
 		    // Download the given URL, and return output
    		$output = curl_exec($ch);
    		// Close the cURL resource, and free system resources
 		    curl_close($ch);
			$analizador=simplexml_load_string($output,null);
						
			$this->data['version']['version']=$analizador->children()->version;
			$this->data['version']['whats_new']=$analizador->children()->whats_new;
					
		foreach($analizador->children()->other_modules as $other_modules){
				
			$this->data['version']['modules'][]=array(
				
					'name'		=>$other_modules->name,
					'version'	=>$other_modules->version,
					'url'		=>$other_modules->url,
					'manual' 	=>$other_modules->manual,
					'price' 	=>$other_modules->price,
					'resume' 	=>$other_modules->resume,
					'id'		=>$other_modules->id
				);
				
			}
		
				
				
		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();

		$this->template = 'module/ocscroll.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/ocscroll')) {
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
