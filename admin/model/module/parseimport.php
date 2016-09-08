<?php
class ModelModuleParseimport extends Model {
	
	public function Upload($file) {
		$text = file_get_contents ($file);
		$products = explode("@",$text);
		foreach ($products as $key => $value) {
			$product = explode(";",$value);
			if ($this->checkProduct($product[2])) {
				//var_dump($product[2]);
			} else {
				$this->insertProduct($product);
			}
			
		}
		
		exit;
	}

	public function checkProduct($model) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product WHERE model = '" . $model . "'");
		if (count($query->rows) > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getManufacturer_id($manufacturer) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "manufacturer WHERE name = '" . $manufacturer . "'");
		if (count($query->rows) > 0) {
			return $query->row['manufacturer_id'];
		} else {
			return false;
		}
	}

	public function getCategory_id($category) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category_description WHERE name = '" . $category . "'");
		if (count($query->rows) > 0) {
			return $query->row['category_id'];
		} else {
			return false;
		}
	}

	public function getParentCategory($category_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category WHERE category_id = '" . $category_id . "'");
		return $query->row['parent_id'];
		
	}

	public function getOptionValue($option) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "option_value_description WHERE name = '" . $option . "'");
		if (count($query->rows) > 0) {
			return $query->row['option_value_id'];
		} else {
			return false;
		}
		
	}

	public function insertProduct($product) {
		if ($this->getManufacturer_id($product[3]) > 0) {
			$manufacturer_id = $this->getManufacturer_id($product[3]);
			$manufacturer_query = ", manufacturer_id = '" . (int)$manufacturer_id . "'";
		} else {
			$manufacturer_query = "";
		}

		//product
		$this->db->query("INSERT INTO " . DB_PREFIX . "product SET model = '" . $this->db->escape($product[2]) . "',sku = '" . $this->db->escape($product[8]) . "', quantity = '99', stock_status_id = '7', date_available = '" . date('Y-m-d h:i:s') . "'" . $manufacturer_query . ", shipping = '1', price = '" . round((float)$product[4]*1.1/50)*50 . "', sort_order = '1', status = '1', date_added = '" . date('Y-m-d h:i:s') . "', date_modified = '" . date('Y-m-d h:i:s') . "'");
		$product_id = $this->db->getLastId();

		//image
		if (strlen($product[7]) > 0) {
			$images = explode(",",$product[7]);
			$this->db->query("UPDATE " . DB_PREFIX . "product SET image = '" . $this->db->escape($images[0]) . "' WHERE product_id = '" . (int)$product_id . "'");
			if (count($images) > 1) {
				$i = 0;
				foreach ($images as $key => $image) {
					if ($key > 0) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "product_image SET product_id = '" . (int)$product_id . "', image = '" . $this->db->escape($image) . "', sort_order = '" . (int)$i . "'");
						$i++;
					}
				}
			}
		}

		//description
		if (strlen($product[5]) > 0) {
			$razmer = explode(",",$product[5]);
			if (count($razmer) == 1) {
				//$get_my_title = $this->db->escape($product[0])." ".$this->rus2translit(str_replace(" ", "_", $razmer[0])); 
				$get_my_title = $this->db->escape($product[0])." ".$razmer[0]; 
			} else {
				$get_my_title = $this->db->escape($product[0]);
			}
		} else {
			$get_my_title = $this->db->escape($product[0]); 
		}
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "product_description SET product_id = '" . (int)$product_id . "', language_id = '1', name = '" . $get_my_title . "'");
		$this->db->query("INSERT INTO " . DB_PREFIX . "product_description SET product_id = '" . (int)$product_id . "', language_id = '2', name = '" . $get_my_title . "'");

		//category
		if ($this->getCategory_id($product[1]) > 0) {
			$category_id = $this->getCategory_id($product[1]);
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int)$product_id . "', category_id = '" . (int)$category_id . "', main_category='1'");
			if ($this->getParentCategory($category_id) > 0) {
				$parent_id = $this->getParentCategory($category_id);
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int)$product_id . "', category_id = '" . (int)$parent_id . "'");
			}
		} else {
			
		}
		
		//store
		$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_store SET product_id = '" . (int)$product_id . "', store_id = '0'");


		//размер
		if (strlen($product[5]) > 0) {
			$options = explode(",",$product[5]);
			$option_id = 13;
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_id = '" . (int)$product_id . "', option_id = '" . (int)$option_id . "', required = '1'");
			$product_option_id = $this->db->getLastId();
			foreach ($options as $key => $option) {
				if ($this->getOptionValue($option) > 0) {
					$option_value_id = $this->getOptionValue($option);

					$this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_id = '" . (int)$product_option_id . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$option_id . "', option_value_id = '" . (int)$option_value_id . "', quantity = '1', subtract = '0', price = '0.0000', price_prefix = '+', points = '0', points_prefix = '+', weight = '0.00000000', weight_prefix = '+'");
				}	
			}
		}

		//цвет
		if (strlen($product[6]) > 0) {
			$options = explode(",",$product[6]);
			$option_id = 14;
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_id = '" . (int)$product_id . "', option_id = '" . (int)$option_id . "', required = '1'");
			$product_option_id = $this->db->getLastId();
			foreach ($options as $key => $option) {
				if ($this->getOptionValue($option) > 0) {
					$option_value_id = $this->getOptionValue($option);

					$this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_id = '" . (int)$product_option_id . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$option_id . "', option_value_id = '" . (int)$option_value_id . "', quantity = '1', subtract = '0', price = '0.0000', price_prefix = '+', points = '0', points_prefix = '+', weight = '0.00000000', weight_prefix = '+'");
				}	
			}
		}

		//SEO URL
		$this->load->model('module/deadcow_seo');
		$productModel = $product[2];
		$productManufr = $manufacturer_id;
		if ($get_my_title) {
			$this->model_module_deadcow_seo->generateProduct($product_id, $get_my_title, $productModel, $productManufr, $this->config->get('deadcow_seo_products_template'), $this->config->get('config_language'));
		}
		$this->cache->delete('product');

		//var_dump($product_id);
		//exit;
	}

	public function rus2translit($string) {
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
	}

	


	
}
