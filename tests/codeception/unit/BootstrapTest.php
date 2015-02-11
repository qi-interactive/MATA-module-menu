<?php

namespace mata\modulemenu\tests;

use yii\codeception\TestCase;

// require("Bootstrap.php");

/**
 * This is the base class for all yii framework unit tests, which requires
 * external vendor libraries to function.
 */
class BootstrapTestCase extends TestCase {

	public function testDoesNotRun() { 
		$bootstrap = new \mata\modulemenu\Bootstrap();
		$this->assertTrue(YII_DEBUG);
		$this->assertFalse($bootstrap->checkIfShouldRun(\Yii::$app));
	}
}