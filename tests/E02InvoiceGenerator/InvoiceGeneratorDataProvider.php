<?php

declare(strict_types=1);

namespace Tests\E02InvoiceGenerator;

class InvoiceGeneratorDataProvider
{
    public static function generatesInvoiceTextWithCorrectTotals(): array
    {
        $products = [
            ['name' => 'Keyboard', 'price' => 50, 'quantity' => 1],
            ['name' => 'Mouse', 'price' => 25, 'quantity' => 2],
        ];

        $expectedOutput = <<<TXT
Invoice
====================
Keyboard x 1 = \$50.00
Mouse x 2 = \$50.00
====================
Subtotal: \$100.00
Tax (16%): \$16.00
Total: \$116.00

TXT;
        return [
            [$products, $expectedOutput],
        ];
    }

    public static function createsInvoiceFile(): array
    {
        $products = [
            ['name' => 'USB Cable', 'price' => 10, 'quantity' => 3],
        ];

        $expectedStringsContained = [
            'USB Cable',
            'Total:',
        ];

        return [
            [$products, $expectedStringsContained]
        ];
    }

    public static function handlesEmptyProductList(): array
    {
        $products                 = [];
        $expectedStringsContained = [
            'Subtotal: $0.00',
            'Tax (16%): $0.00',
            'Total: $0.00',
        ];

        return [
            [$products, $expectedStringsContained]
        ];

    }
}
