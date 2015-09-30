<?php


class PhotoController extends CommonController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout= '//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl -upload', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'upload'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id = -1)
	{
		if (intval($id) < 0) {
			throw new Exception ('Photo controller actionCreate: there is no album id given');
		}
		
		$model=new Photo;
		
		$selfAlbum = Album::model()->findByPK($id);
		
		$model->albums = array_merge($model->albums, array($id));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Photo']))
		{
			$model->attributes=$_POST['Photo'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		/* 
		 * todo продумать систему подключения скриптов под конкретное действие. Т.к. используются различние вьюхи,
		 * то например при подключении clientUploader во всем проекте ( ComonController->getScripts ) валится ошибка что не найден плейсхолдер
		 */
		$cs = Yii::app()->getClientScript();
		
		$jsFile = 'http://yandex.st/jquery/1.7.1/jquery.min.js'; 
		$cs->registerScriptFile($jsFile, CClientScript::POS_BEGIN);
		
		$jsFile = '/js/upload/swfupload.js'; 
		$cs->registerScriptFile($jsFile, CClientScript::POS_END);
		
		$jsFile = '/js/upload/clientUploader.js';
		$cs->registerScriptFile($jsFile, CClientScript::POS_END);

		$this->render('create',array(
			'model'=>$model,
			'album' => $selfAlbum,
			'uploadUrl' => '/photo/upload/' . $id . '.html' ,//@todo все в константы и конфиги!!!	
			'photosFolder' => '/upload/photo/album/' ,//@todo все в константы и конфиги!!!	
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Photo']))
		{
			$model->attributes=$_POST['Photo'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider = new CActiveDataProvider('Photo');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new Photo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Photo']))
			$model->attributes=$_GET['Photo'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	private function getUploadImageOptions($id) {
		return array(
			'savePath' => getcwd() . '/upload/photo/album/' . $id . '/',
			'savePreviewPath' => getcwd() . '/upload/photo/album/' . $id . '/' . 128 . '/',
			'sandBoxPath' => getcwd() . '/upload/sandbox/',
			'height' => 600,
			'previewHeight' => 128,
		);
	}
	
	public function actionUpload($id = -1) {
		$id = intval($id);
		if ($id < 0) {
			throw new Exception('Given id is not valid');
		}
		
		$imageManager = Yii::app()->imageManager;
		
		$imageManager->initOptions($this->getUploadImageOptions($id))
						->upload()
						->save()
						->savePreview()
						->destroyUploaded();
		
		$newName = $imageManager->clear();
		
		$this->savePhoto($newName, $id);
		
		return;
		
		$folder = getcwd() . '/upload/photo/album/' . $id;
		$size = 128;
		$name = $_FILES['Filedata']['name'];
		
		$newName = md5($name . time()) . '.jpg';
		
		
		if (!file_exists($folder)) {
			mkdir($folder);
		}
		
		$destFile = $folder . '/' . 'tmp_'  . $newName;
		
		move_uploaded_file($_FILES['Filedata']["tmp_name"], $destFile);
		
		
		$handle = new upload($destFile); // todo оптимизировать треш с дублирование ф-ционала
		
		if ($handle->uploaded) {
				$bodyName = explode('.', $newName);
				$handle->file_new_name_body = $bodyName[0];
				$handle->image_resize         = true;
				$handle->image_y              = 600;
				$handle->image_ratio_x        = true;
				$handle->auto_create_dir = true;
				$handle->dir_auto_chmod = true;
				$handle->dir_chmod = 0777;
				$handle->process($folder);
				
				if ($handle->processed) {
						$handle->clean();
						
				} else {
						header("HTTP/1.0 500 Internal Server Error");
				}
		}

		$srcFile =  $folder . '/' .  $newName;
		
		$folder = $folder . '/128/';
		if (!file_exists($folder)) {
			mkdir($folder);
		}
		
		
		copy($srcFile, $folder . $newName);
		


		
		$handle = new upload($folder . $newName);
		
		if ($handle->uploaded) {
				$handle->file_name_body_pre   = 'thumb_';
				$handle->image_resize         = true;
				$handle->image_y              = $size;
				$handle->image_ratio_x        = true;
				$handle->auto_create_dir = true;
				$handle->dir_auto_chmod = true;
				$handle->dir_chmod = 0777;
				$handle->process($folder);
				if ($handle->processed) {
						$handle->clean();
						$this->savePhoto($newName, $id);
				} else {
					
						header("HTTP/1.0 500 Internal Server Error");
				}
				
		}
		
		unset($destFile);
	}
	
	public function savePhoto($name, $albumId) {
		$model = new Photo;
		$name = explode('.', $name);
		$model->name = $name[0];
		$model->albums = array_merge($model->albums, array($albumId));
		$model->width = 0;
		$model->height = 0;
		
		$saved = $model->save();
		if ($saved) {
			print $albumId . '_' . $name[0];
		} 
		else {
			header("HTTP/1.0 500 Internal Server Error");
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Photo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='photo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
