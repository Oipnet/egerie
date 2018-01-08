<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EyeRepository")
 */
class Eye
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
     * @ORM\OneToMany(targetEntity="App\Entity\Candidate", mappedBy="eye")
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
    public function setShortCode($shortCode): Eye
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
     * @return Eye
     */
    public function setLabel(string $label): Eye
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
     * @return Eye
     */
    public function setCandidates($candidates): Eye
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
