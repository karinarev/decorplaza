<?php
class ControllerCheckoutSuccess extends Controller { 
	public function index() { 	
		if (isset($this->session->data['order_id'])) {
			$this->load->model('checkout/order');
			$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);	 	
			$order_id = $order_info["order_id"];
			$price = $order_info["total"];
			$pr_p = 0;
			$ga = '';
			$yam = '';
			foreach ($this->cart->getProducts() as $product) {
				$pr_p = $pr_p + $product["price"];
				
				$ga .= "ga('ecommerce:addItem', {
  'id': '{$order_id}',
  'name': '{$product['name']}',
  'sku': '{$product['model']}',
  'category': '',
  'price': '{$product['price']}',
  'quantity': '{$product['quantity']}'
});";
			
			    $yam .= "{
          id: '{$product['model']}', 
          name: '{$product['name']}', 
          price: {$product['price']},
          quantity: {$product['quantity']}
        },";	
}	
			$del = $order_info["total"]-$pr_p;
			
			

			$this->data['elkom'] =  "
			<script type=\"text/javascript\">
			var yaParams = {
  order_id: '{$order_id}',
  order_price: {$price}, 
  currency: 'RUR',
  exchange_rate: 1,
  goods: 
     [
			{$yam}
      ]
};
yaCounter21796762.reachGoal('ORDER', yaParams);	

ga('require', 'ecommerce', 'ecommerce.js');
ga('ecommerce:addTransaction', {
  'id': '{$order_id}',
  'affiliation': '{$_SERVER['HTTP_HOST']}',
  'revenue': '{$price}',
  'shipping': '{$del}',
  'tax': ''
});
{$ga}
ga('ecommerce:send');
</script>";
			
			$this->cart->clear();

			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
			unset($this->session->data['payment_method']);
			unset($this->session->data['payment_methods']);
			unset($this->session->data['guest']);
			unset($this->session->data['comment']);
			unset($this->session->data['order_id']);	
			unset($this->session->data['coupon']);
			unset($this->session->data['reward']);
			unset($this->session->data['voucher']);
			unset($this->session->data['vouchers']);
		}	
									   
		$this->language->load('checkout/success');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->data['breadcrumbs'] = array(); 

      	$this->data['breadcrumbs'][] = array(
        	'href'      => $this->url->link('common/home'),
        	'text'      => $this->language->get('text_home'),
        	'separator' => false
      	); 
		
      	$this->data['breadcrumbs'][] = array(
        	'href'      => $this->url->link('checkout/cart'),
        	'text'      => $this->language->get('text_basket'),
        	'separator' => $this->language->get('text_separator')
      	);
				
		$this->data['breadcrumbs'][] = array(
			'href'      => $this->url->link('checkout/checkout', '', 'SSL'),
			'text'      => $this->language->get('text_checkout'),
			'separator' => $this->language->get('text_separator')
		);	
					
      	$this->data['breadcrumbs'][] = array(
        	'href'      => $this->url->link('checkout/success'),
        	'text'      => $this->language->get('text_success'),
        	'separator' => $this->language->get('text_separator')
      	);

		$this->data['heading_title'] = $this->language->get('heading_title');
		
		if ($this->customer->isLogged()) {
    		$this->data['text_message'] = sprintf($this->language->get('text_customer'), $this->url->link('account/account', '', 'SSL'), $this->url->link('account/order', '', 'SSL'), $this->url->link('account/download', '', 'SSL'), $this->url->link('information/contact'));
		} else {
    		$this->data['text_message'] = sprintf($this->language->get('text_guest'), $this->url->link('information/contact'));
		}
		
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
}
?>
