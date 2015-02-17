<?php

namespace mata\modulemenu\tests;

use yii\codeception\TestCase;

// require("Bootstrap.php");

/**
 * This is the base class for all yii framework unit tests, which requires
 * external vendor libraries to function.
 */
class ModuleTestCase extends TestCase {

	public function testVersionNumber() { 
		$this->assertEquals(1.0, \Yii::$app->getModule("moduleMenu")->getVersion());
		$this->assertEquals("Module Management", \Yii::$app->getModule("moduleMenu")->getName());
		
	}

}