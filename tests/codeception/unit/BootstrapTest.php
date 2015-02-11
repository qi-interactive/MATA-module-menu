<?php

namespace mata\modulemenu\tests;

use yii\codeception\TestCase;

// require("Bootstrap.php");

/**
 * This is the base class for all yii framework unit tests, which requires
 * external vendor libraries to function.
 */
class BootstrapTestCase extends TestCase {

	public function testShouldNotRun() { 
		$bootstrap = new \mata\modulemenu\Bootstrap();
		$this->assertTrue(YII_DEBUG);
		$this->assertFalse($bootstrap->checkIfShouldRun(\Yii::$app));
	}

	public function testEEnsurePromptShownForNewModule() {
		$this->assertTrue(true);
	}

	public function testGetModuleFileByPath() {

		$bootstrap = new \mata\modulemenu\Bootstrap();

		$folder = $this->getModuleMenuModuleFolder();
		$this->assertEquals($folder . "/Module.php", $bootstrap->getModuleFile($folder));
	}

	public function testHasModuleBeenLoaded() {

		$bootstrap = new \mata\modulemenu\Bootstrap();
		$this->assertTrue($bootstrap->hasModuleBeenLoaded($this->getModuleMenuModuleFolder()));
	}

	public function testIsModuleRegisteredWithModuleMenu() {
		$this->assertTrue(true);
	}

	public function testFindNewModule() {

		$bootstrap = new \mata\modulemenu\Bootstrap();
		$newModules = $bootstrap->findNewModule();
		$this->assertTrue(is_array($newModules));
		$this->assertEquals(0, count($newModules));
	}

	private function getModuleMenuModuleFolder() {
		return __DIR__ . "/../../..";
	}
}