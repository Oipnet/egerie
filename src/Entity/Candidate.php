<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\OneToMany(targetEntity="App\Entity\Media", mappedBy="candidate")
     */
    private $medias;

    /**
     * @var boolean $isSelected
     *
     * @ORM\Column(name="is_selected", type="boolean")
     */
    private $isSelected;

    /**
     * @var string $description
     *
     * @ORM\Column(type="text")
     */
    private $description;

    public function __construct()
    {
        $this->medias = new ArrayCollection();
        $this->isSelected = false;
    }

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

    /**
     * @return mixed
     */
    public function getMedias()
    {
        return $this->medias;
    }

    /**
     * @param mixed $medias
     *
     * @return Candidate
     */
    public function setMedias($medias): Candidate
    {
        $this->medias = $medias;

        return $this;
    }

    public function getPortrait(): Media
    {
        return $this->getMedias()->filter(function (Media $media) {
            return $media->getType() === Media::PORTRAIT_TYPE;
        })->first();
    }

    public function getFullBody(): Media
    {
        return $this->getMedias()->filter(function (Media $media) {
            return $media->getType() === Media::PLEIN_PIED_TYPE;
        })->first();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function isSelected(): ?bool
    {
        return $this->isSelected;
    }

    /**
     * @param bool $isSelected
     *
     * @return Candidate
     */
    public function setIsSelected(bool $isSelected): Candidate
    {
        $this->isSelected = $isSelected;
        return $this;
    }

    public function __toString()
    {
        return '';
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Candidate
     */
    public function setDescription(string $description): Candidate
    {
        $this->description = $description;
        return $this;
    }
}
