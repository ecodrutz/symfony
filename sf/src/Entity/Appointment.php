<?php

namespace App\Entity;

use App\Repository\AppointmentRepository;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppointmentRepository::class)]
#[ORM\Table(name: 'appointment')]
class Appointment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private DateTimeInterface $date;

    #[ORM\ManyToOne(targetEntity: Event::class, inversedBy: 'appointments')]
    #[ORM\JoinColumn(name: 'event_id', nullable: false)]
    private Event $event;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(DateTimeInterface $date): Appointment
    {
        $this->date = $date;
        return $this;
    }
}
