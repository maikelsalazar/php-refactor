<?php

declare(strict_types=1);

namespace App\E02InvoiceGenerator\Solution;

use App\E02InvoiceGenerator\Solution\Domain\Model\Product;
use App\E02InvoiceGenerator\Solution\Domain\Model\ProductList;

class InvoiceGenerator
{
    public function generate(array $productsData): string
    {
        $products = $this->buildProductListFromData($productsData);

        $invoiceText = "Invoice\n";
        $invoiceText .= "====================\n";

        /** @var Product $p */
        foreach ($products as $p) {
            $subtotal = $p->getSubtotal();
            $invoiceText .= $p->getName() . ' x ' . $p->getQuantity() . ' = $' . number_format($subtotal, 2) . "\n";
        }

        $total = $products->getSubtotal();
        $tax        = $total * 0.16;
        $finalTotal = $total + $tax;

        $invoiceText .= "====================\n";
        $invoiceText .= 'Subtotal: $' . number_format($total, 2) . "\n";
        $invoiceText .= 'Tax (16%): $' . number_format($tax, 2) . "\n";
        $invoiceText .= 'Total: $' . number_format($finalTotal, 2) . "\n";

        file_put_contents('invoice.txt', $invoiceText);

        return $invoiceText;
    }

    private function buildProductListFromData(array $products): ProductList
    {
        $list = [];
        foreach ($products as $productData) {
            $list[] = Product::fromData($productData);
        }

        return new ProductList($list);
    }
}
