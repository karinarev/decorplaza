<?php
// News Module for Opencart v1.5.5, modified by villagedefrance (contact@villagedefrance.net)

class ControllerModuleNews extends Controller {

	private $_name = 'news';

	protected function index($setting) {
		static $module = 0;
	
		$this->language->load('module/' . $this->_name);
	
      	$this->data['heading_title'] = $this->language->get('heading_title');
	
		$this->load->model('localisation/language');
	
		$languages = $this->model_localisation_language->getLanguages();
	
		$this->data['customtitle'] = $this->config->get($this->_name . '_customtitle' . $this->config->get('config_language_id'));
		$this->data['header'] = $this->config->get($this->_name . '_header');
	
		if (!$this->data['customtitle']) { $this->data['customtitle'] = $this->data['heading_title']; } 
		if (!$this->data['header']) { $this->data['customtitle'] = ''; }
	
		$this->data['icon'] = $this->config->get($this->_name . '_icon');
		$this->data['box'] = $this->config->get($this->_name . '_box');

		$this->document->addStyle('catalog/view/theme/theme331/stylesheet/news.css');
	
		$this->load->model('catalog/news');
	
		$this->data['text_more'] = $this->language->get('text_more');
		$this->data['text_posted'] = $this->language->get('text_posted');
	
		$this->data['show_headline'] = $this->config->get($this->_name . '_headline_module');
	
		$this->data['news_count'] = $this->model_catalog_news->getTotalNews();
		
		$this->data['news_limit'] = $setting['limit'];
	
		if ($this->data['news_count'] > $this->data['news_limit']) { $this->data['showbutton'] = true; } else { $this->data['showbutton'] = false; }
	
		$this->data['buttonlist'] = $this->language->get('buttonlist');
	
		$this->data['newslist'] = $this->url->link('information/news');
		
		$this->data['numchars'] = $setting['numchars'];
		
		if (isset($this->data['numchars'])) { $chars = $this->data['numchars']; } else { $chars = 100; }
		
		$this->data['news'] = array();
	
		$results = $this->model_catalog_news->getNewsShorts($setting['limit']);
		
		$this->load->model('tool/image');
	
		foreach ($results as $result) {

			//var_dump($result['image']); die();

			
			if ($result['image']) {
 				$image = $this->model_tool_image->getFullImage($result['image']);
 			} else {
				$noimage = str_replace('index.php?route=', '', $this->url->link('image/noimage.png'));
				$image = $noimage;

 			}

			//var_dump($result['image']); die();

			$date = date($this->language->get('date_format_short'), strtotime($result['date_added']));
			$posted = explode(".", $date);
			switch ($posted[1]){
				case 1: $m='января'; break;
				case 2: $m='февраля'; break;
				case 3: $m='марта'; break;
				case 4: $m='апреля'; break;
				case 5: $m='мая'; break;
				case 6: $m='июня'; break;
				case 7: $m='июля'; break;
				case 8: $m='августа'; break;
				case 9: $m='сентября'; break;
				case 10: $m='октября'; break;
				case 11: $m='ноября'; break;
				case 12: $m='декабря'; break;
			}
			$posted = $posted[0]." ".$m." ".$posted[2];

			if(strlen($result['title']) >= 54) $description_length = 90;
			else $description_length = 180;
			
			$this->data['news'][] = array(
				'title'        		=> $result['title'],
				'description'  		=> utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $description_length) . "...",
				'href'         		=> $this->url->link('information/news', 'news_id=' . $result['news_id']),
				'thumb' 			=> $image,
				'posted'   			=> $posted
			);
		}
	
		$this->data['module'] = $module++;

		//var_dump(strlen("Миллер против Камоэса, Волкер")); die();
	
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/' . $this->_name . '.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/' . $this->_name . '.tpl';
		} else {
			$this->template = $this->config->get('config_template') . '/template/module/' . $this->_name . '.tpl';
		}
	
		$this->render();
	}
}
?>
