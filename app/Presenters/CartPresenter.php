<?php
namespace App\Presenters;

use App\Model\CartFacade;
use App\Model\OrderFacade;
use App\Model\PriceFacade;
use App\Model\ProductFacade;
use JetBrains\PhpStorm\NoReturn;
use Nette\Application\AbortException;
use Nette\Application\UI\Form;

final class CartPresenter extends BasePresenter
{
	public function __construct(
		private CartFacade $cartFacade,
		private ProductFacade $productFacade,
		private PriceFacade $priceFacade,
		private OrderFacade $orderFacade,
	) {
	}

	/**
	 * @throws AbortException
	 */
	#[NoReturn] public function renderAdd(int $productId)
	{
		$this->cartFacade->addItemToCart($productId);

		return $this->forward('Home:default');
	}

	public function renderShow()
	{
		$cartItemsCount = $this->cartFacade->getItemCounts();
		$products = $this->productFacade->getMultipleProducts(array_keys($cartItemsCount));

		$this->template->cartItems = $this->cartFacade->getProductsWithCount($cartItemsCount,$products);
		$this->template->eurPrice = $this->priceFacade->getEurPrice();
	}

	protected function createComponentOrderForm(): Form
	{
		$form = new Form;
		$form->addText('full_name', 'Jméno a příjmení:')
			->setRequired();
		$form->addEmail('email', 'E-mail:')
			->setRequired();
		$form->addText('phone', 'Telefon:')
			->setRequired();

		$form->addSubmit('send', 'Vytvořit objednávku');
		$form->onSuccess[] = $this->orderFormSucceeded(...);

		return $form;
	}

	private function orderFormSucceeded(array $data): void
	{
		$this->orderFacade->createOrder($data);

		$this->flashMessage('Objednávka byla úspěšně odeslána.', 'success');
		$this->redirect('Home:default');
	}

}
