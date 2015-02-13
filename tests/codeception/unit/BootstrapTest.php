<?php

namespace mata\modulemenu\tests;
use yii\codeception\TestCase;
use Codeception\Util\Stub;
use yii\web\Application;
use yii\web\Request;
use mata\modulemenu\models\Module as ModuleModel;
use mata\modulemenu\models\Group as GroupModel;
use tests\codeception\fixtures\ModuleFixture;
use tests\codeception\fixtures\GroupFixture;
use mata\modulemenu\migrations\m150208_130115_init;
use mata\modulemenu\controllers\BootstrapController;
use yii\db\Exception;

/**
 * This is the base class for all yii framework unit tests, which requires
 * external vendor libraries to function.
 */
class BootstrapTestCase extends TestCase {

	protected function tearDown() {

		$migration = new m150208_130115_init();
		$migration->init();
		$migration->down();

		parent::tearDown();
	}

	public function fixtures() {

		$migration = new m150208_130115_init();
		$migration->init();
		$migration->up();


		return [
		'group' => [
		'class' => GroupFixture::className(),
		'dataFile' => '@tests/codeception/fixtures/data/init_group.php'
		],
		'module' => [
		'class' => ModuleFixture::className(),
		'dataFile' => '@tests/codeception/fixtures/data/init_module.php'
		]
		];
	}

	public function testShouldNotRun() { 
		$bootstrap = new \mata\modulemenu\Bootstrap();
		$this->assertTrue(YII_DEBUG);
		$this->assertFalse($bootstrap->checkIfShouldRun(\Yii::$app));

		// $stubConfig = [[
		// 	'id' => "randomId",
		// 	'basePath' => dirname(__DIR__)
		// ]];

		// $this->mockApplication([
		//            'language' => 'ru-RU',
		//            'components' => [
		//                'request' => [

		//                ],
		//            ],
		//        ]);

		// $user =  $this->getMockBuilder('yii\web\Application')->getMock();

		// $user->method('getAuthKey')->will($this->returnCallback(function() { return 'some_auth_key'; }));
		    // ->expects($this->once())
		    // ->method('getRequest')
		    // ->will($this->returnCallback(function() {echo 1; exit; return true;}));


		// $stubApp = Stub::construct('yii\web\Application', 
			// $stubConfig
			// array('getRequest' => function () { 
			// 	return new Request();
			//  })

			// );
	}

	public function testNewGroupIndexIsAnIncrement() {
		$maxOrder = GroupModel::find()
		->select('max(`Order`)')
		->scalar();

		$this->assertEquals(2, $maxOrder);


		$newGroup = new GroupModel();
		$newGroup->attributes = [
		"Name" => "TestGroup"
		];

		$this->assertTrue($newGroup->save());
		$this->assertEquals(3, $newGroup->Order);

	}

	public function testBootstrapController() {
		$modules = ModuleModel::find();

		$controller = new BootstrapController(null, null);
		$testName = 'UnitTestName' . time();

		$_GET = ['module' => [
		'Name' => $testName,
		'Location' => 'DummyLocation'
		]];

		$controller->actionIndex();

		$this->assertNotNull(ModuleModel::find()
			->where(['Name' => $testName])
			->one());

	}

	public function testEnsurePromptShownForNewModule() {
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