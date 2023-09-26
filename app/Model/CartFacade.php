<?php

namespace App\Model;

class CartFacade
{
	private \Nette\Http\SessionSection $cart;
	public function __construct(
		private \Nette\Http\Session $session,
		private \App\Model\ProductFacade $productFacade,
	)
	{
		$this->cart = $this->session->getSection('cart');
	}

	/** @return array<int,int> */
	public function getCartItems(): array
	{
		return $this->cart->get('cartItems') ?? [];
	}

	public function getTotalPrice(): float
	{
		return $this->cart->get('totalPrice') ?? 0;
	}

	public function addItemToCart(int $itemId): void
	{
		$cartItems = $this->getCartItems();
		if (!$cartItems){
			$this->cart->set('cartItems',[]);
			$cartItems = [];
		}

		$cartItems[] = $itemId;

		$this->cart->set('cartItems', $cartItems);
		$this->recalculateCart();
	}

	private function recalculateCart(): void
	{
		$totalPrice = 0;

		$cartItems = $this->getCartItems();
		foreach ($cartItems as $cartItem){
			$tmpProduct = $this->productFacade->getProduct($cartItem);
			$totalPrice += $tmpProduct->price;
		}

		$this->cart->set('totalPrice', $totalPrice);
	}

	public function getItemCounts(): array
	{
		$cartItems = $this->getCartItems();

		$itemCounts = array();

		// count how many times number occures, key is the number, value is count
		foreach ($cartItems as $number) {
			if (isset($itemCounts[$number])) {
				$itemCounts[$number]++;
			} else {
				$itemCounts[$number] = 1;
			}
		}

		return $itemCounts;
	}

	public function getProductsWithCount(array $cartItemsCount,array $products): array
	{
		$productsWithCount = [];

		foreach ($cartItemsCount as $key => $itemCount){
			foreach ($products as $product){
				if ($product->id === $key){
					$productsWithCount[$key]['product'] = $product;
					$productsWithCount[$key]['count'] = $itemCount;
				}
			}
		}

		return $productsWithCount;
	}

	public function emptyCart(): void
	{
		$this->session->destroy();
	}

}