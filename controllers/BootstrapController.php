<?php

namespace mata\modulemenu\controllers;

use yii\web\Controller;
use mata\modulemenu\models\Module;
use yii\web\HttpException;

class BootstrapController extends Controller {

	public function actionIndex() {

		$module = new Module();
		$module->attributes = \Yii::$app->request->get("module");

		if ($module->save() == false)
			throw new HttpException(current(current($module->getErrors())));
	}
}