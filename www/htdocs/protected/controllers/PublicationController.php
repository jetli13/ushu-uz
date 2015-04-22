<?php
//http://www.mediafire.com/?wrylt6w8m2zfz2f  стили
class PublicationController extends CommonController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	private $ARTICLE_ID = 2;
	private $STYLE_AND_WEAPON_ID = 1;
	private $NEWS_ID = 3;
	public $typeCaption;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl -uploadPhoto', // perform access control for CRUD operations
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
				'actions'=>array('index','view', 'article', 'news'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','createArticle', 'createNews'),
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
	public function actionCreate()
	{
		$model=new Publication;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Publication']))
		{
			$model->attributes=$_POST['Publication'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		
		$this->includeClientScript();
		
		$this->render('create',array(
			'model' => $model,
			'typeId' => 1, //todo магические константы
			'typeCaption' => 'Стили и оружие ушу',
			'uploadUrl'	=> '/publication/uploadPhoto.html',//@todo все в константы и конфиги!!!
			'photosFolder' => '/upload/photo/publication/' ,//@todo все в константы и конфиги!!!	
		));
	}
	

	public function actionCreateArticle()
	{
		$model=new Publication;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Publication']))
		{
			$model->attributes=$_POST['Publication'];
			$model->type = 2; // todo магия константы
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		
		$this->includeClientScript();
		
		$this->render('create', array(
			'model' => $model,
			'typeId' => 2,
			'typeCaption' => 'Cтатьи',
			'uploadUrl'	=> '/publication/uploadPhoto.html',//@todo все в константы и конфиги!!!
			'photosFolder' => '/upload/photo/publication/' ,//@todo все в константы и конфиги!!!	
		));
	}
	
	
	public function actionCreateNews()
	{
		$model=new Publication;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Publication']))
		{
			$model->attributes=$_POST['Publication'];
			$model->type = 3; // todo магия константы
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		
		$this->includeClientScript();
		
		$this->render('create', array(
			'model' => $model,
			'typeId' => 2,
			'typeCaption' => 'Новости',
			'uploadUrl'	=> '/publication/uploadPhoto.html',//@todo все в константы и конфиги!!!
			'photosFolder' => '/upload/photo/publication/' ,//@todo все в константы и конфиги!!!	
		));
	}
	
	private function includeClientScript() {
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
		
		$jsFile = '/js/publication/photos.js';
		$cs->registerScriptFile($jsFile, CClientScript::POS_END);	
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

		if(isset($_POST['Publication']))
		{
			$model->attributes=$_POST['Publication'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		
		$this->includeClientScript();

		$this->render('update',array(
			'model'=>$model,
			'uploadUrl'	=> '/publication/uploadPhoto.html',//@todo все в константы и конфиги!!!
			'photosFolder' => '/upload/photo/publication/' ,//@todo все в константы и конфиги!!!	
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id = -1)
	{
		
		if($id != -1)
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
	 * @todo 
	 */
	public function actionIndex()
	{
		$dataProvider = new CActiveDataProvider(
						'Publication', 
						array (
								'criteria' => array('condition' => 'type=' . $this->STYLE_AND_WEAPON_ID)
						)
		);
		
		$this->typeCaption = 'Стили и оружия ушу'; // todo получать из модели
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionArticle () {
		$dataProvider = new CActiveDataProvider(
						'Publication', 
						array (
								'criteria' => array(
										 'condition' => 'type=' . $this->ARTICLE_ID, 
										 'order'=>'creationDate DESC',
										 'limit'=> 3
								),
								'pagination' => false
						)
		);
		
		$this->typeCaption = 'Статьи';
		
		$this->render('article',array(
			'dataProvider'=>$dataProvider,
		));	
	}
	
	public function actionNews() {
				$dataProvider = new CActiveDataProvider(
						'Publication', 
						array (
								'criteria' => array(
										 'condition' => 'type=' . $this->NEWS_ID, 
										 'order'=>'creationDate DESC'
								),
								'pagination' => false
						)
		);
		
		$this->typeCaption = 'Новости';
		
		$this->render('news',array(
			'dataProvider'=>$dataProvider,
		));
	}
	

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Publication('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Publication']))
			$model->attributes=$_GET['Publication'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionUploadPhoto() {
		$imageManager = Yii::app()->imageManager;
		//var_dump('actionUploadPhoto');exit();
		$imageManager->initOptions($this->getUploadImageOptions())
						->upload()
						->save()
						->savePreview()
						->destroyUploaded();
		
		$newName = $imageManager->clear();
		$newName = explode('.', $newName);
		print '_' . $newName[0];
	}
	
	private function getUploadImageOptions() {
		return array(
			'savePath' => getcwd() . '/upload/photo/publication/',
			'savePreviewPath' => getcwd() . '/upload/photo/publication/128/',
			'sandBoxPath' => getcwd() . '/upload/sandbox/',
			'height' => 600,
			'previewHeight' => 128,
		);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Publication::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='publication-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionDrawLastNewsBlock() {		
		$dataProvider = new CActiveDataProvider(
				'Publication', 
				array (
						'criteria' => array(
								'condition' => 'type=' . $this->NEWS_ID,
								'order' => 'creationDate DESC',
								'limit' => 3
					)
				)
		);
		
		print $this->renderPartial('news_block', array(
			'dataProvider' => $dataProvider,
		));
	}
	
}
