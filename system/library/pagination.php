<?php
class Pagination {
	public $total = 0;
	public $page = 1;
	public $limit = 20;
	public $num_links = 10;
	public $url = '';
	public $text = 'Showing {start} to {end} of {total} ({pages} Pages)';
	public $text_first = '|&lt;';
	public $text_last = '&gt;|';
	public $text_next = '&gt;';
	public $text_prev = '&lt;';
	public $style_links = 'links';
	public $style_results = 'results';

	public function render() {
		$total = $this->total;

		if ($this->page < 1) {
			$page = 1;
		} else {
			$page = $this->page;
		}

		if (!(int)$this->limit) {
			$limit = 10;
		} else {
			$limit = $this->limit;
		}

		$num_links = $this->num_links;
		$num_pages = ceil($total / $limit);

		$this->url = str_replace('%7Bpage%7D', '{page}', $this->url);

		$output = '<span class="sort-span">Страница:</span><ul class="pagination">';

		if ($num_pages > 1) {
			$start = 1;
			$end = $num_pages;
			if($num_pages <= $num_links) {
				for ($i = $start; $i <= $end; $i++) {

					if ($page == $i) {
						$output .= '<li class="active"><span>' . $i . '</span></li>';
					} else {
						$output .= '<li><a href="' . str_replace('{page}', $i, $this->url) . '">' . $i . '</a></li>';
					}
				}
			}
			else
			{

				if ($page <= 4)
				{
					for ($i = 1; $i <= 5; $i++) {
						if ($page == $i) {
							$output .= '<li class="active"><span>' . $i . '</span></li>';
						} else {
							$output .= '<li><a href="' . str_replace('{page}', $i, $this->url) . '">' . $i . '</a></li>';
						}
					}
					$output .= '<li><a>' . "..." . '</a></li>';
					$output .= '<li><a href="' . str_replace('{page}', $num_pages, $this->url) . '">' . $num_pages . '</a></li>';



				}
				else if ($page >= 5 && $page < $num_pages - 3){
					$output .= '<li><a href="' . str_replace('{page}', 1, $this->url) . '">' . 1 . '</a></li>';
					$output .= '<li><a>' . "..." . '</a></li>';
					$output .= '<li><a href="' . str_replace('{page}', $page - 1, $this->url) . '">' . ($page - 1) . '</a></li>';
					$output .= '<li class="active"><span>' . $page . '</span></li>';
					$output .= '<li><a href="' . str_replace('{page}', $page + 1, $this->url) . '">' . ($page + 1) . '</a></li>';
					$output .= '<li><a>' . "..." . '</a></li>';
					$output .= '<li><a href="' . str_replace('{page}', $num_pages, $this->url) . '">' . $num_pages . '</a></li>';
				}
				else if($page >= $num_pages - 3){

					$output .= '<li><a href="' . str_replace('{page}', 1, $this->url) . '">' . 1 . '</a></li>';
					$output .= '<li><a>' . "..." . '</a></li>';
					for ($i = $num_pages - 4; $i <= $num_pages; $i++) {
						if ($page == $i) {
							$output .= '<li class="active"><span>' . $i . '</span></li>';
						} else {
							$output .= '<li><a href="' . str_replace('{page}', $i, $this->url) . '">' . $i . '</a></li>';
						}
					}
				}


			}


		}

		
		$output .= '</ul>';


		/*все*/
		$url_limit = explode('/', $_SERVER['REQUEST_URI']);
		if(isset($url_limit[3])){
			$url_limit = $url_limit['1']. '/'. $url_limit['2'];
		} else {
			$url_limit = $url_limit['1'];
		}
		if(!isset($_GET['limit'])) {
			$all = '<span class="sort-span"><a class="sort-link" href="/'.$url_limit.'/?limit=1000">Показать все</a></span>';
			$output = $output . $all;
		}

   		if ($page < $num_pages) {
			//$output .= ' <a href="' . str_replace('{page}', $page + 1, $this->url) . '">' . $this->text_next . '</a> <a href="' . str_replace('{page}', $num_pages, $this->url) . '">' . $this->text_last . '</a>';
		}

		$find = array(
			'{start}',
			'{end}',
			'{total}',
			'{pages}'
		);

		$replace = array(
			($total) ? (($page - 1) * $limit) + 1 : 0,
			((($page - 1) * $limit) > ($total - $limit)) ? $total : ((($page - 1) * $limit) + $limit),
			$total,
			$num_pages
		);

		if ($num_pages > 1) {
			return $output;
		} else {
			return '';
		}


		//return ($output ? '<div class="' . $this->style_links . '">' . $output . '</div>' : '') . '<div class="' . $this->style_results . '">' . str_replace($find, $replace, $this->text) . $all. '</div>';
	}
}
?>
