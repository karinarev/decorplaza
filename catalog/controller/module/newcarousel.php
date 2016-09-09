<?php  
class ControllerModuleNewcarousel extends Controller {
	protected function index($setting) {
		static $module = 0;
		
		$this->load->model('design/banner');
		$this->load->model('tool/image');
		
		//$this->document->addScript('catalog/view/theme/' . $this->config->get('config_template') . '/js/sl/jquery.mobile.customized.min.js');
		//$this->document->addScript('catalog/view/theme/' . $this->config->get('config_template') . '/js/sl/camera.js');
		//$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/camera.css');

		$this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.carousel.css');
		$this->document->addScript('catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js');
		$this->document->addStyle('catalog/view/theme/theme331/stylesheet/newcarousel.css');
				
		$this->data['width'] = $setting['width'];
		$this->data['height'] = $setting['height'];
		
		$this->data['banners'] = array();
		
		if (isset($setting['banner_id'])) {
			$results = $this->model_design_banner->getBanner($setting['banner_id']);
			  
			foreach ($results as $result) {
				if (file_exists(DIR_IMAGE . $result['image'])) {
					$this->data['banners'][] = array(
						'title' => $result['title'],
						'second_title' => $result['second_title'],
						'third_title' => $result['third_title'],
						'link'  => $result['link'],
						'image' => $this->model_tool_image->getFullImage($result['image'])
					);
				}
			}
		}
		
		$this->data['module'] = $module++; 
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/newcarousel.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/newcarousel.tpl';
		} else {
			$this->template = 'default/template/module/newcarousel.tpl';
		}
		
		$this->render(); 
	}
}
/*   Created by Viva    */
?>
