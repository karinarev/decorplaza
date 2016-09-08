<?php
class ControllerModuleanalogproducts extends Controller {
	
	private $error = array(); 
	
	public function index() {   
		$this->language->load('module/analogproducts');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			//$this->model_setting_setting->editSetting('filter', $this->request->post);	
			$this->config->set($key, $this->request->post['pogr']); 		
			
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['entry_pogr'] = $this->language->get('entry_pogr');
		$this->data['pogr'] = $this->config->get('analogproducts_pogr');
		//var_dump($this->data['pogr']);
		
//$this->config->set($key, $value);
	
		
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
			'href'      => $this->url->link('module/analogproducts', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/analogproducts/editsettings', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['modules'] = array();
	
				
		

		$this->template = 'module/analogproducts.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	function file_force_download($file) {
	  
	}
	
	public function editsettings() {   
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->language->load('module/analogproducts');
			$pogr = $this->request->post['pogr'];
			$sql = "UPDATE `" . DB_PREFIX . "setting` as s SET value='$pogr' WHERE s.key='analogproducts_pogr'";
			//echo($sql);
			$this->db->query($sql);
			
			//$this->model_setting_setting->editSetting('filter', $this->request->post);	
			//$this->config->set('analogproducts_pogr', $this->request->post['pogr']); 		
			
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
	
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/analogproducts')) {
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
