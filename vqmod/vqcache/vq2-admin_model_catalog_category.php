<?php
class ModelCatalogCategory extends Model {
	public function addCategory($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "category SET parent_id = '" . (int)$data['parent_id'] . "', `top` = '" . (isset($data['top']) ? (int)$data['top'] : 0) . "', `column` = '" . (int)$data['column'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW(), date_added = NOW()");
	
		$category_id = $this->db->getLastId();
		
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "category SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		
		$categoryName = '';
		foreach ($data['category_description'] as $language_id => $value) {
			if ($language_id == $this->config->get('config_language_id')){
				$categoryName = $value['name'];
			}
			$this->db->query("INSERT INTO " . DB_PREFIX . "category_description SET category_id = '" . (int)$category_id . "', language_id = '" . (int)$language_id . "', category_id_boxing = '" . (int)$data['category_id_boxing'] . "', name = '" . $this->db->escape($value['name']) . "', namer = '" . $this->db->escape($value['namer']) . "', namev = '" . $this->db->escape($value['namev']) . "', named = '" . $this->db->escape($value['named']) . "', sinonim1 = '" . $this->db->escape($value['sinonim1']) . "', sinonim2 = '" . $this->db->escape($value['sinonim2']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "', seo_title = '" . $this->db->escape($value['seo_title']) . "', sizetable = '" . $this->db->escape($value['sizetable']) . "', seo_h1 = '" . $this->db->escape($value['seo_h1']) . "'");
		}
		
		if (isset($data['category_store'])) {
			foreach ($data['category_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "category_to_store SET category_id = '" . (int)$category_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		if (isset($data['category_layout'])) {
			foreach ($data['category_layout'] as $store_id => $layout) {
				if ($layout['layout_id']) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "category_to_layout SET category_id = '" . (int)$category_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout['layout_id'] . "'");
				}
			}
		}

		$this->db->query("INSERT    INTO    `"    .    DB_PREFIX    .    "category_path`    SET    `category_id`    =    '"    .    (int)$category_id    .    "',    `path_id`    =    '"    .    (int)$category_id    .    "',    `level`    =    '"    .    (int)$level    .    "'");

		if    (isset($data['category_filter']))    {
			foreach    ($data['category_filter']    as    $filter_id)    {
				$this->db->query("INSERT    INTO    "    .    DB_PREFIX    .    "category_filter    SET    category_id    =    '"    .    (int)$category_id    .    "',    filter_id    =    '"    .    (int)$filter_id    .    "'");
			}
		}
						
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'category_id=" . (int)$category_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		} else {
			$this->load->model('module/deadcow_seo');
			if ($categoryName) {
				$this->model_module_deadcow_seo->generateCategory($category_id, $categoryName, $this->config->get('deadcow_seo_categories_template'), $this->config->get('config_language'));
			}
		}
		
		$this->cache->delete('category');

        
		$this->cache->delete('seo_pro');
        
      
		return $category_id;
	}
	
	public function editCategory($category_id, $data) {

		$this->db->query("UPDATE " . DB_PREFIX . "category SET parent_id = '" . (int)$data['parent_id'] . "', `top` = '" . (isset($data['top']) ? (int)$data['top'] : 0) . "', `column` = '" . (int)$data['column'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE category_id = '" . (int)$category_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "category SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE category_id = '" . (int)$category_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "category_description WHERE category_id = '" . (int)$category_id . "'");

		$categoryName = '';
		foreach ($data['category_description'] as $language_id => $value) {
			if ($language_id == $this->config->get('config_language_id')){
				$categoryName = $value['name'];
			}
			$this->db->query("INSERT INTO " . DB_PREFIX . "category_description SET category_id = '" . (int)$category_id . "', language_id = '" . (int)$language_id . "', category_id_boxing = '" . (int)$data['category_id_boxing'] . "', name = '" . $this->db->escape($value['name']) . "',  namer = '" . $this->db->escape($value['namer']) . "', namev = '" . $this->db->escape($value['namev']) . "', named = '" . $this->db->escape($value['named']) . "', sinonim1 = '" . $this->db->escape($value['sinonim1']) . "', sinonim2 = '" . $this->db->escape($value['sinonim2']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "', seo_title = '" . $this->db->escape($value['seo_title']) . "',  sizetable = '" . $this->db->escape($value['sizetable']) . "', seo_h1 = '" . $this->db->escape($value['seo_h1']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "category_to_store WHERE category_id = '" . (int)$category_id . "'");

		if (isset($data['category_store'])) {
			foreach ($data['category_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "category_to_store SET category_id = '" . (int)$category_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "category_to_layout WHERE category_id = '" . (int)$category_id . "'");

		if (isset($data['category_layout'])) {
			foreach ($data['category_layout'] as $store_id => $layout) {
				if ($layout['layout_id']) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "category_to_layout SET category_id = '" . (int)$category_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout['layout_id'] . "'");
				}
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'category_id=" . (int)$category_id. "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'category_id=" . (int)$category_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		} else {
			$this->load->model('module/deadcow_seo');
			if ($categoryName) {
				$this->model_module_deadcow_seo->generateCategory($category_id, $categoryName, $this->config->get('deadcow_seo_categories_template'), $this->config->get('config_language'));
			}
		}

		$this->db->query("DELETE    FROM    "    .    DB_PREFIX    .    "category_filter    WHERE    category_id    =    '"    .    (int)$category_id    .    "'");

		if    (isset($data['category_filter']))    {
			foreach    ($data['category_filter']    as    $filter_id)    {
				$this->db->query("INSERT    INTO    "    .    DB_PREFIX    .    "category_filter    SET    category_id    =    '"    .    (int)$category_id    .    "',    filter_id    =    '"    .    (int)$filter_id    .    "'");
			}
		}

		$this->cache->delete('category');

        
		$this->cache->delete('seo_pro');
        
      
		return $category_id;
	}
	
	public function deleteCategory($category_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "category WHERE category_id = '" . (int)$category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "category_description WHERE category_id = '" . (int)$category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "category_filter WHERE category_id = '" . (int)$category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "category_to_store WHERE category_id = '" . (int)$category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "category_to_layout WHERE category_id = '" . (int)$category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE category_id = '" . (int)$category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'category_id=" . (int)$category_id . "'");
		
		$query = $this->db->query("SELECT category_id FROM " . DB_PREFIX . "category WHERE parent_id = '" . (int)$category_id . "'");

		foreach ($query->rows as $result) {
			$this->deleteCategory($result['category_id']);
		}
		
		$this->cache->delete('category');

        
		$this->cache->delete('seo_pro');
        
      
	} 

	public function getCategory($category_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'category_id=" . (int)$category_id . "') AS keyword FROM " . DB_PREFIX . "category WHERE category_id = '" . (int)$category_id . "'");
		
		return $query->row;
	} 
	
	public function getCategories($parent_id = 0,$sortname=0) {
		$category_data = $this->cache->get('category.' . (int)$this->config->get('config_language_id') . '.' . (int)$parent_id);
	
		if (!$category_data) {
			$category_data = array();
			
			if ($sortname == 0) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY c.sort_order, cd.name ASC");
				foreach ($query->rows as $result) {
					$category_data[] = array(
						'category_id' => $result['category_id'],
						'name'        => $this->getPath($result['category_id'], $this->config->get('config_language_id')),
						'status'  	  => $result['status'],
						'sort_order'  => $result['sort_order']
					);
				
					$category_data = array_merge($category_data, $this->getCategories($result['category_id']));
				}
			} elseif ($sortname == 1) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY cd.name");
				foreach ($query->rows as $result) {
					$category_data[] = array(
						'category_id' => $result['category_id'],
						'name'        => $this->getPath($result['category_id'], $this->config->get('config_language_id'),1),
						'status'  	  => $result['status'],
						'sort_order'  => $result['sort_order']
					);
				
					$category_data = array_merge($category_data, $this->getCategories($result['category_id'],1));
				}
			}
				
	
			$this->cache->set('category.' . (int)$this->config->get('config_language_id') . '.' . (int)$parent_id, $category_data);
		}
		
		return $category_data;
	}
		
	public function getPath($category_id,$sortname=0) {
		if ($sortname == 0) {
			$query = $this->db->query("SELECT name, parent_id FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) WHERE c.category_id = '" . (int)$category_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY c.sort_order, cd.name ASC");
		} elseif ($sortname == 1) {
			$query = $this->db->query("SELECT name, parent_id FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) WHERE c.category_id = '" . (int)$category_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY cd.name ASC");
		}
		if ($query->row['parent_id']) {
			return $this->getPath($query->row['parent_id'], $this->config->get('config_language_id')) . $this->language->get('text_separator') . $query->row['name'];
		} else {
			return $query->row['name'];
		}
	}
		
	public function getCategoryDescriptions($category_id) {
		$category_description_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category_description WHERE category_id = '" . (int)$category_id . "'");
		
		foreach ($query->rows as $result) {
			$category_description_data[$result['language_id']] = array(
				'category_id_boxing' => $result['category_id_boxing'],
				'seo_title'        => $result['seo_title'],
				'seo_h1'           => $result['seo_h1'],
				'name'             => $result['name'],
				'namer'            => $result['namer'],
				'namev'            => $result['namev'],
				'named'            => $result['named'],
				'sizetable'        => $result['sizetable'],
				'sinonim1'         => $result['sinonim1'],
				'sinonim2'         => $result['sinonim2'],
				'meta_keyword'     => $result['meta_keyword'],
				'meta_description' => $result['meta_description'],
				'description'      => $result['description']
			);
		}
		
		return $category_description_data;
	}

	public function getCategoryFilters ( $category_id ){
		$category_filter_data    =    array();

		$query    =    $this->db->query("SELECT    *    FROM    "    .    DB_PREFIX    .    "category_filter    WHERE    category_id    =    '"    .    (int)$category_id    .    "'");

		foreach    ($query->rows    as    $result)    {
			$category_filter_data[]    =    $result['filter_id'];
		}

		return    $category_filter_data;
	}


	public function getCategoryStores($category_id) {
		$category_store_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category_to_store WHERE category_id = '" . (int)$category_id . "'");

		foreach ($query->rows as $result) {
			$category_store_data[] = $result['store_id'];
		}
		
		return $category_store_data;
	}

	public function getCategoryLayouts($category_id) {
		$category_layout_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category_to_layout WHERE category_id = '" . (int)$category_id . "'");
		
		foreach ($query->rows as $result) {
			$category_layout_data[$result['store_id']] = $result['layout_id'];
		}
		
		return $category_layout_data;
	}
		
	public function getTotalCategories() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "category");
		
		return $query->row['total'];
	}	
		
	public function getTotalCategoriesByImageId($image_id) {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "category WHERE image_id = '" . (int)$image_id . "'");
		
		return $query->row['total'];
	}

	public function getTotalCategoriesByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "category_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}		

	public function getCategoriesByParentId($parent_id = 0) {
		$query = $this->db->query("SELECT *, (SELECT COUNT(parent_id) FROM " . DB_PREFIX . "category WHERE parent_id = c.category_id) AS children FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY c.sort_order, cd.name");
		
		return $query->rows;
	}

	public function getAllCategories() {
		$category_data = $this->cache->get('category.all.' . $this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id'));

		if (!$category_data || !is_array($category_data)) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  ORDER BY c.parent_id, c.sort_order, cd.name");

			$category_data = array();
			foreach ($query->rows as $row) {
				$category_data[$row['parent_id']][$row['category_id']] = $row;
			}

			$this->cache->set('category.all.' . $this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id'), $category_data);
		}

		return $category_data;
	}
}
?>
