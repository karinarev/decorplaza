<?php

getProductsByCategoryId
$products_np = $this->model_catalog_product->getProductsByCategoryId($cat_path_id, $sort, $order, 0, 9999999); //getTotalProductsByCategoryId
x > xml

getProductsByManufacturerId_np
$products_np = $this->model_catalog_product->getProductsByManufacturerId_np(
  $this->request->get['manufacturer_id'], 
  $sort, 
  $order, 
  0, 
  9999999
  ); //getProductsByManufacturerId
x+

getProductsByKeyword_np
$key_results = $this->model_catalog_product->getProductsByKeyword_np(
  $this->request->get['keyword'], 
  isset($this->request->get['category_id']) ? $this->request->get['category_id'] : '', 
  isset($this->request->get['description']) ? $this->request->get['description'] : '', 
  isset($this->request->get['model']) ? $this->request->get['model'] : '', 
  $sort, 
  $order, 
  0, 
  9999999
  ); //getProductsByKeyword
x+

getProductsByTag_np
$products_np = $this->model_catalog_product->getProductsByTag_np(
  $this->request->get['keyword'], 
  isset($this->request->get['category_id']) ? $this->request->get['category_id'] : '', 
  $sort, 
  $order, 
  ($page - 1) * $this->config->get('config_catalog_limit'), 
  $this->config->get('config_catalog_limit')
  );
x+

getFeaturedProducts_np
$products_np = $this->model_catalog_product->getFeaturedProducts_np(
  $this->config->get('featured_limit')
  ); //getProductsByKeyword
x+

getProductSpecials_np
$products_np = $this->model_catalog_product->getProductSpecials(
  $sort, $order, 0, 9999999); //getProductsByManufacturerId
ok+

