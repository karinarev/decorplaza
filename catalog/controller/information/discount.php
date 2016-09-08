<?php 
class ControllerInformationDiscount extends Controller {
	private $error = array(); 
	    
  	public function index() {
		$this->language->load('information/contact');
		$this->load->model('catalog/information');
	 
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
		
			$is_email = $this->model_catalog_information->getEmail($this->request->post['email']);
			
			if(!$is_email) {
			
				$code = $this->mt_rand_str(10);
				
					$data = array(
						'code' => $code,
						'name' => '5% скидка',
						'type' => 'P',
						'discount' => $this->config->get('config_discount_form'),
						'logged' => 0,
						'shipping' => 0,
						'total' => 0,
						'uses_total' => 1,
						'uses_customer' => 1,
						'status' => 1,
						'email' => $this->request->post['email']				
					);
					
				//$this->model_catalog_information->addVoucher($data);
				$this->model_catalog_information->addCoupon($data);
				
				$text = '<p>Добрый день, '.$this->request->post['name'].'!</p> <p>Поздравляем!</p> <p>Вы получили одноразовую скидку '.$this->config->get('config_discount_form').'% на все товары в магазине italy-sumochka. Введите этот промо-код <b>'.$code.'</b> в специальное поле «Купон» при оформлении заказа в корзине, и скидка будет рассчитана автоматически</p>';
			
			
				$mail = new Mail();
				$mail->protocol = $this->config->get('config_mail_protocol');
				$mail->parameter = $this->config->get('config_mail_parameter');
				$mail->hostname = $this->config->get('config_smtp_host');
				$mail->username = $this->config->get('config_smtp_username');
				$mail->password = $this->config->get('config_smtp_password');
				$mail->port = $this->config->get('config_smtp_port');
				$mail->timeout = $this->config->get('config_smtp_timeout');				
				$mail->setTo($this->request->post['email']);
				$mail->setFrom($this->config->get('config_email'));
				$mail->setSender($this->request->post['name']);
				$mail->setSubject(html_entity_decode('Получение скидки', ENT_QUOTES, 'UTF-8'));
				$mail->setText(strip_tags(html_entity_decode($text, ENT_QUOTES, 'UTF-8')));
				$mail->send();
				
				$text = '<p>Пользователь '.$this->request->post['name'].' ('.$this->request->post['email'].') получил одноразовую скидку в '.$this->config->get('config_discount_form').'% на все товары в магазине italy-sumochka.</p>';
				$mail = new Mail();
				$mail->protocol = $this->config->get('config_mail_protocol');
				$mail->parameter = $this->config->get('config_mail_parameter');
				$mail->hostname = $this->config->get('config_smtp_host');
				$mail->username = $this->config->get('config_smtp_username');
				$mail->password = $this->config->get('config_smtp_password');
				$mail->port = $this->config->get('config_smtp_port');
				$mail->timeout = $this->config->get('config_smtp_timeout');				
				$mail->setTo($this->config->get('config_email'));
				$mail->setFrom($this->config->get('config_email'));
				$mail->setSender($this->request->post['name']);
				$mail->setSubject(html_entity_decode('Получение скидки', ENT_QUOTES, 'UTF-8'));
				$mail->setHtml(strip_tags(html_entity_decode($text, ENT_QUOTES, 'UTF-8')));
				$mail->send();

				$this->redirect($this->url->link('information/discount/success'));
			
			} else {			
				 $this->data['errorEmail'] = 'Данный email уже зарегестрирован в системе';
			}	
    	}
		
		$information_info = $this->model_catalog_information->getInformation(9);
		
		if ($information_info) {
			if ($information_info['seo_title']) {
				$this->document->setTitle($information_info['seo_title']);
			} else {
				$this->document->setTitle($information_info['title']);
			}
			$this->document->setDescription($information_info['meta_description']);
			$this->document->setKeywords($information_info['meta_keyword']);
									
			if ($information_info['seo_h1']) {
				$this->data['heading_title'] = $information_info['seo_h1'];
			} else {
				$this->data['heading_title'] = $information_info['title'];
			}
			
			$this->data['description'] = html_entity_decode($information_info['description'], ENT_QUOTES, 'UTF-8');
			
		}

