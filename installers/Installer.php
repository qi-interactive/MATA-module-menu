<?php

namespace mata\modulemenu\installers;
use Composer\Script\Event;

class Installer {

	public static function postPackageInstall(Event $event) {
		echo "INSTALLING mata-module-menu (postPackageInstall)";
	}
}