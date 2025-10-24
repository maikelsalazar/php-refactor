<?php

declare(strict_types=1);

namespace App\E02InvoiceGenerator\Solution\Domain\Model;

class Product
{
    public function __construct(
        private readonly string $name,
        private readonly float $price,
        private readonly float $quantity
    ) {

    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getQuantity(): float
    {
        return $this->quantity;
    }

    public function getSubtotal(): float
    {
        return $this->price * $this->quantity;
    }

    public static function fromData(array $productData): self
    {
        return new self(
            trim($productData['name']             ?? ''),
            (float) ($productData['price']    ?? 0.0),
            (float) ($productData['quantity'] ?? 0.0),
        );
    }
}
