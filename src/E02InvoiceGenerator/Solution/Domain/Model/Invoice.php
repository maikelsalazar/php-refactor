<?php

declare(strict_types=1);

namespace App\E02InvoiceGenerator\Solution\Domain\Model;

class Invoice
{
    public function __construct(
        private readonly ProductList $productList,
        private readonly float $taxRate
    ) {

    }

    public function getProductList(): ProductList
    {
        return $this->productList;
    }

    public function getTaxRate(): float
    {
        return $this->taxRate;
    }

    public function getSubtotal(): float
    {
        return $this->productList->getSubtotal();
    }

    public function getTaxes(): float
    {
        return $this->getSubtotal() * $this->taxRate;
    }

    public function getTotal(): float
    {
        return $this->getSubtotal() + $this->getTaxes();
    }
}
