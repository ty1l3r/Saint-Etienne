<?php

namespace App\Entity;

class SelectionImages
{
 
    private $id;
    private $paysage;
    private $portrait;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getPaysage(): ?string
    {
        return $this->paysage;
    }
    public function setPaysage(string $paysage): self
    {
        $this->paysage = $paysage;
        return $this;
    }
    public function getPortrait(): ?string
    {
        return $this->portrait;
    }
    public function setPortrait(string $portrait): self
    {
        $this->portrait = $portrait;
        return $this;
    }
}