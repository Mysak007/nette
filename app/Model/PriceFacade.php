<?php
namespace App\Model;

use Nette;

final class PriceFacade
{
	public function __construct(
		private Nette\Database\Explorer $database,
	) {
	}

	public function getEurPrice(): float
	{
		$row = $this->database
			->table('exchange_rate')->where(['title' => 'EUR'])->fetch();

		if (isset($row['rate'])){
			return (float) $row['rate'];
		}

		return 1;
	}
}
