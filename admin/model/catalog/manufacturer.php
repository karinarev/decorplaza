<?php
class ModelCatalogManufacturer extends Model {
	public function addManufacturer($data) {
      	$this->db->query("INSERT INTO " . DB_PREFIX . "manufacturer SET name = '" . $this->db->escape($data['name']) . "', sort_order = '" . (int)$data['sort_order'] . "', manufacturer_id_boxing = '" . (int)$data['manufacturer_id_boxing'] . "'");
		
		$manufacturer_id = $this->db->getLastId();

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "manufacturer SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");
		}
		
		foreach ($data['manufacturer_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "manufacturer_description SET manufacturer_id = '" . (int)$manufacturer_id . "', language_id = '" . (int)$language_id . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "', seo_title = '" . $this->db->escape($value['seo_title']) . "', seo_h1 = '" . $this->db->escape($value['seo_h1']) . "'");
		}
		
		if (isset($data['manufacturer_store'])) {
			foreach ($data['manufacturer_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "manufacturer_to_store SET manufacturer_id = '" . (int)$manufacturer_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
				
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'manufacturer_id=" . (int)$manufacturer_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		} else {
			$this->load->model('module/deadcow_seo');
			$this->model_module_deadcow_seo->generateManufacturer($manufacturer_id, $data['name'], $this->config->get('deadcow_seo_manufacturers_template'), $this->config->get('config_language'));
		}

		$this->cache->delete('manufacturer');
		return $manufacturer_id;
	}
	
	public function editManufacturer($manufacturer_id, $data) {
      	$this->db->query("UPDATE " . DB_PREFIX . "manufacturer SET name = '" . $this->db->escape($data['name']) . "', manufacturer_id_boxing = '" . (int)$data['manufacturer_id_boxing'] . "',  sort_order = '" . (int)$data['sort_order'] . "' WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "manufacturer SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "manufacturer_description WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");

		foreach ($data['manufacturer_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "manufacturer_description SET manufacturer_id = '" . (int)$manufacturer_id . "', language_id = '" . (int)$language_id . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "', seo_title = '" . $this->db->escape($value['seo_title']) . "', seo_h1 = '" . $this->db->escape($value['seo_h1']) . "'");
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "manufacturer_to_store WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");

		if (isset($data['manufacturer_store'])) {
			foreach ($data['manufacturer_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "manufacturer_to_store SET manufacturer_id = '" . (int)$manufacturer_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
			
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'manufacturer_id=" . (int)$manufacturer_id. "'");
		
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'manufacturer_id=" . (int)$manufacturer_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		} else {
			$this->load->model('module/deadcow_seo');
			$this->model_module_deadcow_seo->generateManufacturer($manufacturer_id, $data['name'], $this->config->get('deadcow_seo_manufacturers_template'), $this->config->get('config_language'));
		}

		$this->cache->delete('manufacturer');
		return $manufacturer_id;
	}
	
	public function editManufacturerCategory($manufacturer_id, $category_id, $data) {
      	//$this->db->query("UPDATE " . DB_PREFIX . "manufacturer SET name = '" . $this->db->escape($data['name']) . "', sort_order = '" . (int)$data['sort_order'] . "' WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");

		
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "manufacturer_category_description WHERE manufacturer_id = '" . (int)$manufacturer_id . "' AND  category_id = '" . (int)$category_id . "'");

		foreach ($data['manufacturer_category_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "manufacturer_category_description SET manufacturer_id = '" . (int)$manufacturer_id . "', category_id = '" . (int)$category_id . "', language_id = '" . (int)$language_id . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "', seo_title = '" . $this->db->escape($value['seo_title']) . "', seo_h1 = '" . $this->db->escape($value['seo_h1']) . "'");
		}
		
		//$this->db->query("DELETE FROM " . DB_PREFIX . "manufacturer_to_store WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");

		/*if (isset($data['manufacturer_store'])) {
			foreach ($data['manufacturer_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "manufacturer_to_store SET manufacturer_id = '" . (int)$manufacturer_id . "', store_id = '" . (int)$store_id . "'");
			}
		}*/
			
		//$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'manufacturer_id=" . (int)$manufacturer_id. "'");
		
		/*if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'manufacturer_id=" . (int)$manufacturer_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		} else {
			$this->load->model('module/deadcow_seo');
			$this->model_module_deadcow_seo->generateManufacturer($manufacturer_id, $data['name'], $this->config->get('deadcow_seo_manufacturers_template'), $this->config->get('config_language'));
		}*/

		$this->cache->delete('manufacturer_category');
		return $manufacturer_id;
	}
	
	public function deleteManufacturer($manufacturer_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "manufacturer WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "manufacturer_description WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "manufacturer_to_store WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'manufacturer_id=" . (int)$manufacturer_id . "'");
			
		$this->cache->delete('manufacturer');
	}	
	
	public function getManufacturer($manufacturer_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'manufacturer_id=" . (int)$manufacturer_id . "') AS keyword FROM " . DB_PREFIX . "manufacturer WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");
		
		return $query->row;
	}
	
	public function getManufacturerCategoryDescriptions($manufacturer_id,$category_id) {
		$manufacturer_category_description_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "manufacturer_category_description WHERE manufacturer_id = '" . (int)$manufacturer_id . "' AND category_id = '" . (int)$category_id . "'");
		
		foreach ($query->rows as $result) {
			$manufacturer_category_description_data[$result['language_id']] = array(
				'seo_title'        => $result['seo_title'],
				'seo_h1'           => $result['seo_h1'],
                'meta_keyword'     => $result['meta_keyword'],
				'meta_description' => $result['meta_description'],
				'description'      => $result['description']
			);
		}
		
		return $manufacturer_category_description_data;
	}	
	
	public function getManufacturers($data = array()) {
			$sql = "SELECT * FROM " . DB_PREFIX . "manufacturer";
			
			$sort_data = array(
				'name',
				'sort_order'
			);	
			
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];	
			} else {
				$sql .= " ORDER BY name";	
			}
			
			if (isset($data['order']) && ($data['order'] == 'DESC')) {
				$sql .= " DESC";
			} else {
				$sql .= " ASC";
			}
			
			if (isset($data['start']) || isset($data['limit'])) {
				if ($data['start'] < 0) {
					$data['start'] = 0;
				}					

				if ($data['limit'] < 1) {
					$data['limit'] = 20;
				}	
			
				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			}				
			
			$query = $this->db->query($sql);
		
			return $query->rows;
	}
	
	public function getManufacturerStores($manufacturer_id) {
		$manufacturer_store_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "manufacturer_to_store WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");

		foreach ($query->rows as $result) {
			$manufacturer_store_data[] = $result['store_id'];
		}
		
		return $manufacturer_store_data;
	}
	
	public function getTotalManufacturersByImageId($image_id) {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "manufacturer WHERE image_id = '" . (int)$image_id . "'");

		return $query->row['total'];
	}

	public function getTotalManufacturers() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "manufacturer");
		
		return $query->row['total'];
	}	

	public function getManufacturerDescriptions($manufacturer_id) {
		$manufacturer_description_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "manufacturer_description WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");
		
		foreach ($query->rows as $result) {
			$manufacturer_description_data[$result['language_id']] = array(
				'seo_title'        => $result['seo_title'],
				'seo_h1'           => $result['seo_h1'],
				'meta_keyword'     => $result['meta_keyword'],
				'meta_description' => $result['meta_description'],
				'description'      => $result['description']
			);
		}
		
		return $manufacturer_description_data;
	}	
	
	public function getCountProductManufacturerCategory($manufacturer_id,$catId) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category ptc LEFT JOIN " . DB_PREFIX . "product p ON (ptc.product_id = p.product_id) 
		WHERE ptc.category_id = ".(int)$catId." AND p.manufacturer_id = ".(int)$manufacturer_id." AND p.status=1");
		
		return count($query->rows);
	}
	
	public function getProductManufacturerUrl($manufacturer_id,$catId) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE query = 'manufacturer_id=" . $manufacturer_id . "&catId=" . $catId . "'");
	
		return count($query->rows);
	}
	public function addProductManufacturerUrl($manufacturer_id,$catId) {
		$queryCatUrl = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE query='category_id=".(int)$catId."'");
		$CatUrl = $queryCatUrl->rows[0]['keyword'];
		$queryManufactuterUrl = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE query='manufacturer_id=".(int)$manufacturer_id."'");
		$ManufactuterUrl = $queryManufactuterUrl->rows[0]['keyword'];
		$ManufactuterCatUrl = $CatUrl."-".$ManufactuterUrl;
		$query = $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'manufacturer_id=".(int)$manufacturer_id."&catId=".(int)$catId."', keyword='".$ManufactuterCatUrl."'");

	
	
	
		return $manufacturer_id;
	}
	public function delProductManufacturerUrl($manufacturer_id,$catId) {
		$query = $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'manufacturer_id=" . $manufacturer_id . "&catId=" . $catId . "'");
		
	}
	
	public function repair_url_manufacturer_categories($manufacturers,$categorys) {
			foreach ($manufacturers as $manufacturer) {
				foreach ($categorys as $category) {
					
					if ($this->getProductManufacturerUrl($manufacturer['manufacturer_id'],$category['category_id']) > 0) {
						if ($this->getCountProductManufacturerCategory($manufacturer['manufacturer_id'],$category['category_id']) <= 0) {
							$this->delProductManufacturerUrl((int)$manufacturer['manufacturer_id'],(int)$category['category_id']);
						}
					} else {
						if ($this->getCountProductManufacturerCategory($manufacturer['manufacturer_id'],$category['category_id']) > 0) {
							$this->addProductManufacturerUrl($manufacturer['manufacturer_id'],$category['category_id']);
						} 
					}
				}
			}
	}
}
?>
