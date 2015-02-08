<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace mata\modulemenu\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class BootstrapAsset extends AssetBundle
{
	public $sourcePath = '@vendor';

	public $js = [
	'mata/mata-module-menu/web/js/bootstrap.js'
	];

	public $depends = [
	'yii\web\YiiAsset',
	];

	// TODO remove before publishing
	public $publishOptions = [
	'forceCopy' => true
	];
}
