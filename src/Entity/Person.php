<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PersonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PersonRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['person:read', 'story:read']],
    denormalizationContext: ['groups' => ['person:write']]
)]
class Person
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['person:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['person:read', 'person:write', 'story:read'])]
    private ?string $username = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['person:read', 'person:write'])]
    private ?string $fullname = null;

    #[ORM\OneToOne(inversedBy: 'person', cascade: ['persist', 'remove'])]
    #[Groups(['person:read', 'person:write'])]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'creater', targetEntity: Story::class)]
    #[Groups(['person:read'])]
    private Collection $stories;

    public function __construct()
    {
        $this->stories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(?string $fullname): self
    {
        $this->fullname = $fullname;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Story>
     */
    public function getStories(): Collection
    {
        return $this->stories;
    }

    public function addStory(Story $story): self
    {
        if (!$this->stories->contains($story)) {
            $this->stories->add($story);
            $story->setCreater($this);
        }

        return $this;
    }

    public function removeStory(Story $story): self
    {
        if ($this->stories->removeElement($story)) {
            // set the owning side to null (unless already changed)
            if ($story->getCreater() === $this) {
                $story->setCreater(null);
            }
        }

        return $this;
    }
}
