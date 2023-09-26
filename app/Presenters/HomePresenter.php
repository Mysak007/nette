<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\PostFacade;
use App\Service\ExchangeRateService;
use Nette;


final class HomePresenter extends Nette\Application\UI\Presenter
{
	public function __construct(
		private PostFacade $facade,
		private ExchangeRateService $exchangeRateService,
	)
	{
	}

	public function renderDefault(): void
	{
		$this->exchangeRateService->getExchangeRate();
		//$this->template->posts = $this->facade->getPublicArticles();
	}

}