      	$this->data['breadcrumbs'] = array();

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),        	
        	'separator' => false
      	);

      	$this->data['breadcrumbs'][] = array(
        	'text'      => 'Получить скидку',
			'href'      => $this->url->link('information/discount'),
        	'separator' => $this->language->get('text_separator')
      	);	
			
    	$this->data['text_location'] = $this->language->get('text_location');
		$this->data['text_contact'] = $this->language->get('text_contact');
		$this->data['text_address'] = $this->language->get('text_address');
    	$this->data['text_telephone'] = $this->language->get('text_telephone');
    	$this->data['text_fax'] = $this->language->get('text_fax');

    	$this->data['entry_name'] = $this->language->get('entry_name');
    	$this->data['entry_email'] = $this->language->get('entry_email');
    	$this->data['entry_enquiry'] = $this->language->get('entry_enquiry');
		$this->data['entry_captcha'] = $this->language->get('entry_captcha');

		if (isset($this->error['name'])) {
    		$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = '';
		}
		
		if (isset($this->error['email'])) {
			$this->data['error_email'] = $this->error['email'];
		} else {
			$this->data['error_email'] = '';
		}		
		
		if (isset($this->error['enquiry'])) {
			$this->data['error_enquiry'] = $this->error['enquiry'];
		} else {
			$this->data['error_enquiry'] = '';
		}		
		
 		if (isset($this->error['captcha'])) {
			$this->data['error_captcha'] = $this->error['captcha'];
		} else {
			$this->data['error_captcha'] = '';
		}	

    	$this->data['button_continue'] = $this->language->get('button_continue');
    
		$this->data['action'] = $this->url->link('information/discount');
		$this->data['store'] = $this->config->get('config_name');
    	$this->data['address'] = nl2br($this->config->get('config_address'));
    	$this->data['telephone'] = $this->config->get('config_telephone');
		$this->data['telephone2'] = $this->config->get('config_telephone2');
    	$this->data['fax'] = $this->config->get('config_fax');
    	
		if (isset($this->request->post['name'])) {
			$this->data['name'] = $this->request->post['name'];
		} else {
			$this->data['name'] = $this->customer->getFirstName();
		}

		if (isset($this->request->post['email'])) {
			$this->data['email'] = $this->request->post['email'];
		} else {
			$this->data['email'] = $this->customer->getEmail();
		}
		
		if (isset($this->request->post['enquiry'])) {
			$this->data['enquiry'] = $this->request->post['enquiry'];
		} else {
			$this->data['enquiry'] = '';
		}
		
		if (isset($this->request->post['captcha'])) {
			$this->data['captcha'] = $this->request->post['captcha'];
		} else {
			$this->data['captcha'] = '';
		}		

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/discount.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/information/discount.tpl';
		} else {
			$this->template = 'default/template/information/discount.tpl';
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

  	public function success() {
		$this->language->load('information/contact');

		$this->document->setTitle('Получить скидку'); 

      	$this->data['breadcrumbs'] = array();

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
        	'separator' => false
      	);

      	$this->data['breadcrumbs'][] = array(
        	'text'      => 'Получить скидку',
			'href'      => $this->url->link('information/discount'),
        	'separator' => $this->language->get('text_separator')
      	);	
		
    	$this->data['heading_title'] = 'Получить скидку';

    	$this->data['text_message'] = '<p>Ваш запрос был успешно отправлен администрации магазина!</p><p> На Ваш почтовый ящик выслано письмо с информацией о получении скидки</p>';

    	$this->data['button_continue'] = $this->language->get('button_continue');

    	$this->data['continue'] = $this->url->link('common/home');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/success.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/success.tpl';
		} else {
			$this->template = 'default/template/common/success.tpl';
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
	
  	protected function validate() {
    	if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 32)) {
      		$this->error['name'] = $this->language->get('error_name');
    	}

    	if (!$this->ocstore->validate($this->request->post['email'])) {
      		$this->error['email'] = $this->language->get('error_email');
    	}

    	if ((utf8_strlen($this->request->post['enquiry']) < 10) || (utf8_strlen($this->request->post['enquiry']) > 3000)) {
      		$this->error['enquiry'] = $this->language->get('error_enquiry');
    	}

    	if (empty($this->session->data['captcha']) || ($this->session->data['captcha'] != $this->request->post['captcha'])) {
      		$this->error['captcha'] = $this->language->get('error_captcha');
    	}
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}  	  
  	}

	public function captcha() {
		$this->load->library('captcha');
		
		$captcha = new Captcha();
		
		$this->session->data['captcha'] = $captcha->getCode();
		
		$captcha->showImage();
	}	
	
	public function mt_rand_str ($l, $c = 'abcdefghijklmnopqrstuvwxyz1234567890') {
    for ($s = '', $cl = strlen($c)-1, $i = 0; $i < $l; $s .= $c[mt_rand(0, $cl)], ++$i);
    return $s;
}
}
?>
