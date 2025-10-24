<?php

declare(strict_types=1);

namespace App\E02InvoiceGenerator\Solution\Domain\Model;

use PHPUnit\Framework\TestCase;

class InvoiceTest extends TestCase
{
    public function testBuildsInvoice(): void
    {
        $productList = new ProductList(
            [
                new Product('product 1', 10.0, 2.0),
                new Product('product 2', 20.0, 1.0),
            ]
        );

        $subtotal = $productList->getSubtotal();
        $taxRate  = 0.16;

        $invoice = new Invoice($productList, $taxRate);

        $this->assertEquals($subtotal, $invoice->getSubtotal());
        $this->assertEquals($subtotal * $taxRate, $invoice->getTaxes());
        $this->assertEquals($subtotal + ($subtotal * $taxRate), $invoice->getTotal());
    }

    public function testBuildsInvoiceWithEmptyProductList(): void
    {
        $productList = new ProductList([]);

        $invoice = new Invoice($productList, 0.1);

        $this->assertEquals(0.0, $invoice->getSubtotal());
        $this->assertEquals(0.0, $invoice->getTaxes());
        $this->assertEquals(0.0, $invoice->getTotal());
    }
}
