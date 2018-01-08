<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CandidateRepository")
 */
class Candidate
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Language", inversedBy="candidates")
     */
    private $language;

    /**
     * @var int $size
     *
     * @ORM\Column(type="integer", length=3)
     */
    private $size;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Eye", inversedBy="candidates")
     */
    private $eye;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Hair", inversedBy="candidates")
     */
    private $hair;

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     *
     * @return Candidate
     */
    public function setLanguage($language): Candidate
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return int
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * @param int $size
     *
     * @return Candidate
     */
    public function setSize(int $size): Candidate
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEye()
    {
        return $this->eye;
    }

    /**
     * @param mixed $eye
     *
     * @return Candidate
     */
    public function setEye($eye): Candidate
    {
        $this->eye = $eye;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHair()
    {
        return $this->hair;
    }

    /**
     * @param mixed $hair
     *
     * @return Candidate
     */
    public function setHair($hair): Candidate
    {
        $this->hair = $hair;
        return $this;
    }
}
