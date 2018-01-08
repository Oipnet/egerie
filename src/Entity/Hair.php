<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HairRepository")
 */
class Hair
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
     * @ORM\OneToMany(targetEntity="App\Entity\Candidate", mappedBy="hair")
     */
    private $candidates;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

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
     * @return Eye
     */
    public function setShortCode($shortCode): Hair
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
     * @param string $label
     *
     * @return Hair
     */
    public function setLabel(string $label): Hair
    {
        $this->label = $label;
        return $this;
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
     * @return Hair
     */
    public function setCandidates($candidates): Hair
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
