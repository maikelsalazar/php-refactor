<?php

declare(strict_types=1);

namespace App\E02InvoiceGenerator\Solution;

use App\E02InvoiceGenerator\Solution\Domain\Model\Invoice;
use App\E02InvoiceGenerator\Solution\Domain\Model\Product;
use App\E02InvoiceGenerator\Solution\Domain\Model\ProductList;
use App\E02InvoiceGenerator\Solution\Domain\Service\Invoice\Formatter\InvoiceFormatter;
use App\E02InvoiceGenerator\Solution\Domain\Service\Invoice\Storage\InvoiceStorage;

class InvoiceGenerator
{
    public function __construct(private readonly InvoiceFormatter $formatter, private readonly InvoiceStorage $storage)
    {

    }

    public function generate(array $productsData): string
    {
        $products = $this->buildProductListFromData($productsData);

        $invoice = new Invoice($products, 0.16);

        $invoiceText = $this->formatter->format($invoice);
        $this->storage->save('invoice.txt', $invoiceText);

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
