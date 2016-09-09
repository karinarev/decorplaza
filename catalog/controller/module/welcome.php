<?php  
class ControllerModuleWelcome extends Controller {
	protected function index($setting) {

		$this->language->load('module/welcome');

		if (file_exists('catalog/view/theme/theme331/stylesheet/welcome.css')) {
			$this->document->addStyle('catalog/view/theme/theme331/stylesheet/welcome.css');
		} else {
			$this->document->addStyle('catalog/view/theme/default/stylesheet/welcome.css');
		}
		
    	$this->data['heading_title'] = sprintf($this->language->get('heading_title'), $this->config->get('config_name'));

		$this->data['first'] = $setting['first-title'][$this->config->get('config_language_id')];
		$this->data['second'] = $setting['second-title'][$this->config->get('config_language_id')];
		$this->data['message'] = html_entity_decode($setting['description'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/welcome.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/welcome.tpl';
		} else {
			$this->template = 'default/template/module/welcome.tpl';
		}
		
		$this->render();
	}
}
?>
