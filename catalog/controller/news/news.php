<?php  
class ControllerNewsNews extends Controller {
	public function index() {
		$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/news.css');

		$this->document->setTitle("Наши новости - ".$this->config->get('config_title'));
		//$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setDescription("Добро пожаловать на новостной раздел интернет магазина Decor-plaza.ru");
		

		$this->data['heading_title'] = $this->config->get('config_title');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/news/news.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/news/news.tpl';
		} else {
			$this->template = 'default/template/news/news.tpl';
		}
		
		$this->children = array(
			'common/column_left',
			'common/column_right',
			'common/content_top',
			'common/content_bottom',
			'common/footer',
			'common/header'
		);
										
		$this->response->setOutput($this->render());
	}
}
?>
