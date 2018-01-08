<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LanguageRepository")
 */
class Language
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string $shortCode
     *
     * @ORM\Column(type="string", name="short_code", length=5)
     */
    private $shortCode;

    /**
     * @var string $label
     *
     * @ORM\Column(type="string", length=50)
     */
    private $label;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Candidate", mappedBy="language")
     */
    private $candidates;

    /**
     * @return string
     */
    public function getShortCode(): ?string
    {
        return $this->shortCode;
    }

    /**
     * @param mixed $shortCode
     *
     * @return Language
     */
    public function setShortCode($shortCode): Language
    {
        $this->shortCode = $shortCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     *
     * @return Language
     */
    public function setLabel($label): Language
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCandidates()
    {
        return $this->candidates;
    }

    /**
     * @param mixed $candidates
     *
     * @return Language
     */
    public function setCandidates($candidates): Language
    {
        $this->candidates = $candidates;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getLabel();
    }

}
