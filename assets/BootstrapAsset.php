<?php
 
/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

namespace mata\modulemenu\assets;

use yii\web\AssetBundle;

class BootstrapAsset extends AssetBundle
{
	public $sourcePath = '@vendor';

	public $js = [
	'mata/mata-module-menu/web/js/bootstrap.js'
	];

	public $depends = [
	'yii\web\YiiAsset',
	];
}
