<?php 
class ControllerProductManufacturer extends Controller {  
	public function index() {
		$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/manufacturer.css');

		$this->language->load('product/manufacturer');
		
		$this->load->model('catalog/manufacturer');
		
		$this->load->model('tool/image');		
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_index'] = $this->language->get('text_index');
		$this->data['text_empty'] = $this->language->get('text_empty');
		
		$this->data['button_continue'] = $this->language->get('button_continue');
		
		$this->data['breadcrumbs'] = array();
		
      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
        	'separator' => false
      	);
		
		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_brand'),
		//	'href'      => $this->url->link('product/manufacturer'),
			'separator' => $this->language->get('text_separator')
		);
		
		$this->data['categories'] = array();

		$useragent=$_SERVER['HTTP_USER_AGENT'];
		if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
		{
			if (isset($this->request->get['page'])) {
				$page = $this->request->get['page'];
			} else {
				$page = 1;
			}

			$limit = 9;

			$data = array(
				'start'              => ($page - 1) * $limit,
				'limit'              => $limit
			);

			$results = $this->model_catalog_manufacturer->getManufacturers($data);
			$total_manufacturers = $this->model_catalog_manufacturer->getManufacturers();
		}
		else {
			$results = $this->model_catalog_manufacturer->getManufacturers();
		}


		foreach ($results as $result) {
			if ($result['image']) {
				$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_category_width'), $this->config->get('config_image_category_height'));
			} else {
				$image = false;
			}
			if (is_numeric(utf8_substr($result['name'], 0, 1))) {
				$key = '0 - 9';
			} else {
				$key = utf8_substr(utf8_strtoupper($result['name']), 0, 1);
			}

			if (!isset($this->data['manufacturers'][$key])) {
				$this->data['categories'][$key]['name'] = $key;
			}

			$this->data['categories'][$key]['manufacturer'][] = array(
				'thumb' => $image,
				'name' => $result['name'],
				'href' => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $result['manufacturer_id'])
			);
		}

		
		$this->data['continue'] = $this->url->link('common/home');



		$url = '';

	
		$pagination = new Pagination();
		$pagination->total = count($total_manufacturers);
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('product/manufacturer' . $url . '&page={page}');

		$this->data['pagination'] = $pagination->render();

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/manufacturer_list.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/product/manufacturer_list.tpl';
		} else {
			$this->template = 'default/template/product/manufacturer_list.tpl';
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
	
	public function info() {
		$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/category.css');
		$this->document->addStyle('catalog/view/javascript/jquery/customscrollbar/jquery.mCustomScrollbar.min.css');
		$this->document->addScript('catalog/view/javascript/jquery/customscrollbar/jquery.mCustomScrollbar.concat.min.js');

		$this->language->load('product/manufacturer');
		
		$this->load->model('catalog/manufacturer');
		
		$this->load->model('catalog/product');
		
		$this->load->model('catalog/category');
		
		$manufacturers = $this->model_catalog_manufacturer->getManufacturers();
		foreach ($manufacturers as $manufacturer) {
			if (isset($this->request->get['catId'])) {
				$countProductManufacturerCategory = $this->model_catalog_manufacturer->getCountProductManufacturerCategory($manufacturer['manufacturer_id'],$this->request->get['catId']);
				if ($countProductManufacturerCategory > 0) {
					$this->data['manArr'][] = array(
						'manufacturer_id' => $manufacturer['manufacturer_id'],
						'name'        => $manufacturer['name'],
						'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $manufacturer['manufacturer_id'] . '&catId=' . $this->request->get['catId'])
					);
				}

			} else {
				$this->data['manArr'][] = array(
					'manufacturer_id' => $manufacturer['manufacturer_id'],
					'name'        => $manufacturer['name'],
					'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $manufacturer['manufacturer_id'])
				);

			}
			
		}


		if (isset($this->request->get['catId'])) {
			$tekcat = $this->model_catalog_category->getCategory($this->request->get['catId']);
			if ($tekcat['parent_id'] > 0) {

				$this->data['linkcategory'] = $this->url->link('product/category', 'path=' . $tekcat['parent_id'] . '_' . $this->request->get['catId']);


			} else {

				$this->data['linkcategory'] = $this->url->link('product/category', 'path=' . $this->request->get['catId']);
			}
			
		} else {

			$this->data['linkcategory'] = "/";
		}




		$categories = $this->model_catalog_category->getCategories(0);

		foreach ($categories as $category) {
			$total = $this->model_catalog_product->getTotalProducts(array('filter_category_id' => $category['category_id']));

			$children_data = array();

			$children = $this->model_catalog_category->getCategories($category['category_id']);
			
		

			foreach ($children as $child) {
				$data = array(
					'filter_category_id'  => $child['category_id'],
					'filter_sub_category' => true
				);
				$countChildrenProductManufacturerCategory = $this->model_catalog_manufacturer->getCountProductManufacturerCategory($this->request->get['manufacturer_id'],$child['category_id']);
				$children_data[] = array(
					'category_id' => $child['category_id'],
					'name'        => $child['name'],
					'countproduct'	=> $countChildrenProductManufacturerCategory,
					'href'        => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . '&catId=' . $child['category_id'])
				);		
			}
			
			$countProductManufacturerCategory = $this->model_catalog_manufacturer->getCountProductManufacturerCategory($this->request->get['manufacturer_id'],$category['category_id']);
			$this->data['catArr'][] = array(
				'category_id' => $category['category_id'],
				'name'        => $category['name'],
				'children'    => $children_data,
				'countproduct'	=> $countProductManufacturerCategory,
				'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . '&catId=' . $category['category_id'])
			);	
		}
		
		$this->data['linkmanufacturer'] = $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] );
		
			$this->data['catsArr'] = $arr;
			# OCFilter start
			$this->load->model('catalog/ocfilter');
			# OCFilter end
		
		$this->load->model('tool/image'); 
		
		if (isset($this->request->get['manufacturer_id'])) {
			$manufacturer_id = (int)$this->request->get['manufacturer_id'];
		} else {
			$manufacturer_id = 0;
		}
		
		if (isset($this->request->get['catId'])) {
			$catId = (int)$this->request->get['catId'];
		} else {
			$catId = 0;
		} 
										
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'p.sort_order';
		} 

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		} 
  		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
				
		if (isset($this->request->get['limit'])) {
			$limit = $this->request->get['limit'];
		} else {
			$limit = $this->config->get('config_catalog_limit');
		}

		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array( 
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
      		'separator' => false
   		);
   		$manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($manufacturer_id);
		
		if(!isset($_GET['catId'])){
		$this->data['breadcrumbs'][] = array( 
       		'text'      => $this->language->get('text_brand'),
			'href'      => $this->url->link('product/manufacturer'),
      		'separator' => $this->language->get('text_separator')
   		);
		}else{
		
		$this->data['breadcrumbs'][] = array(
       			'text'      => $manufacturer_info['name'],
				'href'      => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . $url),
      			'separator' => $this->language->get('text_separator')
   			);
		}
		
		if (isset($this->request->get['catId'])) {
			
			$manufacturer_category_info = $this->model_catalog_manufacturer->getManufacturerCategoryDescriptions($manufacturer_id,$this->request->get['catId']);
			$manufacturer_category_manufacturer = $this->model_catalog_manufacturer->getManufacturer($manufacturer_id);
			$manufacturer_category_category = $this->model_catalog_category->getCategory($this->request->get['catId']);
			
			$manufacturer_category_info['name'] = $manufacturer_category_category['name'] . ' ' . $manufacturer_category_manufacturer['name'];
			
			
		} 
	//var_dump($manufacturer_category_info);
		if ($manufacturer_info) {
			
			
			
			
			$this->document->addScript('catalog/view/javascript/jquery/jquery.total-storage.min.js');
			
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
			
			
			if (isset($this->request->get['catId'])) {
				$this->document->setDescription($manufacturer_category_info[1]['meta_description']);
				if ($manufacturer_category_info[1]['seo_title']) {
					$this->document->setTitle($manufacturer_category_info[1]['seo_title']);
				} else {
					
					$this->document->setTitle('Купить ' . $manufacturer_category_category['namev'] . ' ' . $manufacturer_category_manufacturer['name'] . ' (' . $this->translit2rus($manufacturer_category_manufacturer['name']) . ') в ' .$cityformpred. '  недорого - Decor-plaza.ru');
					
				}
				if ($manufacturer_category_info[1]['seo_h1']) {
					$this->data['heading_title'] = $manufacturer_category_info[1]['seo_h1'];
				} else {
					$this->data['heading_title'] = $manufacturer_category_category['name'] . ' ' . $manufacturer_category_manufacturer['name'];
				}
				if ($manufacturer_category_info[1]['meta_description']) {
					$this->document->setDescription($manufacturer_category_info[1]['meta_description']);
				} else {
					$this->document->setDescription('Заказывайте ' . $manufacturer_category_category['namev'] . ' ' . $manufacturer_category_manufacturer['name'] . ' в интернет магазине Decor-plaza.ru. Самые выгодные условия, цены и доставка по всей России') ;
				}
				
				if ($manufacturer_category_info[1]['description']) {
					$this->data['description'] = html_entity_decode($manufacturer_category_info[1]['description'], ENT_QUOTES, 'UTF-8');
				} else {
					$this->data['description'] = html_entity_decode($manufacturer_category_category['description'].'<br>'.$manufacturer_category_manufacturer['description'], ENT_QUOTES, 'UTF-8');
				}
                                
                if ($manufacturer_category_info[1]['meta_keyword']) {
                    $this->document->setKeywords(html_entity_decode($manufacturer_category_info[1]['meta_keyword'], ENT_QUOTES, 'UTF-8'));
                } else {
                    $this->document->setKeywords(html_entity_decode($manufacturer_category_category['meta_keyword'], ENT_QUOTES, 'UTF-8'));
                }
				
			} else {
				if ($manufacturer_info['seo_title']) {
					$this->document->setTitle($manufacturer_info['seo_title']);
				} else {
					$this->document->setTitle($manufacturer_info['name']);
				}
				if ($manufacturer_info['seo_h1']) {
					$this->data['heading_title'] = $manufacturer_info['seo_h1'];
				} else {
					$this->data['heading_title'] = $manufacturer_info['name'];
				}
				$this->document->setDescription($manufacturer_info['meta_description']);
				$this->document->setKeywords($manufacturer_info['meta_keyword']);
				$this->data['description'] = html_entity_decode($manufacturer_info['description'], ENT_QUOTES, 'UTF-8');
			} 

			
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
			
			if (isset($this->request->get['catId'])) {
				$url .= '&catId=' . $this->request->get['catId'];
			}	
			
			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}
		   	$this->document->addLink($this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id']. $url), 'canonical');		
			$this->data['breadcrumbs'][] = array(
       			'text'      => $manufacturer_info['name'],
				//'href'      => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . $url),
      			'separator' => $this->language->get('text_separator')
   			);
			
			

			
		
			/*if (($catId) > 0) {
				$this->data['heading_title'] = 'Экипировка Venum';
				$this->document->setTitle('Экипировка Venum');
			}*/
			
			$this->data['text_empty'] = $this->language->get('text_empty');
			$this->data['text_quantity'] = $this->language->get('text_quantity');
			$this->data['text_manufacturer'] = $this->language->get('text_manufacturer');
			$this->data['text_model'] = $this->language->get('text_model');
			$this->data['text_price'] = $this->language->get('text_price');
			$this->data['text_tax'] = $this->language->get('text_tax');
			$this->data['text_points'] = $this->language->get('text_points');
			$this->data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
			$this->data['text_display'] = $this->language->get('text_display');
			$this->data['text_list'] = $this->language->get('text_list');
			$this->data['text_grid'] = $this->language->get('text_grid');			
			$this->data['text_sort'] = $this->language->get('text_sort');
			$this->data['text_limit'] = $this->language->get('text_limit');
			  
			$this->data['button_cart'] = $this->language->get('button_cart');
			$this->data['button_wishlist'] = $this->language->get('button_wishlist');
			$this->data['button_compare'] = $this->language->get('button_compare');
			$this->data['button_continue'] = $this->language->get('button_continue');
			
			$this->data['compare'] = $this->url->link('product/compare');
			
			$this->data['products'] = array();
			
			$data = array(
				'filter_manufacturer_id' => $manufacturer_id, 
				'sort'                   => $sort,
				'order'                  => $order,
				'start'                  => ($page - 1) * $limit,
				'limit'                  => $limit,
				'filter_category_id' => $catId,
				
			);
					
			$results = $this->model_catalog_product->getProducts($data);
			//var_dump($results);
			# OCFilter start
			$ocfilter_products_options = $this->model_catalog_ocfilter->getOCFilterProductsOptions($results);
			# OCFilter end
			//Вызов метода getFoundProducts должен проводится сразу же после getProducts
			//только тогда он выдает правильное значения количества товаров
			$product_total = $this->model_catalog_product->getFoundProducts();
		
					
			foreach ($results as $result) {
				$options = array();
				
				foreach ($this->model_catalog_product->getProductOptions($result['product_id']) as $option) { 
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
					
					$options[] = array(
						'product_option_id' => $option['product_option_id'],
						'option_id'         => $option['option_id'],
						'name'              => $option['name'],
						'type'              => $option['type'],
						'option_value'      => $option_value_data,
						'required'          => $option['required']
					);					
				} elseif ($option['type'] == 'text' || $option['type'] == 'textarea' || $option['type'] == 'file' || $option['type'] == 'date' || $option['type'] == 'datetime' || $option['type'] == 'time') {
					$options[] = array(
						'product_option_id' => $option['product_option_id'],
						'option_id'         => $option['option_id'],
						'name'              => $option['name'],
						'type'              => $option['type'],
						'option_value'      => $option['option_value'],
						'required'          => $option['required']
					);						
				}
			}
				
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
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
				
				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
				} else {
					$tax = false;
				}				
				
				if ($this->config->get('config_review_status')) {
					$rating = (int)$result['rating'];
				} else {
					$rating = false;
				}
								
				$newItem = ($result['newItem'] > 0) ? $result['newItem'] : '';
				$bestSaller = ($result['bestSaller'] > 0) ? $result['bestSaller'] : '';	
				$model = $result['model'];
				$author = $result['manufacturer'];
				$manufacturers = $this->url->link('product/manufacturer_info', '&manufacturer_id=' . $result['manufacturer_id'] . $url);	
				
				$text_availability = 1;	
				$text_instock = $result['stock_status'];

							
				$this->data['products'][] = array(
					'product_id'  => $result['product_id'],
						# OCFilter start
						'ocfilter_products_options' => $ocfilter_products_options[$result['product_id']],
						# OCFilter end
					'thumb'       => $image,
					'bestSeller'  => $bestSaller,
					'model'  	  => $model,
					'author'  	  => $author,
					'manufacturers' => $manufacturers,
					'text_availability' => $text_availability,
					'text_instock' => $text_instock,
					'newItem'     => $newItem,
					'fullName'   => $result['name'],
					'name'        => utf8_substr($result['name'], 0, 55) . "...",
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 300) . '..',
					'description_poln' => strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')),
					'price'       => $price,
					'special'     => $special,
					'tax'         => $tax,
					'rating'      => $result['rating'],
					'reviews'     => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
					'href'        => $this->url->link('product/product', '&manufacturer_id=' . $result['manufacturer_id'] . '&product_id=' . $result['product_id'] . $url),
					'options' => $options
				);
			}
					
			$url = '';
			if (isset($this->request->get['catId'])) {
				$url .= '&catId=' . $this->request->get['catId'];
			}	
			
			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}
						
			$this->data['sorts'] = array();
			
			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_default'),
				'value' => 'p.sort_order-ASC',
				'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . '&sort=p.sort_order&order=ASC' . $url)
			);

			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_price_asc'),
				'value' => 'p.price-ASC',
				'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . '&sort=p.price&order=ASC' . $url)
			); 
	
			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_price_desc'),
				'value' => 'p.price-DESC',
				'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . '&sort=p.price&order=DESC' . $url)
			); 
			
			if ($this->config->get('config_review_status')) {
				$this->data['sorts'][] = array(
					'text'  => $this->language->get('text_rating_desc'),
					'value' => 'rating-DESC',
					'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . '&sort=rating&order=DESC' . $url)


			); 
			
			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_rating_asc'),
				'value' => 'rating-ASC',
					'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . '&sort=rating&order=ASC' . $url)

			);
			}

			$url = '';
			if (isset($this->request->get['catId'])) {
				$url .= '&catId=' . $this->request->get['catId'];
			}	
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}	
	
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			$this->data['limits'] = array();
	
			$limits = array_unique(array($this->config->get('config_catalog_limit'), 25, 50, 75, 100));

			sort($limits);
	
			foreach($limits as $value){
				$this->data['limits'][] = array(
					'text'  => $value,
					'value' => $value,
					'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . $url . '&limit=' . $value)
				);
			}
				
			$url = '';
							
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}	
	
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			if (isset($this->request->get['catId'])) {
				$url .= '&catId=' . $this->request->get['catId'];
			}
			
			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}
					
			$pagination = new Pagination();
			$pagination->total = $product_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->text = $this->language->get('text_pagination');
			$pagination->url = $this->url->link('product/manufacturer/info','manufacturer_id=' . $this->request->get['manufacturer_id'] .  $url . '&page={page}');
			
			$this->data['pagination'] = $pagination->render();
			
			$this->data['sort'] = $sort;
			$this->data['order'] = $order;
			$this->data['limit'] = $limit;
			
			$this->data['continue'] = $this->url->link('common/home');
			
			if(empty($this->data['products'])) {
				
			$url = '';
			
			$this->data = array();
			
			$this->response->addHeader("HTTP/1.0 404 Not Found");
			
			$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array( 
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
      		'separator' => false
   		);
   		
		$this->data['breadcrumbs'][] = array( 
       		'text'      => $this->language->get('text_brand'),
			'href'      => $this->url->link('product/manufacturer'),
      		'separator' => $this->language->get('text_separator')
   		);
				
			$this->document->setTitle($this->language->get('text_error'));

      		$this->data['heading_title'] = $this->language->get('text_error');

      		$this->data['text_error'] = $this->language->get('text_error');

      		$this->data['button_continue'] = $this->language->get('button_continue');

      		$this->data['continue'] = $this->url->link('common/home');	
			
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/manufacturer_not_found.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/error/manufacturer_not_found.tpl';
			} else {
				$this->template = 'default/template/error/manufacturer_not_found.tpl';
			}
			} else {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/manufacturer_info.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/product/manufacturer_info.tpl';
			} else {
				$this->template = 'default/template/product/manufacturer_info.tpl';
			}
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
			$url = '';
			
			if (isset($this->request->get['manufacturer_id'])) {
				$url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
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
				'href'      => $this->url->link('product/category', $url),
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
	
	/*public function rus2translit($string)
	{
		$converter = array(
			'а' => 'a',   'б' => 'b',   'в' => 'v',
			'г' => 'g',   'д' => 'd',   'е' => 'e',
			'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
			'и' => 'i',   'й' => 'y',   'к' => 'k',
			'л' => 'l',   'м' => 'm',   'н' => 'n',
			'о' => 'o',   'п' => 'p',   'р' => 'r',
			'с' => 's',   'т' => 't',   'у' => 'u',
			'ф' => 'f',   'х' => 'h',   'ц' => 'c',
			'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
			'ь' => "",  'ы' => 'y',   'ъ' => "",
			'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
	 
			'А' => 'A',   'Б' => 'B',   'В' => 'V',
			'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
			'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
			'И' => 'I',   'Й' => 'Y',   'К' => 'K',
			'Л' => 'L',   'М' => 'M',   'Н' => 'N',
			'О' => 'O',   'П' => 'P',   'Р' => 'R',
			'С' => 'S',   'Т' => 'T',   'У' => 'U',
			'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
			'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
			'Ь' => "",  'Ы' => 'Y',   'Ъ' => "",
			'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
		);
		return strtr($string, $converter);
	}*/
	
	public function translit2rus($string)
	{
		$converter = array(
			'а' => 'a',   'б' => 'b',   'в' => 'v',
             'г' => 'g',   'д' => 'd',   'е' => 'e',
             'ё' => 'yo',   'ж' => 'zh',  'з' => 'z',
             'и' => 'i',   'й' => 'y',   'к' => 'k',
             'л' => 'l',   'м' => 'm',   'н' => 'n',
             'о' => 'o',   'п' => 'p',   'р' => 'r',
             'с' => 's',   'т' => 't',   'у' => 'u',
             'ф' => 'f',   'х' => 'h',   'ц' => 'c',
             'ч' => 'ch',  'ш' => 'sh',  'щ' => 'shh',
			 'ю' => 'yu',  'я' => 'ya',
         
 
            'А' => 'A',   'Б' => 'B',   'В' => 'V',
             'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
             'Ё' => 'YO',   'Ж' => 'Zh',  'З' => 'Z',
             'И' => 'I',   'Й' => 'Y',   'К' => 'K',
             'Л' => 'L',   'М' => 'M',   'Н' => 'N',
             'О' => 'O',   'П' => 'P',   'Р' => 'R',
             'С' => 'S',   'Т' => 'T',   'У' => 'U',
             'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
             'Ч' => 'CH',  'Ш' => 'SH',  'Щ' => 'SHH',
             'Ю' => 'YU',  'Я' => 'YA',
		);
		return strtr($string, array_flip($converter));
	}
	
}
?>
