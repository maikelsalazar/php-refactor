<?php

declare(strict_types=1);

namespace App\E02InvoiceGenerator\Solution\Domain\Model;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ProductListTest extends TestCase
{
    public function testBuildsProductList(): void
    {
        $productList = new ProductList(
            [
                new Product('product 1', 10.0, 2.0),
                new Product('product 2', 20.0, 1.0),
            ]
        );

        $this->assertSame(40.0, $productList->getSubtotal());
    }

    public function testBuildsProductListFromEmptyList(): void
    {
        $productList = new ProductList(
            []
        );

        $this->assertSame(0.0, $productList->getSubtotal());
    }

    public function testDoesNotBuildProductListFromInvalidItems(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new ProductList(
            [
                new Product('product 1', 10.0, 2.0),
                'product 1'
            ]
        );
    }
}
