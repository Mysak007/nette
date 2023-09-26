<?php

namespace App\Service;

use Nette;
class ExchangeRateService
{
	const FILE_URL = 'https://www.cnb.cz/cs/financni_trhy/devizovy_trh/kurzy_devizoveho_trhu/denni_kurz.txt';
	public function __construct(
		private Nette\Database\Explorer $database,
	) {
	}
	public function getExchangeRate(): void
	{
		$exchangeRates = file_get_contents(self::FILE_URL);
		$exchangeRatesRows = explode("\n",$exchangeRates);
		$price = 0;
		foreach ($exchangeRatesRows as $row)
		{
			if (str_contains($row,"EUR"))
				{
					$rowArray = explode("|",$row);
					$price = str_replace(',','.',$rowArray[4]);
				}
		}

		$data = [];
		$data['rate'] = $price;
		$this->database->table('exchange_rate')->get(1)->update($data);
	}
}
