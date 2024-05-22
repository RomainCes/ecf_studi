<?php

// src/Entity/Live.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

class Live
{
    private $id;

    private $name;

    private $date;

    private $streamer;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;
        return $this;
    }

    public function getStreamer(): ?Streamer
    {
        return $this->streamer;
    }

    public function setStreamer(?Streamer $streamer): self
    {
        $this->streamer = $streamer;
        return $this;
    }
}
