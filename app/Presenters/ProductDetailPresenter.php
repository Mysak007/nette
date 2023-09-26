<?php
namespace App\Presenters;

use App\Model\PriceFacade;
use App\Model\ProductFacade;
use Nette;
use Nette\Application\BadRequestException;

final class ProductDetailPresenter extends BasePresenter
{
	public function __construct(
		private ProductFacade $productFacade,
		private PriceFacade $priceFacade,
	) {
	}

	/**
	 * @throws BadRequestException
	 */
	public function renderShow(int $productId): void
	{
		$product = $this->productFacade->getProduct($productId);

		if (!$product) {
			$this->error('Product not found');
		}

		$this->template->product = $product;
		$this->template->priceEur = $this->priceFacade->getEurPrice();
	}



}
