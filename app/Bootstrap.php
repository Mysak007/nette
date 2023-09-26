<?php

declare(strict_types=1);

namespace App;

use Nette\Bootstrap\Configurator;
use Tracy\Debugger;


class Bootstrap
{
	public static function boot(): Configurator
	{
		return self::createConfigurator(true);
	}

	public static function bootForCron(): Configurator
	{
		# Debug mód pouze pokud existuje --debug přepínač
		return self::createConfigurator(in_array('--debug', $_SERVER['argv'], true));
	}

	private static function createConfigurator($debugMode): Configurator
	{
		$configurator = new Configurator;
		$appDir = dirname(__DIR__);

		//$configurator->setDebugMode('secret@23.75.345.200'); // enable for your remote IP
		$configurator->setDebugMode($debugMode);
//		Debugger::enable();
		$configurator->enableTracy($appDir . '/log');
		Debugger::$showBar = true;

		$configurator->setTempDirectory($appDir . '/temp');

		$configurator->createRobotLoader()
			->addDirectory(__DIR__)
			->register();

		$configurator->addConfig($appDir . '/config/common.neon');
		$configurator->addConfig($appDir . '/config/services.neon');
		$configurator->addConfig($appDir . '/config/local.neon');

		return $configurator;
	}
}
