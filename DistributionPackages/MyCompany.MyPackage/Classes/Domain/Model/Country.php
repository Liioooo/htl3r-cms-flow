<?php
namespace MyCompany\MyPackage\Domain\Model;

/*
 * This file is part of the MyCompany.MyPackage package.
 */

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class Country
{

    /**
     * @Flow\Validate(type="NotEmpty")
     * @Flow\Validate(type="StringLength", options={ "minimum"=3, "maximum"=80 })
     * @ORM\Column(length=80)
     * @var string
     */
    protected $name;

    /**
     * @Flow\Validate(type="NotEmpty")
     * @Flow\Validate(type="StringLength", options={ "minimum"=2, "maximum"=2 })
     * @ORM\Column(length=2)
     * @var string
     */
    protected $countryId;

    /**
     * @ORM\OneToMany(mappedBy="country")
     * @var Collection<Dancer>
     */
    protected $dancers;

    public function __construct()
    {
        $this->dancers = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getCountryId(): string
    {
        return $this->countryId;
    }

    /**
     * @param string $countryId
     */
    public function setCountryId(string $countryId): void
    {
        $this->countryId = $countryId;
    }

    /**
     * @return Collection
     */
    public function getDancers(): Collection
    {
        return $this->dancers;
    }

    /**
     * @param Dancer $dancer
     */
    public function addDancer(Dancer $dancer): void
    {
        $this->dancers->add($dancer);
    }

    /**
     * @param Dancer $dancer
     */
    public function removeDancer(Dancer $dancer): void
    {
        $this->dancers->removeElement($dancer);
    }

}
