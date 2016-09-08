<?php 
class ControllerModuleParseimport extends Controller { 
	private $error = array();
	
	public function index() {
		$this->load->language('module/parseimport');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('module/parseimport2');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			if ((isset( $this->request->files['upload'] )) && (is_uploaded_file($this->request->files['upload']['tmp_name']))) {
				$file = $this->request->files['upload']['tmp_name'];
				if ($this->model_module_parseimport2->upload($file)) {
					$this->session->data['success'] = $this->language->get('text_success');
					$this->redirect($this->url->link('module/parseimport', 'token=' . $this->session->data['token'], 'SSL'));
				}
				else {
					$this->error['warning'] = $this->language->get('error_upload');
				}
			}
		}

		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['entry_restore'] = $this->language->get('entry_restore');
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['button_import'] = $this->language->get('button_import');
		$this->data['tab_general'] = $this->language->get('tab_general');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
		
		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => FALSE
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/parseimport', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);
		
		$this->data['action'] = $this->url->link('module/parseimport', 'token=' . $this->session->data['token'], 'SSL');


		$this->template = 'module/parseimport.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
		$this->response->setOutput($this->render());
	}




	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/parseimport')) {
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