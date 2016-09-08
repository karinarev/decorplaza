<?php
require_once( DIR_SYSTEM . "/engine/soforp_controller.php");
class ControllerModuleSoforpRedirectManager extends SoforpController {
	private $error = array();

    public function __construct($registry) {
        $this->registry = $registry;
        $this->_moduleName = "SOFORP Redirect Manager";
    }

	public function index() {
        $this->initLanguage('module/soforp_redirect_manager');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('soforp_redirect_manager', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

        $this->initBreadcrumbs(array(
            array("extension/module","text_module"),
            array("module/soforp_redirect_manager","heading_title")
        ));

		$this->data['action'] = $this->url->link('module/soforp_redirect_manager', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

        $this->initParams(array(
            array( "soforp_redirect_manager_status", 1 ),
            array( "soforp_redirect_manager_debug", 0 ),
        ));

		$this->template = 'module/soforp_redirect_manager.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

    public function install(){
        $this->load->model("module/soforp_redirect_manager");
        $this->model_module_soforp_redirect_manager->install();
    }

    public function uninstall(){
    }

	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/soforp_redirect_manager')) {
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