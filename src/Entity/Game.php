<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 64, nullable: true)]
    private $event;

    #[ORM\Column(type: 'string', length: 64, nullable: true)]
    private $site;

    #[ORM\Column(type: 'string', length: 16, nullable: true)]
    private $date;

    #[ORM\Column(type: 'string', length: 32, nullable: true)]
    private $white;

    #[ORM\Column(type: 'string', length: 32, nullable: true)]
    private $black;

    #[ORM\Column(type: 'string', length: 8, nullable: true)]
    private $result;

    #[ORM\Column(type: 'string', length: 8, nullable: true)]
    private $whiteElo;

    #[ORM\Column(type: 'string', length: 8, nullable: true)]
    private $blackElo;

    #[ORM\Column(type: 'string', length: 8, nullable: true)]
    private $eco;

    #[ORM\Column(type: 'string', length: 64, nullable: true)]
    private $fen;

    #[ORM\Column(type: 'string', length: 3072, nullable: true)]
    private $movetext;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEvent(): ?string
    {
        return $this->event;
    }

    public function setEvent(?string $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getSite(): ?string
    {
        return $this->site;
    }

    public function setSite(?string $site): self
    {
        $this->site = $site;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(?string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getWhite(): ?string
    {
        return $this->white;
    }

    public function setWhite(?string $white): self
    {
        $this->white = $white;

        return $this;
    }

    public function getBlack(): ?string
    {
        return $this->black;
    }

    public function setBlack(?string $black): self
    {
        $this->black = $black;

        return $this;
    }

    public function getResult(): ?string
    {
        return $this->result;
    }

    public function setResult(?string $result): self
    {
        $this->result = $result;

        return $this;
    }

    public function getWhiteElo(): ?string
    {
        return $this->whiteElo;
    }

    public function setWhiteElo(?string $whiteElo): self
    {
        $this->whiteElo = $whiteElo;

        return $this;
    }

    public function getBlackElo(): ?string
    {
        return $this->blackElo;
    }

    public function setBlackElo(?string $blackElo): self
    {
        $this->blackElo = $blackElo;

        return $this;
    }

    public function getEco(): ?string
    {
        return $this->eco;
    }

    public function setEco(?string $eco): self
    {
        $this->eco = $eco;

        return $this;
    }

    public function getFen(): ?string
    {
        return $this->fen;
    }

    public function setFen(?string $fen): self
    {
        $this->fen = $fen;

        return $this;
    }

    public function getMovetext(): ?string
    {
        return $this->movetext;
    }

    public function setMovetext(?string $movetext): self
    {
        $this->movetext = $movetext;

        return $this;
    }
}
