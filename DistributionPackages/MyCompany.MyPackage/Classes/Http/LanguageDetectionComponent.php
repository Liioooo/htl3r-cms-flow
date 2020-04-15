<?php
namespace MyCompany\MyPackage\Http;

/*
 * This file is part of the MyCompany.MyPackage package.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Http\Component\ComponentContext;
use Neos\Flow\Http\Component\ComponentInterface;
use Neos\Flow\I18n\Service as I18nService;
use Neos\Flow\I18n\Locale;

class LanguageDetectionComponent implements ComponentInterface
{

    /**
     * @Flow\Inject
     * @var I18nService
     */
    protected $localizationService;

    public function handle(ComponentContext $componentContext)
    {
        $queryParams = $componentContext->getHttpRequest()->getQueryParams();
        if (isset($queryParams['lang'])) {
            $locale = new Locale($queryParams['lang']);
            $this->localizationService->getConfiguration()->setCurrentLocale($locale);
        }
    }

}
