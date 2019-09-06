<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Selection
{

    private $id;

    private $image;

    private $texte;

    private $textImg;

    private $rdv;

    private $maParoisse;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(string $texte): self
    {
        $this->texte = $texte;

        return $this;
    }

    public function getTextImg(): ?string
    {
        return $this->textImg;
    }

    public function setTextImg(string $textImg): self
    {
        $this->textImg = $textImg;

        return $this;
    }

    public function getRdv(): ?string
    {
        return $this->rdv;
    }

    public function setRdv(string $rdv): self
    {
        $this->rdv = $rdv;

        return $this;
    }

    public function getMaParoisse(): ?string
    {
        return $this->maParoisse;
    }

    public function setMaParoisse(string $maParoisse): self
    {
        $this->maParoisse = $maParoisse;

        return $this;
    }
}
