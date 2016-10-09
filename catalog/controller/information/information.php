<?php 
class ControllerInformationInformation extends Controller {

private $error = array(); 

	public function index() {  
    	$this->language->load('information/information');
		$this->language->load('information/contact');
		
		$this->load->model('catalog/information');
		
		$this->data['breadcrumbs'] = array();
		
      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
        	'separator' => false
      	);
		
		if (isset($this->request->get['information_id'])) {
			$information_id = (int)$this->request->get['information_id'];
		} else {
			$information_id = 0;
		}
		
		$information_info = $this->model_catalog_information->getInformation($information_id);

		
		if ($this->validate()) {	
			
			/*
			[mode] => opt3
			[name] => Jenya Jenya Jenya
			[phone] => 998903458740
			[email] => 700102@mail.ru
			[city] => city
			[enquiry] => asdasd
			[captcha] => c66a29
			*/
			
			$text = '<p>Сообщение от с формы обратной связи Оптовиков.</p> <p>Имя - '.$this->request->post['name'].'.</p><p>Номер телефона - '.$this->request->post['phone'].'.</p> <p>Email - '.$this->request->post['email'].'.</p> <p>Город - '.$this->request->post['city'].'.</p> <p>Комментарии - '.$this->request->post['enquiry'].'.</p>';
			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->hostname = $this->config->get('config_smtp_host');
			$mail->username = $this->config->get('config_smtp_username');
			$mail->password = $this->config->get('config_smtp_password');
			$mail->port = $this->config->get('config_smtp_port');
			$mail->timeout = $this->config->get('config_smtp_timeout');				
			$mail->setTo($this->config->get('config_email'));
			if($this->request->post['email'])
			{
				$email = $this->request->post['email'];
			} else {
				$email = "info@decor-plaza.ru";
			}
			$mail->setFrom($email);
			$mail->setSender($this->request->post['name']);
			$mail->setSubject(html_entity_decode(sprintf($this->language->get('email_subject'), $this->request->post['name']), ENT_QUOTES, 'UTF-8'));
			$mail->setHtml($text);
			//$mail->setText(html_entity_decode($text, ENT_QUOTES, 'UTF-8'));
			$mail->send();
	
			$this->redirect($this->url->link('information/contact/success'));
		}
   		
		if ($information_info) {

			$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/information.css');

			$this->language->load('information/contact');
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
			
			if (isset($this->error['phone'])) {
				$this->data['error_phone'] = 'Введите свой номер телефона';
			} else {
				$this->data['error_phone'] = '';
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
			if (isset($this->request->post['phone'])) {
				$this->data['phone'] = $this->request->post['phone'];
			} else {
				$this->data['phone'] = $this->customer->getTelephone();
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
		
			if ($information_info['seo_title']) {
				$this->document->setTitle($information_info['seo_title']);
			} else {
				$this->document->setTitle($information_info['title']);
			}
			$this->document->setDescription($information_info['meta_description']);
			$this->document->setKeywords($information_info['meta_keyword']);
			
      		$this->data['breadcrumbs'][] = array(
        		'text'      => $information_info['title'],
				'href'      => $this->url->link('information/information', 'information_id=' .  $information_id),      		
        		'separator' => $this->language->get('text_separator')
      		);		
						
			if ($information_info['seo_h1']) {
				$this->data['heading_title'] = $information_info['seo_h1'];
			} else {
				$this->data['heading_title'] = $information_info['title'];
			}
      		
      		$this->data['button_continue'] = $this->language->get('button_continue');
			
			$this->data['description'] = html_entity_decode($information_info['description'], ENT_QUOTES, 'UTF-8');
      		
			$this->data['continue'] = $this->url->link('common/home');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/information.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/information/information.tpl';
			} else {
				$this->template = 'default/template/information/information.tpl';
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
    	} else {
      		$this->data['breadcrumbs'][] = array(
        		'text'      => $this->language->get('text_error'),
				'href'      => $this->url->link('information/information', 'information_id=' . $information_id),
        		'separator' => $this->language->get('text_separator')
      		);
				
	  		$this->document->setTitle($this->language->get('text_error'));
			
      		$this->data['heading_title'] = $this->language->get('text_error');

      		$this->data['text_error'] = $this->language->get('text_error');

      		$this->data['button_continue'] = $this->language->get('button_continue');

      		$this->data['continue'] = $this->url->link('common/home');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/error/not_found.tpl';
			} else {
				$this->template = 'default/template/error/not_found.tpl';
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
	
	public function info() {
		$this->load->model('catalog/information');
		
		if (isset($this->request->get['information_id'])) {
			$information_id = (int)$this->request->get['information_id'];
		} else {
			$information_id = 0;
		}      
		
		$information_info = $this->model_catalog_information->getInformation($information_id);

		if ($information_info) {
			$output  = '<html dir="ltr" lang="en">' . "\n";
			$output .= '<head>' . "\n";
			$output .= '  <title>' . $information_info['title'] . '</title>' . "\n";
			$output .= '  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">' . "\n";
			$output .= '  <meta name="robots" content="noindex">' . "\n";
			$output .= '</head>' . "\n";
			$output .= '<body>' . "\n";
			$output .= '  <h1>' . $information_info['title'] . '</h1>' . "\n";
			$output .= html_entity_decode($information_info['description'], ENT_QUOTES, 'UTF-8') . "\n";
			$output .= '  </body>' . "\n";
			$output .= '</html>' . "\n";			

			$this->response->setOutput($output);
		}
	}

	protected function validate() {
		
    	if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 32)) {
      		$this->error['name'] = $this->language->get('error_name');
    	}

    	if (utf8_strlen($this->request->post['phone']) < 7) {
    		
      		$this->error['phone'] = $this->language->get('error_phone');
    	}

    	if (($this->request->post['captcha'])) {
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
	}
?>
