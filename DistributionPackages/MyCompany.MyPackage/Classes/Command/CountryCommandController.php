<?php
namespace MyCompany\MyPackage\Command;

/*
 * This file is part of the MyCompany.MyPackage package.
 */

use MyCompany\MyPackage\Domain\Model\Country;
use MyCompany\MyPackage\Domain\Repository\CountryRepository;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Cli\CommandController;

/**
 * @Flow\Scope("singleton")
 */
class CountryCommandController extends CommandController
{

    /**
     * @Flow\Inject
     * @var CountryRepository
     */
    protected $countryRepository;

    /**
     * Create a dancer
     *
     * This will create a dancer
     *
     * @param string $name Name of the dancer
     * @param string $countryId Country Id
     * @return void
     */
    public function createCommand($name, $countryId)
    {
        $this->outputLine('Creating Country: %s', array($name));

        $country = new Country();
        $country->setName($name);
        $country->setCountryId($countryId);
        $this->countryRepository->add($country);
    }

    /**
     * List all Countries
     *
     * @return void
     */
    public function listCommand()
    {
        $this->outputLine('Listing Countries');
        $countries = $this->countryRepository->findAll()->toArray();
        $countries = array_map(function (Country $d) {
            return array($d->getName(), $d->getCountryId());
        }, $countries);
        $this->output->outputTable($countries, array('Name', 'Country Id'));
    }
}
