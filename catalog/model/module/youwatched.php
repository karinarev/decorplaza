<?php
class ModelModuleYouwatched extends Model {
	
	
	public function getProductOptions($product_id) {
		$product_option_data = array();
		
		$product_option_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN " . DB_PREFIX . "option_description od ON (o.option_id = od.option_id) WHERE po.product_id = '" . (int)$product_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY o.sort_order");
		
		foreach ($product_option_query->rows as $product_option) {
			if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
				$product_option_value_data = array();	
				
				$product_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.product_option_id = '" . (int)$product_option['product_option_id'] . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY ov.sort_order");
				
				foreach ($product_option_value_query->rows as $product_option_value) {
					$product_option_value_data[] = array(
						'product_option_value_id' => $product_option_value['product_option_value_id'],
						'option_value_id'         => $product_option_value['option_value_id'],
						'name'                    => $product_option_value['name'],
						'image'                   => $product_option_value['image'],
						'quantity'                => $product_option_value['quantity'],
						'subtract'                => $product_option_value['subtract'],
						'price'                   => $product_option_value['price'],
						'price_prefix'            => $product_option_value['price_prefix'],
						'points'                  => $product_option_value['points'],
						'points_prefix'           => $product_option_value['points_prefix'],						
						'weight'                  => $product_option_value['weight'],
						'weight_prefix'           => $product_option_value['weight_prefix']					
					);
				}
				
				$product_option_data[] = array(
					'product_option_id'    => $product_option['product_option_id'],
					'option_id'            => $product_option['option_id'],
					'name'                 => $product_option['name'],
					'type'                 => $product_option['type'],
					'product_option_value' => $product_option_value_data,
					'required'             => $product_option['required']
				);				
			} else {
				$product_option_data[] = array(
					'product_option_id' => $product_option['product_option_id'],
					'option_id'         => $product_option['option_id'],
					'name'              => $product_option['name'],
					'type'              => $product_option['type'],
					'option_value'      => $product_option['option_value'],
					'required'          => $product_option['required']
				);				
			}
		}	
		
