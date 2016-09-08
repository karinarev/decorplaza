<?
	set_time_limit (30);
	$time = microtime(true);
	$root=$_SERVER['DOCUMENT_ROOT'];
	$PregExp='/breadcrumb/si';
	function path_throwgh_files($cdir)
	{
		global $PTF_Files;
		$files=glob($cdir.'/*');
		foreach($files as $file)
			if(is_dir($file))
				path_throwgh_files($file);
			else 
				$PTF_Files[]=$file;
		return $PTF_Files;
	}

	foreach(path_throwgh_files($root) as $file)
	{
		$extention = end(explode('.', $file));
		if(strtolower($extention) == 'jpg' or
			strtolower($extention) == 'jpeg' or
			strtolower($extention) == 'png' or
			strtolower($extention) == 'gif' or
			strtolower($extention) == 'bmp' or
			strtolower($extention) == 'mp3' or
			strtolower($extention) == 'wav' or
			strtolower($extention) == 'flv' or
			strtolower($extention) == 'swf' or
			strtolower($extention) == 'ttf' or
			strtolower($extention) == 'doc' or
			strtolower($extention) == 'mov' or
			strtolower($extention) == 'mp4' or
			strtolower($extention) == 'gz' or
			strtolower($extention) == 'zip')
			continue;
		if(filesize($file)<10000000)
		{
			$content=file_get_contents($file);
			preg_match_all($PregExp,$content,$p);
			if(!empty($p[0]))
			{
				print_r($file.'<br>');
			}
		}
		if( microtime(true)-$time > 25 )
			die('Время закончилось');
	}
	echo 'Время выполнения: '.number_format((microtime(true)-$time), 3).' сек.';
?>
