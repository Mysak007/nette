<?php
namespace App\Model;

use Nette;

final class ProductFacade
{
	public function __construct(
		private Nette\Database\Explorer $database,
	) {
	}

	public function getAllProducts(): array
	{
		return $this->database
			->table('product')->fetchAll();
	}

	public function getProduct(int $productId): ?Nette\Database\Table\ActiveRow
	{
		return $this->database
			->table('product')->get($productId);
	}

	public function getMultipleProducts(array $productIds): array
	{
		return $this->database
			->table('product')->where('id',$productIds)->fetchAll();
	}
}
