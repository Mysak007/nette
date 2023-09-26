<?php

namespace App\Model;

use Nette;
class OrderFacade
{
	public function __construct(
		private Nette\Database\Explorer $database,
		private CartFacade $cartFacade,
	) {
	}

	public function createOrder(array $data): void
	{
		$data['total_price'] = $this->cartFacade->getTotalPrice();

		$itemCounts = $this->cartFacade->getItemCounts();

		$order = $this->database
			->table('order')
			->insert($data);

		// key is product id
		foreach ($itemCounts as $key => $itemCount){
			$this->database->table('order_product')->insert([
				'product_id' => $key,
				'order_id' => $order->id,
				'item_count' => $itemCount,
				]);
		}

		$this->cartFacade->emptyCart();
	}
}