<?php
namespace MyCompany\MyPackage\Command;

/*
 * This file is part of the MyCompany.MyPackage package.
 */

use MyCompany\MyPackage\Domain\Model\Country;
use MyCompany\MyPackage\Domain\Model\Dancer;
use MyCompany\MyPackage\Domain\Repository\CountryRepository;
use MyCompany\MyPackage\Domain\Repository\DancerRepository;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Cli\CommandController;
use Neos\Utility\Arrays;

/**
 * @Flow\Scope("singleton")
 */
class DancerCommandController extends CommandController
{

    /**
     * @Flow\Inject
     * @var DancerRepository
     */
    protected $dancerRepository;

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
     * @param string $information Information about the dancer
     * @return void
     */
    public function createCommand($name, $information)
    {
        $this->outputLine('Creating Dancer: %s', array($name));

        $countries = $this->countryRepository->findAll()->toArray();
        $countriesToSelect = array_map(function (Country $country) {
            return $country->getName();
        }, $countries);

        $selectedCountryName = $this->output->select('Please choose a country:', $countriesToSelect);

        $selectedCountry = null;
        foreach ($countries as $c) {
            if ($c->getName() === $selectedCountryName) $selectedCountry = $c;
        }

        $dancer = new Dancer();
        $dancer->setName($name);
        $dancer->setInformation($information);
        $dancer->setCountry($selectedCountry);
        $this->dancerRepository->add($dancer);
    }

    /**
     * List all dancers
     *
     * @return void
     */
    public function listCommand()
    {
        $this->outputLine('Listing Dancers');
        $dancers = $this->dancerRepository->findAll()->toArray();
        $dancers = array_map(function (Dancer $d) {
            return array($d->getName(), $d->getInformation(), $d->getCountry()->getName());
        }, $dancers);
        $this->output->outputTable($dancers, array('Name', 'Information', 'Country'));
    }
}
