<?php

/*$this->data['prev_text'] = "";
$this->data['next_text'] = "";
$this->data['prev_url']  = "";
$this->data['next_url']  = "";*/

if ($this->config->get('nextprevlinks_status')) {

	$this->load->language('module/nextprevlinks');
  
	// definice promennych
  
	$nextprev    = false;   // identifikator
	$products_np = array(); // produkty  
	$url         = "";      // cesta

	// inicializace parametru

	if (isset($this->request->get['category_id'])) {
		$category_id = $this->request->get['category_id'];
	} else {
		$category_id = '';
	}

	if (isset($this->request->get['description'])) {
		$description = $this->request->get['description'];
	} else {
		$description = '';
	}

	if (isset($this->request->get['model'])) {
		$model = $this->request->get['model'];
		$url .= '&model=' . $model;
	} else {
		$model = '';
	}

	if (isset($this->request->get['order'])) {
		$order = $this->request->get['order'];
		$url .= '&order=' . $order;
	} else {
		$order = 'ASC';
	}

	if (isset($this->request->get['page'])) {
		$page = $this->request->get['page'];
	} else {
		$page = 1;
	}

	if ( isset($this->request->get['product_id']) ) {
		$product_id = $this->request->get['product_id']; 
	} else {
		$product_id = '';
	}  

	if (isset($this->request->get['sort'])) {
		$sort = $this->request->get['sort'];
		$url .= '&sort=' . $sort;
	} else {
		$sort = 'pd.name';
	}

	// nacteni seznamu produktu

	if (isset($this->request->get['bestseller'])) {
		$nextprev    = true;
		$products_np = $this->model_catalog_product->getBestSellerProducts($this->config->get('bestseller_limit')); //getProductsByKeyword		
		$url .= '&bestseller=' . $this->request->get['bestseller'];
	}

	if (isset($this->request->get['featured'])) {
		$nextprev    = true;
		$products_np = $this->model_catalog_product->getFeaturedProducts_np($this->config->get('featured_limit')); //getProductsByKeyword		
		$url .= '&featured=' . $this->request->get['featured'];
	}

	if (isset($this->request->get['latest'])) {
		$nextprev    = true;
		$products_np = $this->model_catalog_product->getLatestProducts($this->config->get('latest_limit')); //getProductsByKeyword		
		$url .= '&latest=' . $this->request->get['latest'];
	}

	if (isset($this->request->get['manufacturer_id'])) {
		$nextprev    = true;
		$products_np = $this->model_catalog_product->getProductsByManufacturerId_np($this->request->get['manufacturer_id'], $sort, $order, 0, 9999999); //getProductsByManufacturerId		
	}

	if (isset($this->request->get['path'])) {
		$cat_path_ids = explode("_",$this->request->get['path']);
		$cat_path_id  = $cat_path_ids[count($cat_path_ids) - 1];
		$nextprev     = true;
		$products_np  = $this->model_catalog_product->getProductsByCategoryId_np($cat_path_id, $sort, $order, 0, 9999999); //getTotalProductsByCategoryId		
		$url .= '&path=' . $this->request->get['path'];
	}

	if (isset($this->request->get['special'])) {
		$nextprev    = true;
		$products_np = $this->model_catalog_product->getProductSpecials_np($sort, $order, 0, 9999999); //getProductsByManufacturerId		
		$url .= '&special=' . $this->request->get['special'];
	}

	// keyword, search, tag
	$kst = false;
	if (isset($this->request->get['keyword'])) {
		$kst = array(
			'param' => 'keyword',
			'value' => $this->request->get['keyword'],
		); 
	} // keyword
	if (isset($this->request->get['search'])) {
		$kst = array(
			'param' => 'search',
			'value' => $this->request->get['search'],
		); 
	} // search  
	if (isset($this->request->get['tag'])) {
		$kst = array(
			'param' => 'tag',
			'value' => $this->request->get['tag'],
		); 
	} // tag	
	if ($kst) {
		$nextprev    = true;
		$results     = $this->model_catalog_product->getProductsByKeyword_np($kst['value'], $category_id, $description, $model, $sort, $order, 0, 9999999); //getProductsByKeyword
		$products_np = $this->model_catalog_product->getProductsByTag_np($kst['value'], $category_id, $sort, $order, ($page - 1) * $this->config->get('config_catalog_limit'), $this->config->get('config_catalog_limit'));
		foreach ($results as $key => $value) {
			$products_np[$value['product_id']] = $results[$key];
		} // foreach
		$url .= '&' . $kst['param'] . '=' . $kst['value'];
	}

	if ($nextprev) {

		$counter = 0;
		$key     = 0;
		$products_np_data = array();

		// if not array >> set empty array
		if ( !is_array($products_np) ) {
			$products_np = array(); 
		} 
		foreach($products_np as $product_np) {
			if ($product_id == $product_np['product_id']) {
				$key = $counter; // order product in array
			}
			$products_np_data[$counter] = array(
				'product_id' => $product_np['product_id'], 
				'name'       => $product_np['name'],
			);
			$counter++;
		} // foreach
	
		// this is the first product in search
		if ($key == 0 && $key != (count($products_np_data)-1)) {
			$this->data['prev_url']  = $this->url->link('product/product' . $url . '&product_id=' . $products_np_data[$key+count($products_np_data)-1]['product_id']);
			$this->data['prev_text'] = $this->config->get('nextprevlinks_link_style') == 1 ? $products_np_data[$key+count($products_np_data)-1]['name'] : $this->language->get('prev');
			if ( count($products_np) == 0 ) { // ochrana pred pouzitim: keyword (nenalezeno) + product_id (nalezeno)
				// doplneny kod
				$this->data['next_url']  = "";
				$this->data['next_text'] = "";
			} else {
				// puvodni kod
				$this->data['next_url']  = $this->url->link('product/product' . $url . '&product_id=' . $products_np_data[$key+1]['product_id']);
				$this->data['next_text'] = $this->config->get('nextprevlinks_link_style') == 1 ? $products_np_data[$key+1]['name'] : $this->language->get('next');
	}
		}
		
		// this is NOT the first product  and NOT the last
	if ($key != 0 && $key != (count($products_np_data)-1)) {
			$this->data['prev_url']  = $this->url->link('product/product' . $url . '&product_id=' . $products_np_data[$key-1]['product_id']);
			$this->data['prev_text'] = $this->config->get('nextprevlinks_link_style') == 1 ? $products_np_data[$key-1]['name'] : $this->language->get('prev');
			$this->data['next_url']  = $this->url->link('product/product' . $url . '&product_id=' . $products_np_data[$key+1]['product_id']);
			$this->data['next_text'] = $this->config->get('nextprevlinks_link_style') == 1 ? $products_np_data[$key+1]['name'] : $this->language->get('next');
		}
		
		// this is NOT the first but it IS the last
		if ($key != 0 && $key == (count($products_np_data)-1)) {
			$this->data['prev_url']  = $this->url->link('product/product' . $url . '&product_id=' . $products_np_data[$key-1]['product_id']);
			$this->data['prev_text'] = $this->config->get('nextprevlinks_link_style') == 1 ? $products_np_data[$key-1]['name'] : $this->language->get('prev');
			$this->data['next_url']  = $this->url->link('product/product' . $url . '&product_id=' . $products_np_data[$key-count($products_np_data)+1]['product_id']);
			$this->data['next_text'] = $this->config->get('nextprevlinks_link_style') == 1 ? $products_np_data[$key-count($products_np_data)+1]['name'] : $this->language->get('next'); 
		}
	
		// this is the first and it IS the last
	/*	if ($key == 0 && $key == (count($products_np_data)-1)) {
			$this->data['prev_url']  = "";
			$this->data['prev_text'] = "";
			$this->data['next_url']  = "";
			$this->data['next_text'] = "";
		}*/
		
	} // if $nextprev
}
?>
