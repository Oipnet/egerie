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
     * @var string $firstname
     *
     * @ORM\Column(name="first_name", type="string", length=100)
     */
    private $firstname;

    /**
     * @var string $lastname
     *
     * @ORM\Column(name="last_name", type="string", length=100)
     */
    private $lastname;

    /**
     * @var string $email
     *
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var int $zipCode
     *
     * @ORM\Column(name="zip_code", type="integer", length=7)
     */
    private $zipCode;

    /**
     * @var string $city
     *
     * @ORM\Column(type="string", length=150)
     */
    private $city;

    /**
     * @var \DateTime $birthDate
     *
     * @ORM\Column(name="birth_date", type="date")
     */
    private $birthDate;

    /**
     * @var string $phone
     *
     * @ORM\Column(type="string", length=20)
     */
    private $phone;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Media", mappedBy="candidate")
     */
    private $medias;

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

    private $cgu;

    public function __construct()
    {
        $this->medias = new ArrayCollection();
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

    public function __toString()
    {
        return $this->getLastname().' '.$this->getFirstname();
    }

    /**
     * @return string
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname): Candidate
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname): Candidate
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): Candidate
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): Candidate
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getBirthDate(): ?\DateTime
    {
        return $this->birthDate;
    }

    /**
     * @param \DateTime $birthDate
     */
    public function setBirthDate(\DateTime $birthDate): Candidate
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): Candidate
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return int
     */
    public function getZipCode(): ?int
    {
        return $this->zipCode;
    }

    /**
     * @param int $zipCode
     */
    public function setZipCode(int $zipCode): Candidate
    {
        $this->zipCode = $zipCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCgu()
    {
        return $this->cgu;
    }

    /**
     * @param mixed $cgu
     */
    public function setCgu($cgu)
    {
        $this->cgu = $cgu;
        return $this;
    }
}
