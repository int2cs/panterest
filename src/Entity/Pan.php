<?php

namespace App\Entity;

use App\Entity\Traits\Timestampable;
use App\Repository\PanRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PanRepository::class)
 * @ORM\Table(name="pans")
 * @ORM\HasLifecycleCallbacks
 */
class Pan
{
    use Timestampable;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez renseigner un titre.")
     * @Assert\Length(min=3, minMessage="Un titre doit contenir plus de 3 caractères.")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Veuillez renseigner une description.")
     * @Assert\Length(min=10, minMessage="Une description doit contenir plus de 3 caractères."))
     * 
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
