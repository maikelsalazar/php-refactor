<?php

declare(strict_types=1);

namespace App\E02InvoiceGenerator\Solution\Domain\Service\Invoice\Formatter;

use App\E02InvoiceGenerator\Solution\Domain\Model\Invoice;
use App\E02InvoiceGenerator\Solution\Domain\Model\Product;
use App\E02InvoiceGenerator\Solution\Domain\Model\ProductList;
use PHPUnit\Framework\TestCase;

class TextInvoiceFormatterTest extends TestCase
{
    private InvoiceFormatter $formatter;

    protected function setUp(): void
    {
        $this->formatter = new TextInvoiceFormatter();
    }

    public function testFormatInvoiceInText(): void
    {
        $productList = new ProductList(
            [
                new Product('Keyboard', 50.0, 1.0),
                new Product('Mouse', 25.0, 2.0),
            ]
        );

        $invoice = new Invoice($productList, 0.16);

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

        $this->assertSame($expectedOutput, $this->formatter->format($invoice));
    }

    public function testFormatEmptyInvoiceInText(): void
    {
        $productList = new ProductList([]);

        $invoice = new Invoice($productList, 0.16);

        $expectedOutput = <<<TXT
Invoice
====================
====================
Subtotal: \$0.00
Tax (16%): \$0.00
Total: \$0.00

TXT;

        $this->assertSame($expectedOutput, $this->formatter->format($invoice));
    }
}
