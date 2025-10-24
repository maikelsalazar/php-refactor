<?php

declare(strict_types=1);

namespace App\E02InvoiceGenerator\Exercise;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use Tests\E02InvoiceGenerator\InvoiceGeneratorDataProvider;

class InvoiceGeneratorTest extends TestCase
{
    private const INVOICE_FILE = 'invoice.txt';

    private InvoiceGenerator $invoiceGenerator;

    protected function setUp(): void
    {
        $this->invoiceGenerator = new InvoiceGenerator();
    }

    protected function tearDown(): void
    {
        // Clean up file created by the generator
        if (file_exists(self::INVOICE_FILE)) {
            unlink(self::INVOICE_FILE);
        }
    }

    #[DataProviderExternal(InvoiceGeneratorDataProvider::class, 'generatesInvoiceTextWithCorrectTotals')]
    public function testGeneratesInvoiceTextWithCorrectTotals(array $products, $expectedOutput): void
    {
        $output = $this->invoiceGenerator->generate($products);

        $this->assertSame($expectedOutput, $output);
    }

    #[DataProviderExternal(InvoiceGeneratorDataProvider::class, 'createsInvoiceFile')]
    public function testCreatesInvoiceFile(array $products, array $expectedStringsContained): void
    {
        $this->invoiceGenerator->generate($products);

        $this->assertFileExists(self::INVOICE_FILE);
        $content = file_get_contents(self::INVOICE_FILE);

        foreach ($expectedStringsContained as $expectedStringContained) {
            $this->assertStringContainsString($expectedStringContained, $content);
        }
    }

    #[DataProviderExternal(InvoiceGeneratorDataProvider::class, 'handlesEmptyProductList')]
    public function testHandlesEmptyProductList(array $products, array $expectedStringsContained): void
    {
        $output = $this->invoiceGenerator->generate($products);

        foreach ($expectedStringsContained as $expectedStringContained) {
            $this->assertStringContainsString($expectedStringContained, $output);
        }
    }
}