		return $product_option_data;
	}
	
	
    public function getProduct($product_id) {
        if ($this->customer->isLogged()) {
            $customer_group_id = $this->customer->getCustomerGroupId();
        } else {
            $customer_group_id = $this->config->get('config_customer_group_id');
        }

        $product_info = $this->cache->get('youwatched-product' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . (int)$customer_group_id . '.' . $product_id);
        if (!$product_info){
            $query = $this->db->query("SELECT DISTINCT *, pd.name AS name, p.image, m.name AS manufacturer, (SELECT price FROM " . DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . (int)$customer_group_id . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, (SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special, (SELECT points FROM " . DB_PREFIX . "product_reward pr WHERE pr.product_id = p.product_id AND customer_group_id = '" . (int)$customer_group_id . "') AS reward, (SELECT ss.name FROM " . DB_PREFIX . "stock_status ss WHERE ss.stock_status_id = p.stock_status_id AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "') AS stock_status, (SELECT wcd.unit FROM " . DB_PREFIX . "weight_class_description wcd WHERE p.weight_class_id = wcd.weight_class_id AND wcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS weight_class, (SELECT lcd.unit FROM " . DB_PREFIX . "length_class_description lcd WHERE p.length_class_id = lcd.length_class_id AND lcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS length_class, (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating, (SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review r2 WHERE r2.product_id = p.product_id AND r2.status = '1' GROUP BY r2.product_id) AS reviews, p.sort_order FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) WHERE p.product_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");

            if ($query->num_rows) {
                $query->row['price'] = ($query->row['discount'] ? $query->row['discount'] : $query->row['price']);
                $query->row['rating'] = (int)$query->row['rating'];

                $this->cache->set('youwatched-product.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . (int)$customer_group_id . '.' . $product_id, $query->row);
                return $query->row;
            } else {
                return false;
            }
        }
    }

    public function getProducts($data = array()) {
        if ($this->customer->isLogged()) {
            $customer_group_id = $this->customer->getCustomerGroupId();
        } else {
            $customer_group_id = $this->config->get('config_customer_group_id');
        }

        $cache = md5(http_build_query($data));

        $product_data = $this->cache->get('youwatched' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . (int)$customer_group_id . '.' . $cache);
	
       
        if (!$product_data) {
            $product_data = array();
            $sql = "SELECT p.product_id, (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id)" ;

            if (!empty($data['filter_category_id'])) $sql .= " LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id)";

            
             $tmp = array();
	        if($data['product_ids'])
	        {
	        	foreach ($data['product_ids'] as $item)
	        	{
	        		if($item)
	        			$tmp[] = intval($item);
	        	}
	        }
	        $data['product_ids'] = $tmp;
            
            $sql .= " WHERE p.product_id in ( " . implode(', ', $data['product_ids']) . ") and pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";

            if (!empty($data['filter_category_id'])) {
                if (!empty($data['filter_sub_category'])) {
                    $implode_data = array();

                    $implode_data[] = "p2c.category_id = '" . (int)$data['filter_category_id'] . "'";

                    $this->load->model('catalog/category');

                    foreach ($data['filter_sub_category'] as $category_id) {
                        $implode_data[] = "p2c.category_id = '" . (int)$category_id . "'";
                    }

                    $sql .= " AND (" . implode(' OR ', $implode_data) . ")";
                } else {
                    $sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";
                }
            }

            $sql .= " GROUP BY p.product_id";

            if (isset($data['start']) || isset($data['limit'])) {
                if ($data['start'] < 0) $data['start'] = 0;
                if ($data['limit'] < 1) $data['limit'] = 20;

                $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
            }

            $query = $this->db->query($sql);

            foreach($query->rows as $result){
                $product_data[$result['product_id']] = $this->getProduct($result['product_id']);
                $product_data[$result['product_id']]['option'] = $this->getProductOptions($result['product_id']);
            }

            $this->cache->set('youwatched.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . (int)$customer_group_id . '.' . $cache, $product_data);
        }

        return $product_data;
    }

    public function getCategoriesByParentId($category_id, $need_level = 1) {
        static $category_level = 0;
        $category_level++;
        $category_data = array();

        $category_query = $this->cache->get('youwatched-cats.' . $category_id);

        if (!$category_query){
            $category_query = $this->db->query("SELECT category_id FROM " . DB_PREFIX . "category WHERE parent_id = '" . (int)$category_id . "'");
            $this->cache->set('youwatched-cats.' . $category_id, $category_query);
        }

        foreach ($category_query->rows as $category) {
            if ($category_level < $need_level){
                $category_data[] = $category['category_id'];
                $children = $this->getCategoriesByParentId($category['category_id'], $need_level);
                if ($children) {
                    $category_data = array_merge($children, $category_data);
                }
            }
        }
        $category_level--;
        return $category_data;
    }

    public function getPathByCategory($category_id) {
        $category_id = (int)$category_id;
        if ($category_id < 1) return false;

        static $path = null;
        if (!is_array($path)) {
            $path = $this->cache->get('category.seopath');
            if (!is_array($path)) $path = array();
        }

        if (!isset($path[$category_id])) {
            $max_level = 10;

            $sql = "SELECT CONCAT_WS('_'";
            for ($i = $max_level-1; $i >= 0; --$i) {
                $sql .= ",t$i.category_id";
            }
            $sql .= ") AS path FROM " . DB_PREFIX . "category t0";
            for ($i = 1; $i < $max_level; ++$i) {
                $sql .= " LEFT JOIN " . DB_PREFIX . "category t$i ON (t$i.category_id = t" . ($i-1) . ".parent_id)";
            }
            $sql .= " WHERE t0.category_id = '" . $category_id . "'";

            $query = $this->db->query($sql);

            $path[$category_id] = $query->num_rows ? $query->row['path'] : false;

            $this->cache->set('category.seopath', $path);
        }
        return $path[$category_id];
    }
}
?>
