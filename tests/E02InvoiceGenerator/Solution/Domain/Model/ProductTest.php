<?php

declare(strict_types=1);

namespace App\E02InvoiceGenerator\Solution\Domain\Model;

use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testCalculatesSubtotal(): void
    {
        $product = new Product('product1', 10.0, 5.0);

        $this->assertSame(10.0 * 5.0, $product->getSubtotal());
    }

    public function testBuildsAProduct(): void
    {
        $productData = [
            'name'     => 'product 1',
            'price'    => 50.0,
            'quantity' => 1.0,
        ];

        $product = Product::fromData($productData);

        $this->assertSame($productData['name'], $product->getName());
        $this->assertSame($productData['price'], $product->getPrice());
        $this->assertSame($productData['quantity'], $product->getQuantity());
        $this->assertSame($productData['price'] * $productData['quantity'], $product->getSubtotal());
    }

    public function testBuildsDefaultProductWithEmptyData(): void
    {
        $productData = [];

        $product = Product::fromData($productData);

        $this->assertSame('', $product->getName());
        $this->assertSame(0.0, $product->getPrice());
        $this->assertSame(0.0, $product->getQuantity());
        $this->assertSame(0.0, $product->getSubtotal());
    }
}
