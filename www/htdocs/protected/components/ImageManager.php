<?php
require_once('class.upload.php');

class ImageManager extends CApplicationComponent {
	private $imageName = null;
	
	private $savePath = null;
	private $savePreviewPath = null;
	private $sandBoxPath = null;
	private $height = null;
	private $imageMinHeightDiff = 50; //todo возможно стоит вынести в настройку
	private $previewHeight = null;
	
	private $imageUploaded = false;
	
	
	
	protected $requiredOptionsKeys = array(
			'savePath' => 'string',
			'sandBoxPath' => 'string',
			'height' => 'integer',
			'previewHeight' => 'integer',
	);
	
	public function initOptions($options) {
		
		$this->checkRequiredOptions($options);
		
		$this->savePath = $options['savePath'];
		$this->sandBoxPath = $options['sandBoxPath'];
		$this->height = $options['height'];
		$this->previewHeight = $options['previewHeight'];
		$this->savePreviewPath = $options['savePreviewPath'];
		
		return $this;
	}
	
	public function clear() {
		$imageName = $this->imageName;
		$this->imageName = null;
		$this->savePath = null;
		$this->savePreviewPath = null;
		$this->sandBoxPath = null;
		$this->height = null;
		$this->previewHeight = null;
		$this->imageUploaded = false;	
		
		return $imageName;
	}

	public function upload($options = array()) {
		
		$this->checkInitialized();
		
		$this->setImageName();
		
		
		move_uploaded_file($_FILES['Filedata']["tmp_name"], $this->getSandBoxImageFullName());
		$this->imageUploaded = true;
		
		return $this;
	}
	
	public function save() {
		$this->checkInitialized();
		
		if (!file_exists($this->savePath)) {
			mkdir($this->savePath);
		}
		
		$size = $this->previewHeight;
		$folder = $this->savePath;
		
		$handle = new upload($this->getSandBoxImageFullName()); // todo оптимизировать треш с дублирование ф-ционала
		
		if ($handle->uploaded) {
			
				$this->initHandleForSave($handle);
				$handle->process($folder);
				
				if (!$handle->processed) {// скоррее всего пришла картинка меньшего размера чем задано
						copy($this->getSandBoxImageFullName(), $this->savePath . $this->imageName);
				}
				
				$handle->clean();
		}
		
		return $this;
	}
	
	public function savePreview() {
		$this->checkInitialized();
		//var_dump($this->savePreviewPath); exit();
		if (!file_exists($this->savePreviewPath)) {
			mkdir($this->savePreviewPath);
		}
		
		copy($this->savePath . $this->imageName, $this->savePreviewPath . $this->imageName); // @todo зависим от пред. действий
		
		$handle = new upload($this->savePreviewPath . $this->imageName);
		
		if ($handle->uploaded) {
			
				$this->initHandleForSavePreview($handle);
				$handle->process($this->savePreviewPath);
				
				if ($handle->processed) {
						$handle->clean();
				}
				else {
					
						//header("HTTP/1.0 500 Internal Server Error");
				}
				
		}
		return $this;
	}
	
	public function destroyUploaded() {
		$filePath = $this->getSandBoxImageFullName();
		unset($filePath);
		
		return $this;
	}
	
	
	/**
	 * @todo обязательные опшены зависят от того действия которые хотим выполнить, не нужно проверять все.
	 * @param type $options 
	 */
	protected function checkOptions($options) {
		
		$this->checkRequiredOptions($options);
		// todo CRITICAL валидация путей дырявая
		/*$this->checkSavePath($options['savePath']);
		$this->checkSandBoxPath($options['sandBoxPath']);
		$this->checkSavePreviewPath($options['savePreviewPath']);*/
	}
	
	protected function checkSandBoxPath($path) {
		return (preg_match('/sandbox\/$/', $savePath) != 0);
	}


	protected function checkSavePath($savePath) {
		return (preg_match('/\/$/', $savePath) != 0);
	}
	
	protected function checkSavePreviewPath() {
		return (preg_match('/' . $this>previewHeight . '\/$/', $savePath) != 0);
	}
	
	protected function checkRequiredOptions($options) {
		
		foreach ($this->requiredOptionsKeys as $option => $type) {
			
			if ( !array_key_exists($option, $options) ) {
				throw new Exception('Option ' . $option . ' is required' );
			}
			
			if ( gettype($options[$option]) != $type) {
				throw new Exception('option ' . $option . ' must be ' . $type . '. Given type is ' . gettype($options[$option]));
			}
			
		}
		
	}
	
	private function checkInitialized() {
		if (!$this->getIsInitialized()) {
			throw new Error('Component ImageManager sould be initialized');
		}
	}
	
	private function getSandBoxImageFullName() {
		return $this->sandBoxPath . $this->imageName; 
	}
	
	private function setImageName() {
		$name = $_FILES['Filedata']['name'];
		
		$this->imageName = md5($name . time()) . '.jpg';
	}
	
	private function initHandleForSave($handle) {
		$bodyName = explode('.', $this->imageName);
		
		$handle->file_new_name_body = $bodyName[0];
		$handle->image_resize       = true;
		$handle->image_y            = $this->height;
		$handle->image_min_height   = $this->height - $this->imageMinHeightDiff;
		$handle->image_ratio_x      = true;
		$handle->auto_create_dir    = true;
		$handle->dir_auto_chmod     = true;
		$handle->dir_chmod          = 0777;	
		
	}
	
	private function initHandleForSavePreview($handle) {
		$bodyName = explode('.', $this->imageName);
		
		$handle->file_new_name_body = $bodyName[0];
		$handle->file_name_body_pre   = 'thumb_';
		$handle->image_resize         = true;
		$handle->image_y              = $this->previewHeight;
		$handle->image_ratio_x        = true;
		$handle->auto_create_dir = true;
		$handle->dir_auto_chmod = true;
		$handle->dir_chmod = 0777;	
	}
}