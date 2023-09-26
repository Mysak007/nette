<?php

namespace App\Cron;

use App;
use App\Service\ExchangeRateService;

require __DIR__ . '/../vendor/autoload.php';

$container = App\Bootstrap::bootForCron()->createContainer();

$exchangeRateService = $container->getByType(ExchangeRateService::class);

try {
	$exchangeRateService->getExchangeRate();
} catch (\Exception $exception) {
	//TODO zpracování exception
}



