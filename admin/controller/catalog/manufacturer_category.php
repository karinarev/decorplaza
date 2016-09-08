<?php    
class ControllerCatalogManufacturerCategory extends Controller { 
	private $error = array();
  
  	public function index() {
		$this->language->load('catalog/manufacturer_category');
		
		$this->document->setTitle($this->language->get('heading_title'));
		 
		$this->load->model('catalog/manufacturer');
		$this->load->model('catalog/category');
		
    	$this->getList();
  	}
  
  	public function insert() {
		$this->language->load('catalog/manufacturer');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/manufacturer');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_manufacturer->addManufacturer($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
			
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
			
			$this->redirect($this->url->link('catalog/manufacturer', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
    
    	$this->getForm();
  	} 
   
  	public function update() {
		$this->language->load('catalog/manufacturer_category');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/manufacturer');
		$this->load->model('catalog/category');
		echo($this->validateForm());
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			
			$this->model_catalog_manufacturer->editManufacturerCategory($this->request->get['manufacturer_id'],$this->request->get['category_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->redirect($this->url->link('catalog/manufacturer_category', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
    
    	$this->getForm();
  	}   

  	public function delete() {
		$this->language->load('catalog/manufacturer');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/manufacturer');
			
    	if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $manufacturer_id) {
				$this->model_catalog_manufacturer->deleteManufacturer($manufacturer_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');
			
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
			
			$this->redirect($this->url->link('catalog/manufacturer', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    	}
	
    	$this->getList();
  	}  
	
	public function repair_url() {
		$this->language->load('catalog/manufacturer_category');

		//$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/manufacturer');
		$this->load->model('catalog/category');
		$categorys = $this->model_catalog_category->getCategories();
		$manufacturers = $this->model_catalog_manufacturer->getManufacturers();
		
		$te=$this->model_catalog_manufacturer->repair_url_manufacturer_categories($manufacturers,$categorys);
//var_dump($te);
		$this->session->data['success'] = $this->language->get('text_repair_url_success');

		$this->redirect($this->url->link('catalog/manufacturer_category', 'token=' . $this->session->data['token'], 'SSL'));
	

		//$this->getList();
	}
    
  	protected function getList() {
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
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

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/manufacturer_category', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
							
		$this->data['repair_url'] = $this->url->link('catalog/manufacturer_category/repair_url', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['manufacturer_categorys'] = array();

		$data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);
		
		$manufacturer_total = $this->model_catalog_manufacturer->getTotalManufacturers();
		$manufacturers = $this->model_catalog_manufacturer->getManufacturers($data);
		$categorys = $this->model_catalog_category->getCategories(0,1);
		
		foreach ($categorys as $category) {
			foreach ($manufacturers as $manufacturer) {
			 
		
			
				$CountProductManufacturerCategory = $this->model_catalog_manufacturer->getCountProductManufacturerCategory($manufacturer['manufacturer_id'],$category['category_id']);
				if ($CountProductManufacturerCategory > 0) {
					$action = array();
					
					$action[] = array(
						'text' => $this->language->get('text_edit'),
						'href' => $this->url->link('catalog/manufacturer_category/update', 'token=' . $this->session->data['token'] . '&manufacturer_id=' . $manufacturer['manufacturer_id'] . '&category_id=' . $category['category_id'] . $url, 'SSL')
					);
								
					$this->data['manufacturer_categorys'][] = array(
						'manufacturer_id' => $manufacturer['manufacturer_id'],
						'category_id'     => $category['category_id'],
						'name'            => $category['name'].' '.$manufacturer['name'],
						'action'          => $action
					);
				}
			}
		}	
	
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_sort_order'] = $this->language->get('column_sort_order');
		$this->data['column_action'] = $this->language->get('column_action');		
		
		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_repare_url'] = $this->language->get('button_repare_url');
		$this->data['button_delete'] = $this->language->get('button_delete');
		$this->data['button_repair_url'] = $this->language->get('button_repair_url');
 
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$this->data['sort_name'] = $this->url->link('catalog/manufacturer_category', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$this->data['sort_sort_order'] = $this->url->link('catalog/manufacturer_category', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, 'SSL');
		
		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
												
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		

		$pagination = new Pagination();
		$pagination->total = $manufacturer_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('catalog/manufacturer_category', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();

		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'catalog/manufacturer_category_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
  
  	protected function getForm() {
    	$this->data['heading_title'] = $this->language->get('heading_title');

    	$this->data['text_enabled'] = $this->language->get('text_enabled');
    	$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_default'] = $this->language->get('text_default');
    	$this->data['text_image_manager'] = $this->language->get('text_image_manager');
		$this->data['text_browse'] = $this->language->get('text_browse');
		$this->data['text_clear'] = $this->language->get('text_clear');			
		$this->data['text_percent'] = $this->language->get('text_percent');
		$this->data['text_amount'] = $this->language->get('text_amount');
				
		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_store'] = $this->language->get('entry_store');
		$this->data['entry_keyword'] = $this->language->get('entry_keyword');
    	$this->data['entry_image'] = $this->language->get('entry_image');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$this->data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$this->data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['entry_seo_title'] = $this->language->get('entry_seo_title');
		$this->data['entry_seo_h1'] = $this->language->get('entry_seo_h1');
		  
    	$this->data['button_save'] = $this->language->get('button_save');
    	$this->data['button_cancel'] = $this->language->get('button_cancel');
		
		$this->data['tab_general'] = $this->language->get('tab_general');
			  
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

 		if (isset($this->error['name'])) {
			$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = '';
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
		
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/manufacturer_category', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
							
		if ((!isset($this->request->get['manufacturer_id'])) && (!isset($this->request->get['category_id']))) {
			//$this->data['action'] = $this->url->link('catalog/manufacturer/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('catalog/manufacturer_category/update', 'token=' . $this->session->data['token'] . '&manufacturer_id=' . $this->request->get['manufacturer_id'] . '&category_id=' . $this->request->get['category_id'] . $url, 'SSL');
		}
		
		
		$this->data['cancel'] = $this->url->link('catalog/manufacturer_category', 'token=' . $this->session->data['token'] . $url, 'SSL');

    	if (isset($this->request->get['manufacturer_id']) && isset($this->request->get['category_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
		
      		$manufacturer_category_info = $this->model_catalog_manufacturer->getManufacturerCategoryDescriptions($this->request->get['manufacturer_id'],$this->request->get['category_id']);
			$manufacturer_category_manufacturer = $this->model_catalog_manufacturer->getManufacturer($this->request->get['manufacturer_id']);
			$manufacturer_category_category = $this->model_catalog_category->getCategoryDescriptions($this->request->get['category_id']);
			
			$manufacturer_category_info['name'] = $manufacturer_category_category[1]['name'] . ' ' . $manufacturer_category_manufacturer['name'];
			
    	}

		$this->data['token'] = $this->session->data['token'];

		$this->load->model('localisation/language');
		
		$this->data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['manufacturer_category_description'])) {
			$this->data['manufacturer_category_description'] = $this->request->post['manufacturer_category_description'];
		} elseif (!empty($manufacturer_category_info)) {
			$this->data['manufacturer_category_description'] = $this->model_catalog_manufacturer->getManufacturerCategoryDescriptions($this->request->get['manufacturer_id'],$this->request->get['category_id']);
		} else {
			$this->data['manufacturer_category_description'] = array();
		}

    	if (isset($this->request->post['name'])) {
      		$this->data['name'] = $this->request->post['name'];
    	} elseif (!empty($manufacturer_category_info)) {
			$this->data['name'] = $manufacturer_category_info['name'];
		} else {	
      		$this->data['name'] = '';
    	}
		
		$this->load->model('setting/store');
		
		
		
		$this->template = 'catalog/manufacturer_category_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}  
	 
  	protected function validateForm() {
    	if (!$this->user->hasPermission('modify', 'catalog/manufacturer_category')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}

    	
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}    

  	protected function validateDelete() {
    	if (!$this->user->hasPermission('modify', 'catalog/manufacturer_category')) {
			$this->error['warning'] = $this->language->get('error_permission');
    	}	
		
		$this->load->model('catalog/product');

		foreach ($this->request->post['selected'] as $manufacturer_id) {
  			$product_total = $this->model_catalog_product->getTotalProductsByManufacturerId($manufacturer_id);
    
			if ($product_total) {
	  			$this->error['warning'] = sprintf($this->language->get('error_product'), $product_total);	
			}	
	  	} 
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}  
  	}
	
	public function autocomplete() {
		$json = array();
		
		if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/manufacturer');
			
			$data = array(
				'filter_name' => $this->request->get['filter_name'],
				'start'       => 0,
				'limit'       => 20
			);
			
			$results = $this->model_catalog_manufacturer->getManufacturers($data);
				
			foreach ($results as $result) {
				$json[] = array(
					'manufacturer_id' => $result['manufacturer_id'], 
					'name'            => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				);
			}		
		}

		$sort_order = array();
	  
		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->setOutput(json_encode($json));
	}	
}
?>
