<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
#[ORM\Table(name: 'event')]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string $name = '';

    #[ORM\OneToMany(mappedBy: 'event', targetEntity: Appointment::class, cascade: ['all'], fetch: 'EAGER')]
    private Collection $appointments;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAppointments(): Collection
    {
        return $this->appointments;
    }
}
