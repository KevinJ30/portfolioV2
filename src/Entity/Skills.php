<?php

namespace App\Entity;

use App\Repository\SkillsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SkillsRepository::class)
 */
class Skills
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $icons;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $level;

    /**
     * @ORM\Column(type="string", length=100)
     **/
    private $type;

    public function __construct() {
        $this->setLevel(0);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIcons(): ?string
    {
        return $this->icons;
    }

    public function setIcons(string $icons): self
    {
        $this->icons = $icons;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        if($level > 5) {
            $this->level = 5;
        }
        else if($level < 0) {
            $this->level = 0;
        }
        else {
            $this->level = $level;
        }

        return $this;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(string $type): self {
        $this->type = $type;
        
        return $this;
    }
}
