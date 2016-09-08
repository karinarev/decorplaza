<?php
class ControllerModuleExportproducts extends Controller {
	private $eol = "\n";

	public function index() {
		$data = $this->getData();
		Header('Content-Type: application/xml');
		print_r($this->getXml($data));
		//var_dump($data);
	}

	private function getData() {

		$this->load->model('module/exportproducts');	
		$products = $this->model_module_exportproducts->getProducts();
		$data = array();
		$models = array();
		//основной цикл перебора всех товаров
		foreach ($products as $product) {
			$models[] = $product['model'];
			$product_id = $product['product_id'];
			$data[$product_id]['model'] = $product['model'];
			$data[$product_id]['sku'] = $this->getNull($product['sku']);
			$data[$product_id]['upc'] = $this->getNull($product['upc']);
			$data[$product_id]['ean'] = $this->getNull($product['ean']);
			$data[$product_id]['jan'] = $this->getNull($product['jan']);
			$data[$product_id]['isbn'] = $this->getNull($product['isbn']);
			$data[$product_id]['mpn'] = $this->getNull($product['mpn']);
			$data[$product_id]['location'] = $this->getNull($product['location']);
			$data[$product_id]['quantity'] = $this->getNull($product['quantity']);
			$data[$product_id]['stock_status_id'] = $this->getNull($product['stock_status_id']);
			$data[$product_id]['image'] = $this->getNull($product['image']);

			//получение соответствующего производителя
			$manufacturer_id = $this->model_module_exportproducts->getProductManufacturerBoxing($product['manufacturer_id']);
			$data[$product_id]['manufacturer_id'] = $manufacturer_id;

			$data[$product_id]['shipping'] = $product['shipping'];
			$data[$product_id]['price'] = $product['price'];
			$data[$product_id]['points'] = $product['points'];
			$data[$product_id]['tax_class_id'] = $product['tax_class_id'];
			$data[$product_id]['date_available'] = $product['date_available'];
			$data[$product_id]['weight'] = $product['weight'];
			$data[$product_id]['weight_class_id'] = $product['weight_class_id'];
			$data[$product_id]['length'] = $product['length'];
			$data[$product_id]['length_class_id'] = $product['length_class_id'];
			$data[$product_id]['width'] = $product['width'];
			$data[$product_id]['height'] = $product['height'];
			$data[$product_id]['subtract'] = $product['subtract'];
			$data[$product_id]['minimum'] = $product['minimum'];
			$data[$product_id]['sort_order'] = $product['sort_order'];
			$data[$product_id]['status'] = $product['status'];
			$data[$product_id]['date_added'] = $product['date_added'];
			$data[$product_id]['date_modified'] = $product['date_modified'];
			$data[$product_id]['name'] = htmlspecialchars($product['name']);

			//получение атрибутов товара
			$attribute = $this->model_module_exportproducts->getProductAttribut($product_id);
			$data[$product_id]['attribute'] = $attribute;

			//получение скидок товара
			$discount = $this->model_module_exportproducts->getProductDiscount($product_id);
			$data[$product_id]['discount'] = $discount;

			//получение изображений товара
			$image = $this->model_module_exportproducts->getProductImage($product_id);
			$data[$product_id]['images'] = $image;

			//получение опций товара
			$options = $this->model_module_exportproducts->getProductOption($product_id);
			
			$newoptions = array();
			foreach ($options as $key => $value) {
				$option = array();
				$option['required'] = $value['required'];
				$option['option_id'] = $value['option_id'];
				$product_option_id = $value['product_option_id'];
				$product_option_value = $this->model_module_exportproducts->getProductOptionValue($product_option_id,$product_id,$value['option_id']);
				$option['product_option_value'] = $product_option_value;
				$newoptions[] = $option;
			}
			$data[$product_id]['option'] = $newoptions;

			//получение бонусных баллов товара
			$reward = $this->model_module_exportproducts->getProductReward($product_id);
			$data[$product_id]['reward'] = $reward;

			//получение акций товара
			$special = $this->model_module_exportproducts->getProductSpecial($product_id);
			$data[$product_id]['special'] = $special;

			//получение категорий товара
			$category = $this->model_module_exportproducts->getProductCategory($product_id);
			$data[$product_id]['category'] = $category;

			//получение магазинов товара
			$store = $this->model_module_exportproducts->getProductStore($product_id);
			$data[$product_id]['store'] = $store;
			//break;
		}
		$models = implode(";",$models);
		$data['models'] = $models;
		return $data;
	}

	
	private function getXml($data = array()) {
		$xml  = '<?xml version="1.0" encoding="UTF-8"?>' . $this->eol;
		$xml .= '<!DOCTYPE xml_catalog SYSTEM "shops.dtd">' . $this->eol;
		$xml .= '<xml_catalog date="' . date('Y-m-d H:i') . '">' . $this->eol;
		$xml .= '<url>'. HTTP_SERVER .'</url>' . $this->eol;
		$xml .= '<count>'. count($data) .'</count>' . $this->eol;
		$xml .= '<models>'. $data['models'] .'</models>' . $this->eol;
		unset($data['models']);
		$xml .= "<products>" . $this->eol;
		foreach ($data as $keyproduct => $product) {
			$xml .= "<product>" . $this->eol;
				foreach ($product as $keyfieldproduct => $fieldproduct) {

					//вывод атрибутов
					if ($keyfieldproduct == 'attribute') {
						if (count($fieldproduct) > 0) {
							$xml .= "<product_attributes>" . $this->eol;
							foreach ($fieldproduct as $keyattribute => $attribute) {
								$xml .= "<product_attribute>" . $this->eol;
								foreach ($attribute as $keyfieldattribute => $fieldattribute) {
									$xml .= "<" . $keyfieldattribute . ">".$this->getNull($fieldattribute)."</" . $keyfieldattribute . ">" . $this->eol;
								}
								$xml .= "</product_attribute>" . $this->eol;
							}
							$xml .= "</product_attributes>" . $this->eol;
						}
					
					//вывод скидок
					} else if ($keyfieldproduct == 'discount') {
						if (count($fieldproduct) > 0) {
							$xml .= "<product_discounts>" . $this->eol;
							foreach ($fieldproduct as $keydiscount => $discount) {
								$xml .= "<product_discount>" . $this->eol;
								foreach ($discount as $keyfielddiscount => $fielddiscount) {
									$xml .= "<" . $keyfielddiscount . ">".$this->getNull($fielddiscount)."</" . $keyfielddiscount . ">" . $this->eol;
								}
								$xml .= "</product_discount>" . $this->eol;
							}
							$xml .= "</product_discounts>" . $this->eol;
						}

					//вывод изображений
					} else if ($keyfieldproduct == 'images') {
						if (count($fieldproduct) > 0) {
							$xml .= "<product_images>" . $this->eol;
							foreach ($fieldproduct as $keyimage => $image) {
								$xml .= "<product_image>" . $this->eol;
								foreach ($image as $keyfieldimage => $fieldimage) {
									$xml .= "<" . $keyfieldimage . ">".$this->getNull($fieldimage)."</" . $keyfieldimage . ">" . $this->eol;
								}
								$xml .= "</product_image>" . $this->eol;
							}
							$xml .= "</product_images>" . $this->eol;
						}

					//вывод опций
					} else if ($keyfieldproduct == 'option') {
						if (count($fieldproduct) > 0) {
							$xml .= "<product_options>" . $this->eol;
							foreach ($fieldproduct as $keyoption => $option) {
								$xml .= "<product_option>" . $this->eol;
								foreach ($option as $keyfieldoption => $fieldoption) {
									if ($keyfieldoption == 'product_option_value') {
										$xml .= "<product_option_values>" . $this->eol;
										foreach ($fieldoption as $keyfieldoptionvalue => $fieldoptionvalue) {
											$xml .= "<product_option_value>" . $this->eol;
											foreach ($fieldoptionvalue as $keytekfieldoptionvalue => $tekfieldoptionvalue) {
												$xml .= "<" . $keytekfieldoptionvalue . ">".$this->getNull($tekfieldoptionvalue)."</" . $keytekfieldoptionvalue . ">" . $this->eol;
											}
											$xml .= "</product_option_value>" . $this->eol;
										}
										$xml .= "</product_option_values>" . $this->eol;
									} else {
										$xml .= "<" . $keyfieldoption . ">".$this->getNull($fieldoption)."</" . $keyfieldoption . ">" . $this->eol;
									}
								}
								$xml .= "</product_option>" . $this->eol;
							}
							$xml .= "</product_options>" . $this->eol;
						}

					//вывод бонусных баллов
					} else if ($keyfieldproduct == 'reward') {
						if (count($fieldproduct) > 0) {
							$xml .= "<product_rewards>" . $this->eol;
							foreach ($fieldproduct as $keyreward => $reward) {
								$xml .= "<product_reward>" . $this->eol;
								foreach ($reward as $keyfieldreward => $fieldreward) {
									$xml .= "<" . $keyfieldreward . ">".$this->getNull($fieldreward)."</" . $keyfieldreward . ">" . $this->eol;
								}
								$xml .= "</product_reward>" . $this->eol;
							}
							$xml .= "</product_rewards>" . $this->eol;
						}

					//вывод акций 
					} else if ($keyfieldproduct == 'special') {
						if (count($fieldproduct) > 0) {
							$xml .= "<product_specials>" . $this->eol;
							foreach ($fieldproduct as $keyspecial => $special) {
								$xml .= "<product_special>" . $this->eol;
								foreach ($special as $keyfieldspecial => $fieldspecial) {
									$xml .= "<" . $keyfieldspecial . ">".$this->getNull($fieldspecial)."</" . $keyfieldspecial . ">" . $this->eol;
								}
								$xml .= "</product_special>" . $this->eol;
							}
							$xml .= "</product_specials>" . $this->eol;
						}

					//вывод категорий
					} else if ($keyfieldproduct == 'category') {
						if (count($fieldproduct) > 0) {
							$xml .= "<product_categorys>" . $this->eol;
							foreach ($fieldproduct as $keycategory => $category) {
								$xml .= "<product_category>" . $this->eol;
								foreach ($category as $keyfieldcategory => $fieldcategory) {
									$xml .= "<" . $keyfieldcategory . ">".$this->getNull($fieldcategory)."</" . $keyfieldcategory . ">" . $this->eol;
								}
								$xml .= "</product_category>" . $this->eol;
							}
							$xml .= "</product_categorys>" . $this->eol;
						}

					//вывод магазинов
					} else if ($keyfieldproduct == 'store') {
						if (count($fieldproduct) > 0) {
							$xml .= "<product_stores>" . $this->eol;
							foreach ($fieldproduct as $keystore => $store) {
								$xml .= "<product_store>" . $this->eol;
								foreach ($store as $keyfieldstore => $fieldstore) {
									$xml .= "<" . $keyfieldstore . ">".$this->getNull($fieldstore)."</" . $keyfieldstore . ">" . $this->eol;
								}
								$xml .= "</product_store>" . $this->eol;
							}
							$xml .= "</product_stores>" . $this->eol;
						}

					} else {
						$xml .= "<" . $keyfieldproduct . ">".$this->getNull($fieldproduct)."</" . $keyfieldproduct . ">" . $this->eol;
					}
				}
			$xml .= "</product>" . $this->eol;
		}
		$xml .= "</products>" . $this->eol;
		$xml .= '</xml_catalog>' . $this->eol;
		return $xml;
	}

	private function getNull($data) {
		if (strlen($data) > 0) {
		} else {
			$data = "NULL";
		}
		return $data;
	}
	
}
?>
