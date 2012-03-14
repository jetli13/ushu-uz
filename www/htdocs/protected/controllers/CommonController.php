<?php

abstract class CommonController extends Controller
{
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
	
	public function init() {
		$this->registerClientSourses();
	}
	
	protected function registerClientSourses() {
		$scripts = $this->getScripts();
		
		foreach($scripts as $script) {
			$this->registerScript($script['name'], $script['position']);
		}
	}
	
	protected function registerScript($name, $position) {
		Yii::app()->getClientScript()->registerScriptFile($name, $position);	
	}
	
	/**
	 * @todo определить как обновлять jquery. его подключает yii
	 * @return array 
	 */
	protected function getScripts() {
		$result = array(
				array( 
						'name' => 'http://yandex.st/jquery/1.7.1/jquery.min.js',
						'position' => CClientScript::POS_BEGIN
				),
				array(
						'name' => '/js/fancybox/jquery.mousewheel-3.0.6.pack.js',
						'position' => CClientScript::POS_END
				),
				array(
						//'name' => 'js/fancybox/jquery.fancybox.pack.js',
						'name' => '/js/fancybox/jquery.fancybox.js',
						'position' => CClientScript::POS_END
				),
				array(
						'name' => '/js/fancybox/jquery.fancybox-buttons.js',
						'position' => CClientScript::POS_END
				),
				array(
						'name' => '/js/fancybox/jquery.fancybox-thumbs.js',
						'position' => CClientScript::POS_END
				),
				array(
						'name' => '/js/common.js',
						'position' => CClientScript::POS_END
				),

		);
		
		return $result;
	}
	
	protected function setLayout() {
		if (!!Yii::app()->user->isGuest) {
			$this->layout = '//layouts/column1';
		} 
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
				'actions'=>array('create','update'),
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
	 * Renders a view with a layout.
	 *
	 * This method first calls {@link renderPartial} to render the view (called content view).
	 * It then renders the layout view which may embed the content view at appropriate place.
	 * In the layout view, the content view rendering result can be accessed via variable
	 * <code>$content</code>. At the end, it calls {@link processOutput} to insert scripts
	 * and dynamic contents if they are available.
	 *
	 * By default, the layout view script is "protected/views/layouts/main.php".
	 * This may be customized by changing {@link layout}.
	 *
	 * @param string $view name of the view to be rendered. See {@link getViewFile} for details
	 * about how the view script is resolved.
	 * @param array $data data to be extracted into PHP variables and made available to the view script
	 * @param boolean $return whether the rendering result should be returned instead of being displayed to end users.
	 * @return string the rendering result. Null if the rendering result is not required.
	 * @see renderPartial
	 * @see getLayoutFile
	 */
	public function render($view,$data=null,$return=false)
	{
		$this->setLayout();
		parent::render($view,$data,$return);
	}
	
}