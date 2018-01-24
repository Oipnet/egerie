<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Contact
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string $subject
     *
     * @ORM\Column(type="string", length=255)
     */
    private $subject;

    /**
     * @var string $content
     *
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @var string $email
     *
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @var string $lastname
     *
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @var string $firstname
     *
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @var string $phine
     *
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $phone;

    /**
     * @var \DateTime $created
     *
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * Gets triggered only on insert
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->created = new \DateTime("now");
    }

    /**
     * @return string
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     *
     * @return Contact
     */
    public function setSubject(string $subject): Contact
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return Contact
     */
    public function setContent(string $content): Contact
    {
        $this->content = $content;
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
     *
     * @return Contact
     */
    public function setEmail(string $email): Contact
    {
        $this->email = $email;
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
     * @return \DateTime
     */
    public function getCreated(): \DateTime
    {
        return $this->created;
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
    public function setFirstname(string $firstname): Contact
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
    public function setLastname(string $lastname): Contact
    {
        $this->lastname = $lastname;
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
    public function setPhone(string $phone): Contact
    {
        $this->phone = $phone;
        return $this;
    }
}
