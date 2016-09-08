<?php
class ControllerModulenextprevlinks extends Controller {
	private $error = array(); 
	
	public function index() {   
		$this->load->language('module/nextprevlinks');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->model_setting_setting->editSetting('nextprevlinks', $this->request->post);		
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect(HTTPS_SERVER . 'index.php?route=extension/module&token=' . $this->session->data['token']);
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

		/* module vars */
		$this->data['entry_link_style'] = $this->language->get('entry_link_style');
		$this->data['entry_link_style_np'] = $this->language->get('entry_link_style_np');
		$this->data['entry_link_style_names'] = $this->language->get('entry_link_style_names');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
       		'href'      => HTTPS_SERVER . 'index.php?route=common/home&token=' . $this->session->data['token'],
      		'separator' => FALSE
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
       		'href'      => HTTPS_SERVER . 'index.php?route=extension/module&token=' . $this->session->data['token'],
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
       		'href'      => HTTPS_SERVER . 'index.php?route=module/nextprevlinks&token=' . $this->session->data['token'],
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = HTTPS_SERVER . 'index.php?route=module/nextprevlinks&token=' . $this->session->data['token'];
		
		$this->data['cancel'] = HTTPS_SERVER . 'index.php?route=extension/module&token=' . $this->session->data['token'];

		if (isset($this->request->post['nextprevlinks_latest_products'])) {
			$this->data['nextprevlinks_latest_products'] = $this->request->post['nextprevlinks_latest_products'];
		} else {
			$this->data['nextprevlinks_latest_products'] = $this->config->get('nextprevlinks_latest_products');
		}
		
		if (isset($this->request->post['nextprevlinks_link_style'])) {
			$this->data['nextprevlinks_link_style'] = $this->request->post['nextprevlinks_link_style'];
		} else {
			$this->data['nextprevlinks_link_style'] = $this->config->get('nextprevlinks_link_style');
		}
		
		if (isset($this->request->post['nextprevlinks_status'])) {
			$this->data['nextprevlinks_status'] = $this->request->post['nextprevlinks_status'];
		} else {
			$this->data['nextprevlinks_status'] = $this->config->get('nextprevlinks_status');
		}
		
		
		$this->template = 'module/nextprevlinks.tpl';
		$this->children = array(
			'common/header',	
			'common/footer'	
		);
		
		$this->response->setOutput($this->render());
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/nextprevlinks')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
}
?>
