<?php
class ControllerModuleexportmail extends Controller {
	
	private $error = array(); 
	
	public function index() {   
		$this->language->load('module/exportmail');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('filter', $this->request->post);		
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');

	
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		
		
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/exportmail', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/exportmail/export', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['modules'] = array();
	
				
		

		$this->template = 'module/exportmail.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	function file_force_download($file) {
	  
	}
	
	public function export() {   
		$sql = "SELECT * FROM `" . DB_PREFIX . "order` q GROUP BY q.email";
		$res = $this->db->query($sql);
		$f = fopen("../exportmail/exportmail.txt", "w");
		foreach ($res->rows as $row)  {
			
			fwrite($f, $row['email']."\r\n"); 
		}
		fclose($f);
		
		
				
		
		$sql2 = "SELECT * FROM `" . DB_PREFIX . "coupon`";
		$res2 = $this->db->query($sql2);
		$f2 = fopen("../exportmail/exportmailcoupon.txt", "w");
		foreach ($res2->rows as $row2)  {
			
			fwrite($f2, $row2['email']."\r\n"); 
		}
		fclose($f2);
		
		
		
		
		
		
		
		
		$file_folder = "exportmail/"; // папка с файлами
		if(extension_loaded('zip'))
		{
		
			// проверяем выбранные файлы
			$zip = new ZipArchive(); // подгружаем библиотеку zip
			$zip_name = time().".zip"; // имя файла
			if($zip->open($zip_name, ZIPARCHIVE::CREATE)!==TRUE)
			{

			$error .= "* Sorry ZIP creation failed at this time";
			}
			
			$zip->addFile('../exportmail/exportmailcoupon.txt'); // добавляем файлы в zip архив
			$zip->addFile('../exportmail/exportmail.txt'); // добавляем файлы в zip архив
			
			$zip->close();
			if(file_exists($zip_name))
			{
			// отдаём файл на скачивание
			header('Content-type: application/zip');
			header('Content-Disposition: attachment; filename="'.$zip_name.'"');
			readfile($zip_name);
			// удаляем zip файл если он существует
			unlink($zip_name);
			}
		}
		
		


		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/*
		
		$file2 = ("../exportmail/exportmailcoupon.txt");
		header ("Content-Type: application/octet-stream");
		header ("Accept-Ranges: bytes");
		header ("Content-Length: ".filesize($file2));
		header ("Content-Disposition: attachment; filename=".$file2);  
		readfile($file, $file2);*/
	
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/exportmail')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
	
	
}
?>
