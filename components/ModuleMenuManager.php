<?php

/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

namespace mata\modulemenu\components;

use Yii;
use yii\base\Component;
use mata\modulemenu\models\Module as ModuleModel;

/**
 * This Auth manager changes visibility and signature of some methods from \yii\rbac\DbManager.
 */
class ModuleMenuManager extends Component
{

    public function getMenuModules() {
        $modules = ModuleModel::find()->orderBy('Order ASC, Id ASC')->all();

        $modulesMap = [];

        foreach ($modules as $moduleEntry) {
            $module = Yii::$app->getModule($moduleEntry->Id);

            // Not every module should be loaded as a Yii module
            if ($module == null || !$module->canShowInNavigation() || $module->getNavigation() == null || $module->id == 'users') {
                \Yii::info(sprintf("Module %s not added to navigation - either not a Yii module, or canShowInNavigation == false", $moduleEntry->Name), __CLASS__);
                continue;
            }

            $modulesMap[] = ['ModuleId' => $module->id, 'ModuleName' => $module->getName()];
        }

        return $modulesMap;
    }

    public function getMenuItems($userAccessibleModules = [], $view) {

        array_push($userAccessibleModules, 'users');

        $modules = ModuleModel::find()->orderBy('Order ASC, Id ASC')->all();

        $menuItems = [];
        $subNav = [];

        foreach ($modules as $moduleEntry) {
            $module = Yii::$app->getModule($moduleEntry->Id);

            // Not every module should be loaded as a Yii module
            if ($module == null || !$module->canShowInNavigation() || $module->getNavigation() == null) {
                \Yii::info(sprintf("Module %s not added to navigation - either not a Yii module, or canShowInNavigation == false", $moduleEntry->Name), __CLASS__);
                continue;
            }

            if(!\Yii::$app->user->identity->getIsAdmin() && !in_array($module->id, $userAccessibleModules))
                continue;

            $moduleAssetBundle = $module->getModuleAssetBundle();
            $asset = $moduleAssetBundle::register($view);


            if (!file_exists($asset->sourcePath . $module->mataConfig->icon)) {
                echo $asset->sourcePath . $module->mataConfig->icon;
            }

            if (is_array($module->getNavigation())) {

                $subNav[$module->id] = [];

                foreach ($module->getNavigation() as $navigationItem) {

                    if($module->id == 'users' && $navigationItem["url"] == "/mata-cms/user/admin/index" && !Yii::$app->user->identity->getIsAdmin())
                        continue;

                    $subNav[$module->id][] = [
                        'label' => $navigationItem["label"],
                        'url' => $navigationItem["url"],
                        'icon' =>  $asset->sourcePath . $navigationItem["icon"],
                        'class' => isset($navigationItem["class"]) ? $navigationItem["class"] : null
                    ];
                }

                $menuItems[] = sprintf("<li><a data-module-name='%s' data-subnav='%s' title='%s' href='javascript:void(0)'>%s%s</a></li>",
                    $module->id, $module->id, $module->getDescription(), file_get_contents($asset->sourcePath . $module->mataConfig->icon), $module->getName());

            } else {
                $menuItems[] = sprintf("<li><a data-module-name='%s' title='%s' href='%s'>%s%s</a></li>",
                    $module->id, $module->getDescription(), $module->getNavigation(), file_get_contents($asset->sourcePath . $module->mataConfig->icon), $module->getName());
            }

        }
        return ['menuItems' => $menuItems, 'subNav' => $subNav];
    }

}