***

  /* FUNCTIONS_NP on OC v.56:
  
  getFeaturedProducts_np         (not found)
  getBestSellerProducts          (OK: catalog/model/catalog/product.php)
  getLatestProducts              (OK: catalog/model/catalog/product.php)
  getProductsByCategoryId_np     (not found)
  getProductsByKeyword_np        (not found)
  getProductsByManufacturerId_np (not found)
  getProductsByTag_np            (not found)
  getProductSpecials_np          (diff: catalog/model/catalog/product.php)
  
  */

	public function getFeaturedProducts_np($limit) {
		$product_data = $this->cache->get('product.featured.' . $this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $limit);

		if (!$product_data) { 
			$query = $this->db->query("SELECT *, pd.name AS name, p.image, m.name AS manufacturer, ss.name AS stock, (SELECT AVG(r.rating) FROM " . DB_PREFIX . "review r WHERE p.product_id = r.product_id GROUP BY r.product_id) AS rating FROM " . DB_PREFIX . "product_featured f LEFT JOIN " . DB_PREFIX . "product p ON (f.product_id=p.product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (f.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) LEFT JOIN " . DB_PREFIX . "stock_status ss ON (p.stock_status_id = ss.stock_status_id) WHERE p.status = '1' AND p.date_available <= NOW() AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "' LIMIT " . (int)$limit);
	
			$product_data = $query->rows;

			$this->cache->set('product.featured.' . $this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $limit, $product_data);
		}
		
		return $product_data;
	} // getFeaturedProducts_np

	public function getProductsByCategoryId_np($category_id, $sort = 'p.sort_order', $order = 'ASC', $start = 0, $limit = 20) {
		$sql = "
      SELECT * 
        , pd.name AS name 
        , p.image 
        , m.name AS manufacturer
        , ss.name AS stock 
        , (SELECT AVG(r.rating) FROM " . DB_PREFIX . "review r WHERE p.product_id = r.product_id GROUP BY r.product_id) AS rating        
      FROM " . DB_PREFIX . "product p 
      LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) 
      LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) 
      LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) 
      LEFT JOIN " . DB_PREFIX . "stock_status ss ON (p.stock_status_id = ss.stock_status_id) 
      LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id) 
      WHERE 
        p.status = '1' AND 
        p.date_available <= NOW() AND 
        pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND 
        p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND 
        ss.language_id = '" . (int)$this->config->get('config_language_id') . "' AND 
        p2c.category_id = '" . (int)$category_id . "'
    "; 
    // , ucd.unit AS unit
    // LEFT JOIN " . DB_PREFIX . "unit_class_description ucd ON (p.unit_class_id = ucd.unit_class_id) 
		
		$sort_data = array(
			'pd.name',
			'p.sort_order',
			'special',
			'rating',
			'p.price',
			'p.model'
		);
			
		if (in_array($sort, $sort_data)) {
			if ($sort == 'pd.name' || $sort == 'p.model') {
				$sql .= " ORDER BY LCASE(" . $sort . ")";
			} else {
				$sql .= " ORDER BY " . $sort;
			}
		} else {
			$sql .= " ORDER BY p.sort_order";	
		}
			
		if ($order == 'DESC') {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}
		
		if ($start < 0) {
			$start = 0;
		}
		
		$sql .= " LIMIT " . (int)$start . "," . (int)$limit;
		
		$query = $this->db->query($sql);
								  
		return $query->rows;
	} // getProductsByCategoryId_np

	public function getProductsByKeyword_np($keyword, $category_id = 0, $description = FALSE, $model = FALSE, $sort = 'p.sort_order', $order = 'ASC', $start = 0, $limit = 20) {
		if ($keyword) {
						
			$sql = "SELECT *, pd.name AS name, p.image, m.name AS manufacturer, ss.name AS stock, (SELECT AVG(r.rating) FROM " . DB_PREFIX . "review r WHERE p.product_id = r.product_id GROUP BY r.product_id) AS rating FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) LEFT JOIN " . DB_PREFIX . "stock_status ss ON (p.stock_status_id = ss.stock_status_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "'";
			
			if (!$description) {
				$sql .= " AND (LCASE(pd.name) LIKE '%" . $this->db->escape(strtolower($keyword)) . "%'";
			} else {
				$sql .= " AND (LCASE(pd.name) LIKE '%" . $this->db->escape(strtolower($keyword)) . "%' OR LCASE(pd.description) LIKE '%" . $this->db->escape(strtolower($keyword)) . "%'";
			}
			
			if (!$model) {
				$sql .= ")";
			} else {
				$sql .= " OR LCASE(p.model) LIKE '%" . $this->db->escape(strtolower($keyword)) . "%')";
			}
			
			if ($category_id) {
				$data = array();
				
				$this->load->model('catalog/category');
				
				$string = rtrim($this->getPath($category_id), ',');
				
				foreach (explode(',', $string) as $category_id) {
					$data[] = "category_id = '" . (int)$category_id . "'";
				}
				
				$sql .= " AND p.product_id IN (SELECT product_id FROM " . DB_PREFIX . "product_to_category WHERE " . implode(" OR ", $data) . ")";
			}
		
			$sql .= " AND p.status = '1' AND p.date_available <= NOW() GROUP BY p.product_id";
		
			$sort_data = array(
				'pd.name',
				'p.sort_order',
				'special',
				'rating',
				'p.price',
				'p.model'
			);
				
			if (in_array($sort, $sort_data)) {
				if ($sort == 'pd.name' || $sort == 'p.model') {
					$sql .= " ORDER BY LCASE(" . $sort . ")";
				} else {
					$sql .= " ORDER BY " . $sort;
				}
			} else {
				$sql .= " ORDER BY p.sort_order";	
			}
			
			if ($order == 'DESC') {
				$sql .= " DESC";
			} else {
				$sql .= " ASC";
			}

			if ($start < 0) {
				$start = 0;
			}
		
			$sql .= " LIMIT " . (int)$start . "," . (int)$limit;

			$query = $this->db->query($sql);
						
			return $query->rows;
		}
		return 0;	
	} // getProductsByKeyword_np
  
	public function getProductsByManufacturerId_np($manufacturer_id, $sort = 'p.sort_order', $order = 'ASC', $start = 0, $limit = 20) {
		$sql = "SELECT *, pd.name AS name, p.image, m.name AS manufacturer, ss.name AS stock, (SELECT AVG(r.rating) FROM " . DB_PREFIX . "review r WHERE p.product_id = r.product_id GROUP BY r.product_id) AS rating FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) LEFT JOIN " . DB_PREFIX . "stock_status ss ON (p.stock_status_id = ss.stock_status_id) WHERE p.status = '1' AND p.date_available <= NOW() AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "' AND m.manufacturer_id = '" . (int)$manufacturer_id. "'";

		$sort_data = array(
			'pd.name',
			'p.sort_order',
			'special',
			'rating',
			'p.price',
			'p.model'
		);
			
		if (in_array($sort, $sort_data)) {
			if ($sort == 'pd.name' || $sort == 'p.model') {
				$sql .= " ORDER BY LCASE(" . $sort . ")";
			} else {
				$sql .= " ORDER BY " . $sort;
			}
		} else {
			$sql .= " ORDER BY p.sort_order";	
		}
			
		if ($order == 'DESC') {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if ($start < 0) {
			$start = 0;
		}
		
		$sql .= " LIMIT " . (int)$start . "," . (int)$limit;
		
		$query = $this->db->query($sql);
		
		return $query->rows;
	} // getProductsByManufacturerId_np

	public function getProductsByTag_np($tag, $category_id = 0, $sort = 'p.sort_order', $order = 'ASC', $start = 0, $limit = 20) {
		if ($tag) {
		
			$sql = "SELECT *, pd.name AS name, p.image, m.name AS manufacturer, ss.name AS stock, (SELECT AVG(r.rating) FROM " . DB_PREFIX . "review r WHERE p.product_id = r.product_id GROUP BY r.product_id) AS rating FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_tags pt ON (p.product_id = pt.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) LEFT JOIN " . DB_PREFIX . "stock_status ss ON (p.stock_status_id = ss.stock_status_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "'  AND pt.language_id = '" . (int)$this->config->get('config_language_id') . "' AND (LCASE(pt.tag) = '" . $this->db->escape(strtolower($tag)) . "'";

			$keywords = explode(" ", $tag);
						
			foreach ($keywords as $keyword) {
				$sql .= " OR LCASE(pt.tag) = '" . $this->db->escape(strtolower($keyword)) . "'";
			}
			
			$sql .= ")";
			
			if ($category_id) {
				$data = array();
				
				$this->load->model('catalog/category');
				
				$string = rtrim($this->getPath($category_id), ',');
				
				foreach (explode(',', $string) as $category_id) {
					$data[] = "category_id = '" . (int)$category_id . "'";
				}
				
				$sql .= " AND p.product_id IN (SELECT product_id FROM " . DB_PREFIX . "product_to_category WHERE " . implode(" OR ", $data) . ")";
			}
		
			$sql .= " AND p.status = '1' AND p.date_available <= NOW() GROUP BY p.product_id";
		
			$sort_data = array(
				'pd.name',
				'p.sort_order',
				'special',
				'rating',
				'p.price',
				'p.model'
			);
				
			if (in_array($sort, $sort_data)) {
				if ($sort == 'pd.name' || $sort == 'p.model') {
					$sql .= " ORDER BY LCASE(" . $sort . ")";
				} else {
					$sql .= " ORDER BY " . $sort;
				}
			} else {
				$sql .= " ORDER BY p.sort_order";	
			}
			
			if ($order == 'DESC') {
				$sql .= " DESC";
			} else {
				$sql .= " ASC";
			}

			if ($start < 0) {
				$start = 0;
			}
		
			$sql .= " LIMIT " . (int)$start . "," . (int)$limit;
			
			$query = $this->db->query($sql);
			
			$products = array();
			
			foreach ($query->rows as $key => $value) {
				$products[$value['product_id']] = $this->getProduct($value['product_id']);
			}
			
			return $products;
		}
	} // getProductsByTag_np
       
	public function getProductSpecials_np($sort = 'p.sort_order', $order = 'ASC', $start = 0, $limit = 20) {
		if ($this->customer->isLogged()) {
			$customer_group_id = $this->customer->getCustomerGroupId();
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}		

		$sql = "SELECT *, pd.name AS name, p.price, (SELECT ps2.price FROM " . DB_PREFIX . "product_special ps2 WHERE p.product_id = ps2.product_id AND ps2.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps2.date_start = '0000-00-00' OR ps2.date_start < NOW()) AND (ps2.date_end = '0000-00-00' OR ps2.date_end > NOW())) ORDER BY ps2.priority ASC, ps2.price ASC LIMIT 1) AS special, p.image, m.name AS manufacturer, ss.name AS stock, (SELECT AVG(r.rating) FROM " . DB_PREFIX . "review r WHERE p.product_id = r.product_id GROUP BY r.product_id) AS rating FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "product_special ps ON (p.product_id = ps.product_id) LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) LEFT JOIN " . DB_PREFIX . "stock_status ss ON (p.stock_status_id = ss.stock_status_id) WHERE p.status = '1' AND p.date_available <= NOW() AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "' AND ps.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW())AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) AND ps.product_id NOT IN (SELECT pd2.product_id FROM " . DB_PREFIX . "product_discount pd2 WHERE p.product_id = pd2.product_id AND pd2.customer_group_id = '" . (int)$customer_group_id . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW()))) GROUP BY p.product_id";

		$sort_data = array(
			'pd.name',
			'p.sort_order',
			'special',
			'rating',
			'p.price',
			'p.model'
		);
			
		if (in_array($sort, $sort_data)) {
			if ($sort == 'pd.name' || $sort == 'p.model') {
				$sql .= " ORDER BY LCASE(" . $sort . ")";
			} else {
				$sql .= " ORDER BY " . $sort;
			}
		} else {
			$sql .= " ORDER BY p.sort_order";	
		}
			
		if ($order == 'DESC') {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}
		
		if ($start < 0) {
			$start = 0;
		}
		
		$sql .= " LIMIT " . (int)$start . "," . (int)$limit;

		$query = $this->db->query($sql);
		
		return $query->rows;
	}	// getProductSpecials_np
  
  /* FUNCTIONS_NP - END */
          
