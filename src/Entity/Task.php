<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TaskRepository::class)
 */
class Task
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="date")
     */
    private ?DateTimeInterface $dueDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $text;

    /**
     * Task constructor.
     * @param DateTimeInterface|null $dueDate
     * @param string|null $text
     */
    public function __construct(?DateTimeInterface $dueDate, ?string $text)
    {
        $this->dueDate = $dueDate;
        $this->text = $text;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDueDate(): ?DateTimeInterface
    {
        return $this->dueDate;
    }

    public function setDueDate(DateTimeInterface $dueDate): self
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }
}
