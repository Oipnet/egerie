<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MediaRepository")
 */
class Media
{
    const PORTRAIT_TYPE = 0;
    const PLEIN_PIED_TYPE = 1;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var int $type
     *
     * @ORM\Column(type="integer", length=2)
     */
    private $type;

    /**
     * @var string $path
     *
     * @ORM\Column(type="string", length=150)
     */
    private $path;

    /**
     * @var string $path
     *
     * @ORM\Column(type="string", length=150)
     */
    private $filename;

    /**
     * @var Candidate $candidate
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Candidate", inversedBy="medias")
     */
    private $candidate;

    /**
     * @return int
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * @param int $type
     *
     * @return Media
     */
    public function setType($type): Media
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @param string $path
     *
     * @return Media
     */
    public function setPath($path): Media
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return string
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     *
     * @return Media
     */
    public function setFilename($filename): Media
    {
        $this->filename = $filename;
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
     * @return Candidate
     */
    public function getCandidate(): Candidate
    {
        return $this->candidate;
    }

    /**
     * @param Candidate $candidate
     *
     * @return Media
     */
    public function setCandidate(Candidate $candidate): Media
    {
        $this->candidate = $candidate;

        return $this;
    }

    public function getSrc(): ?string
    {
        return $this->getPath().DIRECTORY_SEPARATOR.$this->getFilename();
    }
}
