<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PartnerRepository")
 */
class Partner
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(type="string", length=150)
     */
    private $name;

    /**
     * @var string $banner
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $banner;

    /**
     * @var string $name
     *
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $site;

    /**
     * @var string $banner
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $descrition;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    public function __construct()
    {
        $this->setIsActive(true);
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Partner
     */
    public function setName(string $name): Partner
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getBanner(): ?string
    {
        return $this->banner;
    }

    /**
     * @param string $banner
     *
     * @return Partner
     */
    public function setBanner(string $banner): Partner
    {
        $this->banner = $banner;
        return $this;
    }

    /**
     * @return string
     */
    public function getSite(): ?string
    {
        return $this->site;
    }

    /**
     * @param string $site
     *
     * @return Partner
     */
    public function setSite(string $site): Partner
    {
        $this->site = $site;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescrition(): ?string
    {
        return $this->descrition;
    }

    /**
     * @param string $descrition
     *
     * @return Partner
     */
    public function setDescrition(string $descrition): Partner
    {
        $this->descrition = $descrition;
        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     *
     * @return Partner
     */
    public function setIsActive(bool $isActive): Partner
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}
