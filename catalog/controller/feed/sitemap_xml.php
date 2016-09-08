<?php

/*
 * Sitemap xml
 * by dub
 */
 
class ControllerFeedSitemapXml extends Controller {

	private $options;

	public function index() {

		$this->options = array(
				'lid' => (int)$this->config->get('config_language_id'),
				'sid' => (int)$this->config->get('config_store_id')
			);

		$output  = '<?xml version="1.0" encoding="UTF-8"?>';
		$output .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		
		$output .= '<url>';
		$output .= '<loc>' . HTTP_SERVER . '</loc>';
		$output .= '<changefreq>monthly</changefreq>';
		$output .= '<priority>1.0</priority>';
		$output .= '</url>';

		$this->load->model('sitemap/sitemap_xml');
		$this->load->model('catalog/manufacturer');

		$informations = $this->model_sitemap_sitemap_xml->getInformations($this->options);

		foreach ($informations as $information) {
			$output .= '<url>';
			$output .= '<loc>' . $this->url->link('information/information', 'information_id=' . $information['information_id']) . '</loc>';
			$output .= '<changefreq>weekly</changefreq>';
			$output .= '<priority>0.5</priority>';
			$output .= '</url>';
		}

		$products = $this->model_sitemap_sitemap_xml->getProducts($this->options);

		foreach ($products as $product) {
			$output .= '<url>';
			$output .= '<loc>' . $this->url->link('product/product', 'product_id=' . $product['product_id']) . '</loc>';
			$output .= '<lastmod>' . substr(max($product['date_added'], $product['date_modified']), 0, 10) . '</lastmod>';
			$output .= '<changefreq>weekly</changefreq>';
			$output .= '<priority>1.0</priority>';
			$output .= '</url>';
		}

		$manufacturers = $this->model_sitemap_sitemap_xml->getManufacturers($this->options);
		$categories = $this->model_sitemap_sitemap_xml->getCategories($this->options);
		

		foreach ($manufacturers as $manufacturer) {
			$output .= '<url>';
			$output .= '<loc>' . $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $manufacturer['manufacturer_id']) . '</loc>';
			$output .= '<changefreq>weekly</changefreq>';
			$output .= '<priority>0.7</priority>';
			$output .= '</url>';
		}
		
		foreach ($manufacturers as $manufacturer) {
			foreach ($categories as $category) {
				$CountProductManufacturerCategory = $this->model_catalog_manufacturer->getCountProductManufacturerCategory($manufacturer['manufacturer_id'],$category['category_id']);
				if ($CountProductManufacturerCategory>0) {
					$output .= '<url>';
					$output .= '<loc>' . $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $manufacturer['manufacturer_id'] . '&catId=' . $category['category_id']) . '</loc>';
					$output .= '<changefreq>weekly</changefreq>';
					$output .= '<priority>0.7</priority>';
					$output .= '</url>';
				}
				
			}
		}

		

		foreach ($categories as $category) {
			$output .= '<url>';
			$output .= '<loc>' . $this->url->link('product/category', 'path=' . $category['category_id']) . '</loc>';
			$output .= '<lastmod>' . substr(max($category['date_added'], $category['date_modified']), 0, 10) . '</lastmod>';
			$output .= '<changefreq>weekly</changefreq>';
			$output .= '<priority>0.7</priority>';
			$output .= '</url>';
		}

		$output .= '</urlset>';

		$this->response->addHeader('Content-Type: application/xml');
		$this->response->setOutput($output);

	}

}

?>