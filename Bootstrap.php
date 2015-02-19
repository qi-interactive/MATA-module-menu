<?php

/*
 * This file is part of the MATA project.
 *
 * (c) mata project <http://github.com/mata/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace mata\modulemenu;

use yii\authclient\Collection;
use yii\base\BootstrapInterface;
use yii\base\InvalidConfigException;
use yii\i18n\PhpMessageSource;
use yii\web\GroupUrlRule;
use yii\web\Application as WebApplication;
use yii\web\User;
use yii\base\Event;
use yii\web\View;
use mata\modulemenu\models\Module as ModuleModel;
use Composer\Autoload\ClassLoader;
use mata\helpers\MataModuleHelper;
use mata\helpers\ComposerHelper;

/**
 * @author Marcin Wiatr<marcin@qi-interactive.com>
 */
class Bootstrap implements BootstrapInterface {

	public function bootstrap($app) {

		if ($this->checkIfShouldRun($app) == false)
			return;

		$newModule = $this->findNewModule();

		if (!empty($newModule))
			Event::on(View::className(), View::EVENT_BEGIN_BODY, function ($event) {
				
				$controller = $event->sender;
				echo $controller->render("@vendor/mata/mata-module-menu/views/addModuleMenuPrompt", [
					"modules" => $event->data
					]);
			}, $newModule);
	}

	public function checkIfShouldRun($app) {

		$thisModule = $app->getModule("moduleMenu");

		return $thisModule && 
		$thisModule->runBootstrap &&
		YII_DEBUG == true && 
		defined('YII_TEST_ENTRY_URL') == false &&
		$app instanceof WebApplication &&
		$app->getRequest()->isAjax == false;
	}

	public function findNewModule() {
		$retVal = array();

		$vendorFolder = \Yii::getAlias('@vendor');
		$mataFolder = $vendorFolder . DIRECTORY_SEPARATOR . "mata";

    		// Open a known directory, and proceed to read its contents
		foreach(glob($mataFolder . DIRECTORY_SEPARATOR . "*") as $folder) {
			
			if (is_dir($folder) == false)
				continue;

			if (($module = $this->isModuleRegisteredWithModuleMenu($folder)) != false) {

				$moduleFile = ComposerHelper::getLibraryNamespaceByFolder($folder) . "Module";
				$module = new $moduleFile(null);

				$retVal[] = [
				"Name" => $module->getName(),
				"Location" => ComposerHelper::getLibraryNamespaceByFolder($folder)
				];
				// TODO we can run this only once because we have a name clash. How to go over it? 
				return $retVal;
			}
		}

		return $retVal;
	}

	public function getModuleFile($folder) {
		if (file_exists($folder . DIRECTORY_SEPARATOR . "Module.php"))
			return $folder . DIRECTORY_SEPARATOR . "Module.php";
	}

	private function isModuleRegisteredWithModuleMenu($folder) {

		$moduleClassFile = $this->getModuleFile($folder);
		$namespace = ComposerHelper::getLibraryNamespaceByFolder($folder);

		if ($moduleClassFile === null)
			return false;

		if ($this->isAlreadyRegisteredWithMenu($namespace))
			return false;

		if ($this->hasModuleBeenLoaded($folder) == false)
			include $moduleClassFile;

		$module = new Module(null);

		if (MataModuleHelper::isMataModule($module) == false) 
			return false;

		return $module;
	}

	public function hasModuleBeenLoaded($folder) {
		$includeFiles = require(\Yii::getAlias('@vendor') . DIRECTORY_SEPARATOR . "composer"
			. DIRECTORY_SEPARATOR . "autoload_psr4.php");

		foreach ($includeFiles as $namespace => $path) {

			// This module cannot be added to the menu, yet.
			if ($namespace == "mata\modulemenu\\")
				return true;

			$moduleClassPath = $namespace . "Module";

			if (current($path) ==$folder ) {
				// The Module we are trying to parse has been included by Composer
				// Check if it's already defined, otherwise class name clash will occur
				$declaredClasses = get_declared_classes();
				if (in_array($moduleClassPath, $declaredClasses))
					return true;
			}
		}
	}

	private function isAlreadyRegisteredWithMenu($namespace) {
		$moduleMenuRecord = ModuleModel::find()
		->where(['Location' => $namespace])
		->one();

		return $moduleMenuRecord != null;
	}
}