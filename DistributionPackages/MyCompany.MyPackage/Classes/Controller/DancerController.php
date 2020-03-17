<?php
namespace MyCompany\MyPackage\Controller;

/*
 * This file is part of the MyCompany.MyPackage package.
 */

use MyCompany\MyPackage\Domain\Model\Dancer;
use MyCompany\MyPackage\Domain\Repository\CountryRepository;
use MyCompany\MyPackage\Domain\Repository\DancerRepository;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;

class DancerController extends ActionController
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
     * @return void
     */
    public function indexAction()
    {
        $dancers = $this->dancerRepository->findAll();
        $this->view->assign('dancers', $dancers);
    }

    /**
     * @return void
     * @param Dancer dancer
     */
    public function deleteAction(Dancer $dancer)
    {
        $this->dancerRepository->remove($dancer);
        $this->redirect('index');
    }

    /**
     * @return void
     */
    public function addFormAction()
    {
        $countries = $this->countryRepository->findAll();
        $this->view->assign('countries', $countries);
    }

    /**
     * @return void
     * @param Dancer $newDancer
     */
    public function createAction(Dancer $newDancer)
    {
        $this->dancerRepository->add($newDancer);
        $this->redirect('index');
    }

}
