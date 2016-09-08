<?php
class ControllerDiscountDiscountcart extends Controller { 
	private $error = array(); 
	public function index() { 	
											   
		$this->language->load('discount/discountcart');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "coupon WHERE status=0 AND code = '" . $this->request->post['ncart'] . "'");
			if (count($query->row) > 0) {
				$query = $this->db->query("UPDATE " . DB_PREFIX . "coupon SET email='" . $this->request->post['email'] . "'  WHERE status=0 AND code = '" . $this->request->post['ncart'] . "'");
				
				$linkactive = $this->url->link('discount/discountcart/active').'&discounttoken='.md5($this->request->post['ncart'].';'.$this->request->post['email']).'&ncart='.$this->request->post['ncart'];
				
				$text = 'Добрый день, '.$this->request->post['family'].' '.$this->request->post['name'].' '.$this->request->post['otchestvo'].'! Для активации вашей дисконтной карты перейдите по ссылке: '.$linkactive;
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
				$mail->setSender('italy-sumochka');
				$mail->setSubject(html_entity_decode('Активация карты', ENT_QUOTES, 'UTF-8'));
				$mail->setText($text);
				$mail->send();
				header("Location:/index.php?route=discount/discountcart/success");
				
			}  else {
				$this->error['ncart'] = 'Неверный номер карты';
				
			}
		
		
		
		}
		
		$this->document->setTitle($this->language->get('heading_title'));
		$this->data['action'] = $this->url->link('discount/discountcart');
		$this->data['breadcrumbs'] = array(); 

      	$this->data['breadcrumbs'][] = array(
        	'href'      => $this->url->link('common/home'),
        	'text'      => $this->language->get('text_home'),
        	'separator' => false
      	); 
		
      	$this->data['breadcrumbs'][] = array(
        	'href'      => $this->url->link('discount/discountcart'),
        	'text'      => $this->language->get('heading_title'),
        	'separator' => $this->language->get('text_separator')
      	);
		if (isset($this->error['family'])) {
    		$this->data['error_family'] = $this->error['family'];
		} else {
			$this->data['error_family'] = '';
		}
		
		if (isset($this->error['name'])) {
    		$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = '';
		}
		
		if (isset($this->error['otchestvo'])) {
    		$this->data['error_otchestvo'] = $this->error['otchestvo'];
		} else {
			$this->data['error_otchestvo'] = '';
		}
		
		if (isset($this->error['email'])) {
			$this->data['error_email'] = $this->error['email'];
		} else {
			$this->data['error_email'] = '';
		}	
		if (isset($this->error['ncart'])) {
			$this->data['error_ncart'] = $this->error['ncart'];
		} else {
			$this->data['error_ncart'] = '';
		}

		
		if (isset($this->request->post['family'])) {
			$this->data['family'] = $this->request->post['family'];
		} 
		
		if (isset($this->request->post['name'])) {
			$this->data['name'] = $this->request->post['name'];
		} 
		
		if (isset($this->request->post['otchestvo'])) {
			$this->data['otchestvo'] = $this->request->post['otchestvo'];
		} 

		if (isset($this->request->post['email'])) {
			$this->data['email'] = $this->request->post['email'];
		} 
		
		if (isset($this->request->post['ncart'])) {
			$this->data['ncart'] = $this->request->post['ncart'];
		} 

		$this->data['heading_title'] = $this->language->get('heading_title');
		
		

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/discount/discountcart.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/discount/discountcart.tpl';
		} else {
			$this->template = 'default/template/discount/discountcart.tpl';
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
	
	public function active() { 
		if ((isset($this->request->get['discounttoken'])) && (isset($this->request->get['ncart']))) {
			$discounttoken = $this->request->get['discounttoken'];
			$ncart = $this->request->get['ncart'];
			
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "coupon WHERE status=0 AND code = '" . $ncart . "'");
			if (count($query->row) > 0) {
				$email = $query->row['email'];
				
				if (md5($ncart.';'.$email) == $discounttoken) {
					$query = $this->db->query("UPDATE " . DB_PREFIX . "coupon SET status=1  WHERE email='".$email."' AND code = '" . $ncart . "'");
					header("Location:/index.php?route=discount/discountcart/activesuccess");
				} else {
					header("Location:".$this->url->link('error/not_found'));
					
				}
			} else {
				header("Location:".$this->url->link('error/not_found'));
				
			}
			
		}
		
		
	}
	
	
	public function activesuccess() {
		$this->language->load('discount/discountcart');

		$this->document->setTitle('Дисконтная карта'); 

      	$this->data['breadcrumbs'] = array();

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
        	'separator' => false
      	);

      	$this->data['breadcrumbs'][] = array(
        	'text'      => 'Дисконтная карта',
			'href'      => $this->url->link('discount/discountcart'),
        	'separator' => $this->language->get('text_separator')
      	);	
		
    	$this->data['heading_title'] = 'Дисконтная карта';

    	$this->data['text_message'] = '<p>Ваша дисконтная карта активирована.</p>';

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
	
	
	public function success() {
		$this->language->load('discount/discountcart');

		$this->document->setTitle('Дисконтная карта'); 

      	$this->data['breadcrumbs'] = array();

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
        	'separator' => false
      	);

      	$this->data['breadcrumbs'][] = array(
        	'text'      => 'Дисконтная карта',
			'href'      => $this->url->link('discount/discountcart'),
        	'separator' => $this->language->get('text_separator')
      	);	
		
    	$this->data['heading_title'] = 'Дисконтная карта';

    	$this->data['text_message'] = '<p>Ваш запрос на активацию карты был принят!</p><p> На Ваш почтовый ящик выслано письмо с ссылкой активации.</p>';

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
	
	public function validate() {
	
    	if ((utf8_strlen($this->request->post['family']) < 3) || (utf8_strlen($this->request->post['family']) > 32)) {
			$this->error['family'] = $this->language->get('error_family');
    	}
		
		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 32)) {
			$this->error['name'] = $this->language->get('error_name');
    	}
		
		if ((utf8_strlen($this->request->post['otchestvo']) < 3) || (utf8_strlen($this->request->post['otchestvo']) > 32)) {
			$this->error['otchestvo'] = $this->language->get('error_otchestvo');
    	}

    	if (!$this->ocstore->validate($this->request->post['email'])) {
      		$this->error['email'] = $this->language->get('error_email');
    	}

    	if ((utf8_strlen($this->request->post['ncart']) < 3) || (utf8_strlen($this->request->post['ncart']) > 8)) {
      		$this->error['ncart'] = $this->language->get('error_ncart');
    	}

    	
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}  	  
  	}
}
?>
