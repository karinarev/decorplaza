<?php
class ModelModuleExportproducts extends Model {

	public function getProducts($data = array()) {
		$sql = "SELECT p.*, pd.name FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description as pd ON p.product_id=pd.product_id WHERE p.status='1' AND p.model<>'' AND p.manufacturer_id>0 AND p.export='1' AND pd.language_id='" . (int)$this->config->get('config_language_id') . "'";
		$query = $this->db->query($sql);
		return $query->rows;
	}

	public function getProductManufacturerBoxing($manufacturer_id) {
		$sql = "SELECT m.manufacturer_id_boxing as manufacturer_id FROM " . DB_PREFIX . "manufacturer m WHERE m.manufacturer_id='" . (int)$manufacturer_id . "'";
		$query = $this->db->query($sql);
		return $query->row['manufacturer_id'];
	}

	public function getProductAttribut($product_id) {
		$sql = "SELECT ad.attribute_id_boxing as attribute_id,pa.language_id,pa.text FROM " . DB_PREFIX . "product_attribute pa LEFT JOIN " . DB_PREFIX . "attribute_description as ad ON pa.attribute_id=ad.attribute_id  WHERE pa.product_id='" . (int)$product_id . "' AND ad.language_id='" . (int)$this->config->get('config_language_id') . "'";
		$query = $this->db->query($sql);
		return $query->rows;
	}

	public function getProductDiscount($product_id) {
		$sql = "SELECT pd.customer_group_id,pd.quantity,pd.priority,pd.price,pd.date_start,pd.date_end FROM " . DB_PREFIX . "product_discount pd WHERE pd.product_id='" . (int)$product_id . "'";
		$query = $this->db->query($sql);
		return $query->rows;
	}

	public function getProductImage($product_id) {
		$sql = "SELECT pi.image,pi.sort_order FROM " . DB_PREFIX . "product_image pi WHERE pi.product_id='" . (int)$product_id . "'";
		$query = $this->db->query($sql);
		return $query->rows;
	}

	public function getProductOption($product_id) {
		$sql = "SELECT * FROM " . DB_PREFIX . "product_option po WHERE po.product_id='" . (int)$product_id . "'";
		$query = $this->db->query($sql);
		return $query->rows;
	}
	public function getProductOptionValue($product_option_id,$product_id,$option_id) {
		$sql = "SELECT pov.quantity,pov.subtract,pov.price,pov.price_prefix,pov.points,pov.points_prefix,pov.weight,pov.weight_prefix,ovd.option_value_id_boxing as option_value_id FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value_description as ovd ON pov.option_value_id=ovd.option_value_id WHERE pov.product_id='" . (int)$product_id . "' AND pov.option_id='" . (int)$option_id . "' AND ovd.language_id='" . (int)$this->config->get('config_language_id') . "'";
		$query = $this->db->query($sql);
		return $query->rows;
	}

	public function getProductReward($product_id) {
		$sql = "SELECT pr.customer_group_id,pr.points FROM " . DB_PREFIX . "product_reward pr WHERE pr.product_id='" . (int)$product_id . "'";
		$query = $this->db->query($sql);
		return $query->rows;
	}

	public function getProductSpecial($product_id) {
		$sql = "SELECT ps.customer_group_id,ps.priority,ps.price,ps.date_start,ps.date_end FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id='" . (int)$product_id . "'";
		$query = $this->db->query($sql);
		return $query->rows;
	}

	public function getProductCategory($product_id) {
		$sql = "SELECT ptc.main_category,cd.category_id_boxing as category_id FROM " . DB_PREFIX . "product_to_category ptc LEFT JOIN " . DB_PREFIX . "category_description as cd ON ptc.category_id=cd.category_id WHERE ptc.product_id='" . (int)$product_id . "' AND cd.category_id_boxing>0 AND cd.language_id='" . (int)$this->config->get('config_language_id') . "'";
		$query = $this->db->query($sql);
		return $query->rows;
	}

	public function getProductStore($product_id) {
		$sql = "SELECT pts.store_id FROM " . DB_PREFIX . "product_to_store pts WHERE pts.product_id='" . (int)$product_id . "'";
		$query = $this->db->query($sql);
		return $query->rows;
	}
	   
}
