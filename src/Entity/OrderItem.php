<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\OrderItemRepository;

#[ORM\Entity(repositoryClass: OrderItemRepository::class)]
class OrderItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'items', cascade: ["persist"])]
    #[ORM\JoinColumn(nullable: false)]
    private $order;

    #[ORM\Column(type: 'string', length: 255)]
    private $bookTitle;

    #[ORM\Column(type: 'float')]
    private $bookPrice;

    #[ORM\Column(type: 'integer')]
    private $quantity;

    #[ORM\Column(type: 'float')]
    private $total;

    // Constructeur
    public function __construct(){
        
    }

    // Getter pour l'ID
    public function getId(): ?int
    {
        return $this->id;
    }

    // Getter et setter pour order
    public function getOrder(): ?User
    {
        return $this->order;
    }

    public function setOrder(User $order): self
    {
        $this->order = $order;
        return $this;
    }

    // Getter et setter pour bookTitle
    public function getBookTitle(): ?string
    {
        return $this->bookTitle;
    }

    public function setBookTitle(string $bookTitle): self
    {
        $this->bookTitle = $bookTitle;
        return $this;
    }

    // Getter et setter pour bookPrice
    public function getBookPrice(): ?float
    {
        return $this->bookPrice;
    }

    public function setBookPrice(float $bookPrice): self
    {
        $this->bookPrice = $bookPrice;
        return $this;
    }

    // Getter et setter pour quantity
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }

    // Getter et setter pour total
    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;
        return $this;
    }
}
