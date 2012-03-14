<?php

//SAND_BOX
/*$obj = new stdClass();
$obj->test = 'origin';
$test = $obj->test;
$obj->test = null;

print $obj->test;
print '<br />';
print $test;
exit();*/


// SAND_BOX_END


// change the following paths if necessary
$yii=dirname(__FILE__).'/../framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();
//var_dump(Yii::app());