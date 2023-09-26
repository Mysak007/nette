<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\PriceFacade;
use App\Model\ProductFacade;
use Nette;


final class HomePresenter extends BasePresenter
{
	public function __construct(
		private ProductFacade $productFacade,
		private PriceFacade	$priceFacade,
	)
	{
	}

	public function renderDefault(): void
	{
		$this->template->products = $this->productFacade->getAllProducts();
		$this->template->eurPrice = $this->priceFacade->getEurPrice();
	}

}
