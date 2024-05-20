<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommandeRepository;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    
    #[ORM\Column(length: 255)]
     
    private ?string $etat;

     #[ORM\Column(type:"datetime")]
     
    private ?\DateTimeInterface $date;

    #[ORM\ManyToOne(targetEntity:OrderItem::class)]
     #[ORM\JoinColumn(name:"idOrder", referencedColumnName:"id")]
     
    
    private ?OrderItem $item;

    public function __construct()
    {
        $this->date = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;
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

    public function getItem(): ?OrderItem
    {
        return $this->item;
    }

    public function setItem(?OrderItem $item): self
    {
        $this->item = $item;
        return $this;
    }
    
}
