<?php

namespace App\Service;

class ExchangeRateService
{
	public function getExchangeRate()
	{
		$exchangeRates = file_get_contents('https://www.cnb.cz/cs/financni_trhy/devizovy_trh/kurzy_devizoveho_trhu/denni_kurz.txt');
		$exchangeRatesRows = explode("\n",$exchangeRates);
		foreach ($exchangeRatesRows as $row)
		{
			if (str_contains($row,"EUR"))
				{
					explode("|",$row);
					var_dump($row);
				}
		}
		echo('<pre>');
		//echo(var_dump($exchangeRatesRows));
		echo('</pre>');
	}
}
