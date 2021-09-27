<?php

namespace App\Entity;

use App\Repository\ProjectsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Vich\UploaderBundle\Mapping\Annotation\UploadableField;

/**
 * @ORM\Entity(repositoryClass=ProjectsRepository::class)
 * @Vich\Uploadable
 */
class Projects extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private ?string $title;

    /**
     * @ORM\Column(type="text")
     */
    private ?string $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $url;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $thumb;

    /**
     * @Vich\UploadableField(mapping="project_images", fileNameProperty="thumb")
     **/
    private ?File $thumbFilename;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private ?\DateTimeImmutable $created;

    /**
     * @ORM\Column(type="text")
     */
    private ?string $excerpt;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private ?string $details;

    public function __construct() {
        $this->setCreated(new \DateTimeImmutable());
        $this->setThumb(null);
        $this->setThumbFilename(null);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getThumb(): ?string
    {
        return $this->thumb;
    }

    public function setThumb(string $thumb = null): self
    {
        $this->thumb = $thumb;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeImmutable $created): self
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @return string
     */
    public function getExcerpt() : ?string
    {
        return $this->excerpt;
    }

    /**
     * @param string $excerpt
     * @return self
     **/
    public function setExcerpt(string $excerpt): self
    {
        $this->excerpt = $excerpt;
        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(string $details): self
    {
        $this->details = $details;

        return $this;
    }

    public function setThumbFilename(File $thumb = null) : self {
        $this->thumbFilename = $thumb;
        return $this;
    }

    public function getThumbFilename() : ?File {
        return $this->thumbFilename;
    }
}
