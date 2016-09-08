<?php
class ModelCatalogNextPrevLinks extends Model {
	function nextprev($source) {
		if (preg_match("/featured.php/i", $source[0]['file'])) {
			return '&featured=1';
		}		
		if (preg_match("/special.php/i", $source[0]['file'])) {
			return '&special=1';
		}		
		if (preg_match("/latest.php/i", $source[0]['file'])) {
			return '&latest=1';
		}		
		if (preg_match("/bestseller.php/i", $source[0]['file'])) {
			return '&bestseller=1';
		}		
		if (preg_match("/home.php/i", $source[0]['file'])) {
			return '&latest=1';
		}		
		if (preg_match("/manufacturer.php/i", $source[0]['file'])) {
			return '&manufacturer=1';
		}		
		if (preg_match("/category.php/i", $source[0]['file'])) {
			return '&category=1';
		}		
	}	
}
?>
