<?php

namespace App\Presenters;

use Nette;
abstract class BasePresenter extends Nette\Application\UI\Presenter
{
	public function beforeRender()
	{
		$section = $this->getSession('cart');
		$this->template->cartItems = $section->get('cartItems');
		$this->template->cartItemsCount = $section->get('cartItems') ? count($section->get('cartItems')) : 0;
		$this->template->cartTotal = $section->get('totalPrice');
	}
}
