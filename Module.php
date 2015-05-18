<?php

/*
 * This file is part of the mata project.
 *
 * (c) mata project <http://github.com/mata/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace mata\modulemenu;

use mata\base\Module as BaseModule;

class Module extends BaseModule {

	public $runBootstrap = true;

	public $moduleFolders = ["@vendor/matacms"];

	public function getNavigation() {
		return null;
	}

	public function canShowInNavigation() {
		return false;
	}
}
