<?php
class ModelModuleocScroll extends Model {
	
	public function setocScroll(){		
		
		$ocsettings_data = array();
		$settings_ocscroll=$this->config->get('oc_scroll_settings');
		
		$output='';
		
		if ($settings_ocscroll['image']){
			$image="catalog/view/javascript/jquery/ocscroll/30.gif";
		}else{
			$image='catalog/view/javascript/jquery/ocscroll/1px.gif';
			
		}
		
		if (isset($settings_ocscroll['selector'])){
			$content_selector=$settings_ocscroll['selector'];
		}else{
			$content_selector="#content";
			
		}
		if (isset($settings_ocscroll['item_selector'])){
			$item_selector=$settings_ocscroll['item_selector'];
		}else{
			$item_selector=".product-list";
			
		}
		
		
		
		$next_selector="div.pagination a:first";
		$nav_selector="div.pagination";
				
		
		$loadingText= ($settings_ocscroll[ (int)$this->config->get('config_language_id') ]['txtloading']) ? $settings_ocscroll[ (int)$this->config->get('config_language_id') ]['txtloading'] : '';
		$donetext= ($settings_ocscroll[ (int)$this->config->get('config_language_id') ]['txtend']) ? $settings_ocscroll[ (int)$this->config->get('config_language_id') ]['txtend'] : '';
			
		if ( $settings_ocscroll['enable'] ){
		
		if (($settings_ocscroll['image']) && $settings_ocscroll[ (int)$this->config->get('config_language_id') ]['txtloading']!="" && $settings_ocscroll[ (int)$this->config->get('config_language_id') ]['txtend']!=""){
		
		$output.='<style>#infscr-loading {background: none repeat scroll 0 0 #FFFFFF;border-radius: 10px 10px 10px 10px;border: 1px solid #CCCCCC;;bottom: 5px;color: #000000;height: 40px;left: 50%;letter-spacing: 0.1em;margin: 0 0 0 -150px;opacity: 0.8;padding: 10px;position: relative;text-align: center;width: 300px;z-index: 9998;}</style>';
		}
		
		
		$output.='<script type="text/javascript" src="catalog/view/javascript/jquery/ocscroll/jquery.ocscroll.js"></script>';
		
		$output.='<script>
		$(".pagination").hide();
		$(".limit").hide();
		
		$("'.$content_selector.'").infinitescroll({
					
					loading			: {
						img			: "'.$image.'",
						msgText		: "'.$loadingText.'",
						finishedMsg	: "'.$donetext.'"
						},
					bufferPx: 10,
					nextSelector    : "'.$next_selector.'",
					navSelector     : "'.$nav_selector.'",
					contentSelector : "'.$content_selector.'",
					itemSelector    : "'.$item_selector.'",
					}, function () {display(view)});
		</script>';
		}
	
	return $output;
}
}
?>

