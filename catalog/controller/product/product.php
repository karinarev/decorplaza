<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
class ControllerProductProduct extends Controller {
	private $error = array();
	
	public function index() {
		$this->language->load('product/product');

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),			
			'separator' => false
		);
		
		$this->load->model('catalog/category');	
		
		if (isset($this->request->get['path'])) {
			$path = '';
			
			$parts = explode('_', (string)$this->request->get['path']);
			
			$category_id = (int)array_pop($parts);
				
			foreach ($parts as $path_id) {
				if (!$path) {
					$path = $path_id;
				} else {
					$path .= '_' . $path_id;
				}
				
				$category_info = $this->model_catalog_category->getCategory($path_id);
				
				if ($category_info) {
					$this->data['breadcrumbs'][] = array(
						'text'      => $category_info['name'],
						'href'      => $this->url->link('product/category', 'path=' . $path),
						'separator' => ''
					);
				}
			}
			
			// Set the last category breadcrumb
			
			$category_info = $this->model_catalog_category->getCategory($category_id);
				
			if ($category_info) {			
				$url = '';
				
				if($category_info['image_size']) {
					$this->data['image_thumb'] =  $category_info['image_size'];
				} else {
					$this->data['image_thumb'] =  '';
				}
				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}	
	
				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}	
				
				if (isset($this->request->get['page'])) {
					$url .= '&page=' . $this->request->get['page'];
				}
				
				if (isset($this->request->get['limit'])) {
					$url .= '&limit=' . $this->request->get['limit'];
				}
										
				$this->data['breadcrumbs'][] = array(
					'text'      => $category_info['name'],
					'href'      => $this->url->link('product/category', 'path=' . $this->request->get['path']),
					'separator' => $this->language->get('text_separator')
				);
			}
		}

		if (isset($this->request->get['product_id'])) {
			$product_id = (int)$this->request->get['product_id'];
		} else {
			$product_id = 0;
		}

		$data['query'] =

		$this->load->model('catalog/product');
		

		$product_info = $this->model_catalog_product->getProduct($product_id);

		$this->load->model('catalog/manufacturer');

		$this->data['breadcrumbs'][] = array(
			'text'     => $product_info['manufacturer'],
			'href'     => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $product_info['manufacturer_id']),
			'separator' => $this->language->get('text_separator')
		);

		if (isset($this->request->get['manufacturer_id'])) {
			$this->data['breadcrumbs'][] = array( 
				'text'      => $this->language->get('text_brand'),
				'href'      => $this->url->link('product/manufacturer'),
				'separator' => $this->language->get('text_separator')
			);	
	
			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}	

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}	
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
						
			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}
							
			$manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($this->request->get['manufacturer_id']);

			if ($manufacturer_info) {	
				$this->data['breadcrumbs'][] = array(
					'text'	    => $manufacturer_info['name'],
					'href'	    => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . $url),					
					'separator' => $this->language->get('text_separator')
				);
			}
		}
		
		if (isset($this->request->get['search']) || isset($this->request->get['tag'])) {
			$url = '';
			
			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
			}
						
			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . $this->request->get['tag'];
			}
						
			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}
			
			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}	

			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}	

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
						
			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}
												
			$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('text_search'),
				'href'      => $this->url->link('product/search', $url),
				'separator' => $this->language->get('text_separator')
			); 	
		}
		


		
		if ($product_info) {
			$url = '';
			
			if (isset($this->request->get['path'])) {
				$url .= '&path=' . $this->request->get['path'];
			}
						
			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}
						
			if (isset($this->request->get['manufacturer_id'])) {
				$url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
			}			

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
			}
						
			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . $this->request->get['tag'];
			}
			
			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}	
						
			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}
			
			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
			}	
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}	

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}	
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
						
			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}
																		
			$this->data['breadcrumbs'][] = array(
				'text'      => $product_info['name'],
				'href'      => $this->url->link('product/product', $url . '&product_id=' . $this->request->get['product_id']),
				'separator' => $this->language->get('text_separator')
			);			
			
			
			if ((float)$product_info['special']) {
				$price = number_format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')),0, ".", " ");
				$price_nomber = $this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax'));
			} else {
				$price = number_format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')),0, ".", " ");
				$price_nomber = $this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax'));
			}

			
			$data = array(
					'filter_category_id' => $category_info['category_id']
				);
			$products_analog = $this->model_catalog_product->getProducts($data);
			/*echo '<!--**';
				print_r($products_analog);
			echo '-->';*/
			
			$this->load->model('tool/image');
			$porg = $this->config->get('analogproducts_pogr');
			$razm = 4;
			$products_analog_arr= array();
			$w=0;
			foreach ($products_analog as $product_analog) {
				if ((float)$product_analog['special']) {
					$price_analog_nomber = $this->tax->calculate($product_analog['special'], $product_analog['tax_class_id'], $this->config->get('config_tax'));
				} else {
					$price_analog_nomber = $this->tax->calculate($product_analog['price'], $product_analog['tax_class_id'], $this->config->get('config_tax'));
				}
				if (($price_analog_nomber >= ($price_nomber-$porg)) and ($price_analog_nomber <= ($price_nomber+$porg)) and ($product_analog['product_id']!=$product_id)) {
					$products_analog_arr[$w]['price'] = number_format($price_analog_nomber,0, ".", " ");
					//$products_analog_arr[$w]['image'] = $product_analog['image'];
					if ($product_analog['image']) {
						$products_analog_arr[$w]['image'] = $this->model_tool_image->resize($product_analog['image'], $this->config->get('config_image_related_width'), $this->config->get('config_image_related_height'));
						$this->document->setOgImage($products_analog_arr[$w]['image']);
					} else {
						$products_analog_arr[$w]['image'] = $this->model_tool_image->resize('no_image.jpg', $this->config->get('config_image_related_width'), $this->config->get('config_image_related_height'));
					}
					$products_analog_arr[$w]['name'] = $product_analog['name'];
					$products_analog_arr[$w]['product_id'] = $product_analog['product_id'];
					$products_analog_arr[$w]['url'] = $this->url->link('product/product&product_id=' . $product_analog['product_id']);
					//$products_analog_arr[$w]['options'] = $product_analog['options'];

					/****/
					
			foreach ($this->model_catalog_product->getProductOptions($product_analog['product_id']) as $analog_option) { 
				/*echo '<!--**995';
				print_r($analog_option);
				
				echo '-->'; */
				if ($analog_option['type'] == 'select' || $analog_option['type'] == 'radio' || $analog_option['type'] == 'checkbox' || $analog_option['type'] == 'image') { 
					$option_value_data_analog = array();
					
					foreach ($analog_option['option_value'] as $option_value) {
						if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
							if ((($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) && (float)$option_value['price']) {
								$price = $this->currency->format($this->tax->calculate($option_value['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
							} else {
								$price = false;
							}
							
							$option_value_data_analog[] = array(
								'product_option_value_id' => $option_value['product_option_value_id'],
								'option_value_id'         => $option_value['option_value_id'],
								'name'                    => $option_value['name'],
								'image'                   => $this->model_tool_image->resize($option_value['image'], 50, 50),
								'price'                   => $price,
								'price_prefix'            => $option_value['price_prefix']
							);
						}
					}

					$analog_options[] = array(
						'product_option_id' => $analog_option['product_option_id'],
						'option_id'         => $analog_option['option_id'],
						'name'              => $analog_option['name'],
						'type'              => $analog_option['type'],
						'option_value'      => $option_value_data_analog,
						'required'          => $analog_option['required']
					);					
				} elseif ($analog_option['type'] == 'text' || $analog_option['type'] == 'textarea' || $analog_option['type'] == 'file' || $analog_option['type'] == 'date' || $analog_option['type'] == 'datetime' || $analog_option['type'] == 'time') {
					$options[] = array(
						'product_option_id' => $analog_option['product_option_id'],
						'option_id'         => $analog_option['option_id'],
						'name'              => $analog_option['name'],
						'type'              => $analog_option['type'],
						'option_value'      => $analog_option['option_value'],
						'required'          => $analog_option['required']
					);						
				}
			}
					$products_analog_arr[$w]['product_option_id'] = $analog_option['product_option_id'];
					$products_analog_arr[$w]['option_id'] = $analog_option['option_id'];					
					$products_analog_arr[$w]['type'] = $analog_option['type'];
					//$products_analog_arr[$w]['name'] = $analog_option['name'];
					$products_analog_arr[$w]['option_value'] = $analog_option['option_value'];
					$products_analog_arr[$w]['required'] = $analog_option['required'];
					/***/					
					
					
					
				}
				$w++;
			}

			$products_analog = array();
			if (count($products_analog_arr) > $razm) {
				
				for ($q=0;$q<$razm;$q++) {
					$ar_id = array_rand($products_analog_arr);
					$products_analog[$q] = $products_analog_arr[$ar_id];
					unset($products_analog_arr[$ar_id]);
				}
			} else { 
				$products_analog = $products_analog_arr;
			} 
			
			$this->data['products_analog'] = $products_analog;
			
			require_once(DIR_SYSTEM."library/ipgeobase/ipgeobase.php");
			$gb = new IPGeoBase();
			$data = $gb->getRecord($_SERVER["REMOTE_ADDR"]);
		
			if ($data) {
				$city = $data['city'];
				
				
				if ($data['cc'] == 'RU') {
					$cityforms = $this->model_catalog_product->getCityForms($city);
					$cityformpred = $cityforms['prepositionalCase'];
				} else {
					$cityformpred = "Москве";
				}
				
			} else {
				$cityformpred = "Москве";
			}
			
			if ($product_info['seo_title']) {
				$this->document->setTitle($product_info['seo_title']);
			} else {
				$this->document->setTitle($product_info['name']." - Купить недорого в " .$cityformpred. " - italy-sumochka");
			}
			
			if ($product_info['seo_h1']) {
				$this->data['heading_title'] = $product_info['seo_h1'];
			} else {
				$this->data['heading_title'] = $product_info['name'];
			}
			
			if ($product_info['meta_description']) {
				$this->document->setDescription($product_info['meta_description']);
			} else {
				$this->document->setDescription("Заказывайте ".$category_info['namev']." ".$product_info['manufacturer']." - ".htmlspecialchars($product_info['name'])." в интернет магазине italy-sumochka. Самые выгодные условия, цены и доставка по всей России");
			}

			
			$this->document->setKeywords($product_info['meta_keyword']);
			$this->document->addLink($this->url->link('product/product', 'product_id=' . $this->request->get['product_id']), 'canonical');
			
			
			//$this->data['qwe'] = $product_info[];

			$this->data['text_select'] = $this->language->get('text_select');
			$this->data['text_manufacturer'] = $this->language->get('text_manufacturer');
			$this->data['text_model'] = $this->language->get('text_model');
			$this->data['text_reward'] = $this->language->get('text_reward');
			$this->data['text_points'] = $this->language->get('text_points');	
			$this->data['text_discount'] = $this->language->get('text_discount');
			$this->data['text_stock'] = $this->language->get('text_stock');
			$this->data['text_price'] = $this->language->get('text_price');
			$this->data['text_tax'] = $this->language->get('text_tax');
			$this->data['text_discount'] = $this->language->get('text_discount');
			$this->data['text_option'] = $this->language->get('text_option');
			$this->data['text_qty'] = $this->language->get('text_qty');
			$this->data['text_minimum'] = sprintf($this->language->get('text_minimum'), $product_info['minimum']);
			$this->data['text_or'] = $this->language->get('text_or');
			$this->data['text_write'] = $this->language->get('text_write');
			$this->data['text_note'] = $this->language->get('text_note');
			$this->data['text_share'] = $this->language->get('text_share');
			$this->data['text_wait'] = $this->language->get('text_wait');
			$this->data['text_tags'] = $this->language->get('text_tags');


			$this->data['entry_name'] = $this->language->get('entry_name');
			$this->data['entry_review'] = $this->language->get('entry_review');
			$this->data['entry_rating'] = $this->language->get('entry_rating');
			$this->data['entry_good'] = $this->language->get('entry_good');
			$this->data['entry_bad'] = $this->language->get('entry_bad');
			$this->data['entry_captcha'] = $this->language->get('entry_captcha');
			
			$this->data['button_cart'] = $this->language->get('button_cart');
			$this->data['button_wishlist'] = $this->language->get('button_wishlist');
			$this->data['button_compare'] = $this->language->get('button_compare');			
			$this->data['button_upload'] = $this->language->get('button_upload');
			$this->data['button_continue'] = $this->language->get('button_continue');
			
			$this->load->model('catalog/review');

			$this->data['tab_description'] = $this->language->get('tab_description');
			$this->data['tab_attribute'] = $this->language->get('tab_attribute');
			$this->data['tab_review'] = sprintf($this->language->get('tab_review'), $product_info['reviews']);
			$this->data['tab_related'] = $this->language->get('tab_related');
			
			$this->data['product_id'] = $this->request->get['product_id'];
			$this->data['manufacturer'] = $product_info['manufacturer'];
			$this->data['manufacturers'] = $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $product_info['manufacturer_id']);
			$this->data['model'] = $product_info['model'];
			$this->data['reward'] = $product_info['reward'];
			$this->data['points'] = $product_info['points'];
			$this->data['quantity'] = $product_info['quantity'];
			if ($product_info['video'])
				$this->data['video'] = $product_info['video'];
			if ($product_info['video_description'])
				$this->data['video_description'] = $product_info['video_description'];


			if (($product_info['source'] == 'tsp-shop') || ($product_info['source'] == 'combatmarkt') || ($product_info['stock_status_id'] == 8)) {
				$this->data['stock'] = "Предзаказ";
			}
			
			else {
				if ($product_info['quantity'] <= 0) {
				$this->data['stock'] = $product_info['stock_status'];
				} elseif ($this->config->get('config_stock_display')) {
					$this->data['stock'] = $product_info['quantity'];
				} else {
					if($product_info["stock_status"] == "Ожидание 2-3 дня") {
						$this->data['stock'] = 'Ожидание 2-3 дня';
					} else {			
					
					$this->data['stock'] = $this->language->get('text_instock');
					}
				}
			}
			
			
			$this->load->model('tool/image');

			if ($product_info['image']) {
				$this->data['popup'] = $this->model_tool_image->resize($product_info['image'], $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height'));
			} else {
				$this->data['popup'] = $this->model_tool_image->resize('no_image.jpg', $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height'));
			}
			
			if ($product_info['image']) {
				$this->data['thumb'] = $this->model_tool_image->resize($product_info['image'], $this->config->get('config_image_thumb_width'), $this->config->get('config_image_thumb_height'));
				$this->document->setOgImage($this->data['thumb']);
			} else {
				$this->data['thumb'] = $this->model_tool_image->resize('no_image.jpg', $this->config->get('config_image_thumb_width'), $this->config->get('config_image_thumb_height'));
			}
			
			$this->data['images'] = array();
			
			$results = $this->model_catalog_product->getProductImages($this->request->get['product_id']);
			
			foreach ($results as $result) {
				$this->data['images'][] = array(
					'popup' => $this->model_tool_image->resize($result['image'], $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height')),
					'thumb' => $this->model_tool_image->resize($result['image'], $this->config->get('config_image_additional_width'), $this->config->get('config_image_additional_height'))
				);
			}	
						
			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$this->data['price'] = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
			} else {
				$this->data['price'] = false;
			}
						
			if ((float)$product_info['special']) {
				$this->data['special'] = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
			} else {
				$this->data['special'] = false;
			}
			
			if ($this->config->get('config_tax')) {
				$this->data['tax'] = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price']);
			} else {
				$this->data['tax'] = false;
			}
			
			$discounts = $this->model_catalog_product->getProductDiscounts($this->request->get['product_id']);
			
			$this->data['discounts'] = array(); 
			
			foreach ($discounts as $discount) {
				$this->data['discounts'][] = array(
					'quantity' => $discount['quantity'],
					'price'    => $this->currency->format($this->tax->calculate($discount['price'], $product_info['tax_class_id'], $this->config->get('config_tax')))
				);
			}
			
			$this->data['options'] = array();

			foreach ($this->model_catalog_product->getProductOptions($this->request->get['product_id']) as $option) { 
				if ($option['type'] == 'select' || $option['type'] == 'radio' || $option['type'] == 'checkbox' || $option['type'] == 'image') { 
					$option_value_data = array();
					
					foreach ($option['option_value'] as $option_value) {
						if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
							if ((($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) && (float)$option_value['price']) {
								$price = $this->currency->format($this->tax->calculate($option_value['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
							} else {
								$price = false;
							}
							
							$option_value_data[] = array(
								'product_option_value_id' => $option_value['product_option_value_id'],
								'option_value_id'         => $option_value['option_value_id'],
								'name'                    => $option_value['name'],
								'image'                   => $this->model_tool_image->resize($option_value['image'], 50, 50),
								'price'                   => $price,
								'price_prefix'            => $option_value['price_prefix']
							);
						}
					}
					
					$this->data['options'][] = array(
						'product_option_id' => $option['product_option_id'],
						'option_id'         => $option['option_id'],
						'name'              => $option['name'],
						'type'              => $option['type'],
						'option_value'      => $option_value_data,
						'required'          => $option['required']
					);					
				} elseif ($option['type'] == 'text' || $option['type'] == 'textarea' || $option['type'] == 'file' || $option['type'] == 'date' || $option['type'] == 'datetime' || $option['type'] == 'time') {
					$this->data['options'][] = array(
						'product_option_id' => $option['product_option_id'],
						'option_id'         => $option['option_id'],
						'name'              => $option['name'],
						'type'              => $option['type'],
						'option_value'      => $option['option_value'],
						'required'          => $option['required']
					);						
				}
			}

			if ($product_info['minimum']) {
				$this->data['minimum'] = $product_info['minimum'];
			} else {
				$this->data['minimum'] = 1;
			}
			
			if($product_info['newItem']){
				$this->data['newItem'] = $product_info['newItem'];
			}else{
				$this->data['newItem'] = false;
			}
			
			if($product_info['bestSeller']){
				$this->data['bestSeller'] = $product_info['bestSeller'];
			}else{
				$this->data['bestSeller'] = false;
			}
			
			
			$this->data['review_status'] = $this->config->get('config_review_status');
			$this->data['reviews'] = sprintf($this->language->get('text_reviews'), (int)$product_info['reviews']);
			$this->data['rating'] = (int)$product_info['rating'];
			$this->data['description'] = html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8');
			
			if ($product_info['description2']) {
				$this->data['description2'] = html_entity_decode($product_info['description2'], ENT_QUOTES, 'UTF-8');
			} else {
				
			
				$this->data['description2'] = "Decor-Plaza.ru – интернет магазин предлагает посмотреть каталог " . $category_info['namer'] . " " . $product_info['manufacturer'] . ". Мы поможем Вам определиться с выбором " . $category_info['namer'] . ". Все модели есть в наличии, а также у нас есть специальные предложения на " . $category_info['sinonim1'] . " " . $this->translit2rus($product_info['manufacturer']) . ". Оформляйте онлайн заказ через сайт или по телефону " . $this->config->get('config_telephone') . ". Если вы не можете определиться " . $category_info['sinonim2'] . " купить, присмотритесь к " . $category_info['named'] . " " . $product_info['manufacturer'] . ". " . $product_info['name'] . " - " . $product_info['functions'] . ". Магазин italy-sumochka.ru доставит ваш заказ или оформит самовывоз в " . $cityformpred . ".";
			}
			
			
			
			$this->data['attribute_groups'] = $this->model_catalog_product->getProductAttributes($this->request->get['product_id']);

			$this->data['products'] = array();
			
			$results = $this->model_catalog_product->getProductRelated($this->request->get['product_id']);
			
			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_related_width'), $this->config->get('config_image_related_height'));
				} else {
					$image = false;
				}
				
				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$price = false;
				}
						
				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$special = false;
				}
				
				if ($this->config->get('config_review_status')) {
					$rating = (int)$result['rating'];
				} else {
					$rating = false;
				}

				$this->data['products'][] = array(
					'product_id' => $result['product_id'],
					'thumb'   	 => $image,
					'name'    	 => $result['name'],
					'price'   	 => $price,
					'special' 	 => $special,
					'rating'     => $rating,
					'reviews'    => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
					'href'    	 => $this->url->link('product/product', 'product_id=' . $result['product_id'])
				);
			}
			
			$this->data['tags'] = array();
			
			if ($product_info['tag']) {		
				$tags = explode(',', $product_info['tag']);
				
				foreach ($tags as $tag) {
					$this->data['tags'][] = array(
						'tag'  => trim($tag),
						'href' => $this->url->link('product/search', 'tag=' . trim($tag))
					);
				}
			}

			$this->model_catalog_product->updateViewed($this->request->get['product_id']);

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/product.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/product/product.tpl';
			} else {
				$this->template = 'default/template/product/product.tpl';
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
		else {
			$url = '';
			
			if (isset($this->request->get['path'])) {
				$url .= '&path=' . $this->request->get['path'];
			}
						
			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}	
						
			if (isset($this->request->get['manufacturer_id'])) {
				$url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
			}			

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
			}

			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . $this->request->get['tag'];
			}
							
			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}
					
			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}
			
			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
			}	
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}	

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}	
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
						
			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}
														
      		$this->data['breadcrumbs'][] = array(
        		'text'      => $this->language->get('text_error'),
				'href'      => $this->url->link('product/product', $url . '&product_id=' . $product_id),
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
	
	public function review() {
    	$this->language->load('product/product');
		
		$this->load->model('catalog/review');

		$this->data['text_on'] = $this->language->get('text_on');
		$this->data['text_no_reviews'] = $this->language->get('text_no_reviews');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}  
		
		$this->data['reviews'] = array();
		
		$review_total = $this->model_catalog_review->getTotalReviewsByProductId($this->request->get['product_id']);
			
		$results = $this->model_catalog_review->getReviewsByProductId($this->request->get['product_id'], ($page - 1) * 5, 5);
      		
		foreach ($results as $result) {
        	$this->data['reviews'][] = array(
        		'author'     => $result['author'],
				'text'       => $result['text'],
				'rating'     => (int)$result['rating'],
        		'reviews'    => sprintf($this->language->get('text_reviews'), (int)$review_total),
        		'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added']))
        	);
      	}			
			
		$pagination = new Pagination();
		$pagination->total = $review_total;
		$pagination->page = $page;
		$pagination->limit = 5; 
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('product/product/review', 'product_id=' . $this->request->get['product_id'] . '&page={page}');
			
		$this->data['pagination'] = $pagination->render();
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/review.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/product/review.tpl';
		} else {
			$this->template = 'default/template/product/review.tpl';
		}
		
		$this->response->setOutput($this->render());
	}
	
	public function write() {
		$this->language->load('product/product');
		
		$this->load->model('catalog/review');
		
		$json = array();
		
		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 25)) {
				$json['error'] = $this->language->get('error_name');
			}
			
			if ((utf8_strlen($this->request->post['text']) < 25) || (utf8_strlen($this->request->post['text']) > 1000)) {
				$json['error'] = $this->language->get('error_text');
			}

			if (empty($this->request->post['rating'])) {
				$json['error'] = $this->language->get('error_rating');
			}
				
			if (!isset($json['error'])) {
				$json['success'] = $this->language->get('text_success');
			}
		}
		
		$this->response->setOutput(json_encode($json));

		if (!isset($json['error'])) {
			($this->model_catalog_review->addReview($this->request->get['product_id'], $this->request->post));
		}
	}
	
	public function captcha() {
		$this->load->library('captcha');
		
		$captcha = new Captcha();
		
		$this->session->data['captcha'] = $captcha->getCode();
		
		$captcha->showImage();
	}
	
	public function upload() {
		$this->language->load('product/product');
		
		$json = array();
		
		if (!empty($this->request->files['file']['name'])) {
			$filename = basename(preg_replace('/[^a-zA-Z0-9\.\-\s+]/', '', html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8')));
			
			if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 64)) {
        		$json['error'] = $this->language->get('error_filename');
	  		}	  	

			// Allowed file extension types
			$allowed = array();
			
			$filetypes = explode("\n", $this->config->get('config_file_extension_allowed'));
			
			foreach ($filetypes as $filetype) {
				$allowed[] = trim($filetype);
			}
			
			if (!in_array(substr(strrchr($filename, '.'), 1), $allowed)) {
				$json['error'] = $this->language->get('error_filetype');
       		}	
			
			// Allowed file mime types		
		    $allowed = array();
			
			$filetypes = explode("\n", $this->config->get('config_file_mime_allowed'));
			
			foreach ($filetypes as $filetype) {
				$allowed[] = trim($filetype);
			}
							
			if (!in_array($this->request->files['file']['type'], $allowed)) {
				$json['error'] = $this->language->get('error_filetype');
			}
						
			if ($this->request->files['file']['error'] != UPLOAD_ERR_OK) {
				$json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);
			}
		} else {
			$json['error'] = $this->language->get('error_upload');
		}
		
		if (!$json && is_uploaded_file($this->request->files['file']['tmp_name']) && file_exists($this->request->files['file']['tmp_name'])) {
			$file = basename($filename) . '.' . md5(mt_rand());
			
			// Hide the uploaded file name so people can not link to it directly.
			$json['file'] = $this->encryption->encrypt($file);
			
			move_uploaded_file($this->request->files['file']['tmp_name'], DIR_DOWNLOAD . $file);
						
			$json['success'] = $this->language->get('text_upload');
		}	
		
		$this->response->setOutput(json_encode($json));		
	}
	
	public function translit2rus($string)
	{
		
	}
	
	public function createRedirect() {
		$i = 1676;
		$this->load->model('catalog/manufacturer');
		$this->load->model('catalog/category');
		$manufacturers = $this->model_catalog_manufacturer->getManufacturers($data);
		
		$categorys = $this->model_catalog_category->getCategories1();
		
		foreach ($categorys as $category) {
			foreach ($manufacturers as $manufacturer) {
			 
		
			
				$CountProductManufacturerCategory = $this->model_catalog_manufacturer->getCountProductManufacturerCategory($manufacturer['manufacturer_id'],$category['category_id']);
				if ($CountProductManufacturerCategory > 0) {
					
								
					$this->data['manufacturer_categorys'][] = array(
						'manufacturer_id' => $manufacturer['manufacturer_id'],
						'category_id'     => $category['category_id'],
						'name'            => $category['name'].' '.$manufacturer['name'],
						'linkold'			  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '_' . $category['category_id'] . $url) . '?filter_ocfilter=m:' . $manufacturer['manufacturer_id'],
						'linknew'			  => $this->url->link('product/manufacturer/info', '&manufacturer_id=' . $manufacturer['manufacturer_id'] . '&catId=' . $category['category_id'])
					);
				}
			}
		}

		foreach ($this->data['manufacturer_categorys'] as $tek) {
			var_dump($tek);
			$sql = "SELECT * FROM oc_redirect WHERE oc_redirect.from_url='".$tek['linkold']."'";
			
			$redirect = $this->db->query($sql);
			
			if (count($redirect->row) > 0) {
				
				$this->db->query("DELETE FROM oc_redirect WHERE oc_redirect.from_url='".$tek['linkold']."'");
				$sql = "INSERT INTO oc_redirect SET oc_redirect.active=1, oc_redirect.from_url='".$tek['linkold']."', oc_redirect.to_url='".$tek['linknew']."'";
				//echo($sql."<br>");
				$this->db->query($sql);
				
			} else {
				$sql = "INSERT INTO oc_redirect SET oc_redirect.active=1, oc_redirect.from_url='".$tek['linkold']."', oc_redirect.to_url='".$tek['linknew']."'";
				//echo($sql."<br>");
				$this->db->query($sql);
				//echo($i.";1;".$tek['linkold'].";".$tek['linknew'].";301;;;1<br>");
			}
			
		}
	
	}

	public function fastOrder() {
		$product_url = trim($_POST['product_url']);
	    $product_name = trim($_POST['product_name']);
	    $product_price = trim($_POST['product_price']);
	    $customer_name = trim($_POST['customer_name']);
	    $customer_phone = trim($_POST['customer_phone']);
	    $customer_message = trim($_POST['customer_message']);
	    $mail_subject = "italy-sumochka - быстрый заказ (".date('d.m.Y H:i').")";
	    
	    if (isset($customer_name) && $customer_name!=="" && isset($customer_phone) && $customer_phone!=="") {
	      $store_email = "info@italy-sumochka.ru";
	      $fast_order_email = "italy-sumochka";
	      //$product_name = iconv("UTF-8", "windows-1251", $product_name);
	      //$product_price = iconv("UTF-8", "windows-1251", $product_price);
	      $subject   = '=?windows-1251?B?'.base64_encode($mail_subject).'?=';
	      //$customer_name = iconv("UTF-8", "windows-1251", $customer_name);
	      //$customer_phone = iconv("UTF-8", "windows-1251", $customer_phone);
	      //$customer_message = iconv("UTF-8", "windows-1251", $customer_message);
	      $subject = '=?windows-1251?B?'.base64_encode($mail_subject).'?=';
	      $headers = "From: <".$fast_order_email.">\r\n";
	      $headers = $headers."Return-path: <".$fast_order_email.">\r\n";
	      $headers = $headers."Content-type: text/html; charset=\"UTF-8\"\r";
	      mail($store_email,$mail_subject,"Быстрый заказ<br><br>Дата заказа: ".date('d.m.Y H:i')."<br>Заказчик: ".$customer_name."<br>Телефон: ".$customer_phone."<br>Комментарий: ".$customer_message."<br><br>Товар: <a href='".$product_url."'>".$product_name."</a><br>Цена: ".$product_price,$headers);                                                           
	    } else { 
	      echo "empty"; 
	    }
	}

	public function qwe() {
		$sql = "SELECT * FROM  oc_product WHERE  oc_product.source <>  ''";
				//echo($sql."<br>");
		$list = $this->db->query($sql);
		
		foreach ($list->rows as $key => $value) {
			echo($this->url->link('product/product', 'product_id=' . $value['product_id'])."<br>");
		}

	}

	

	

	
}
?>
