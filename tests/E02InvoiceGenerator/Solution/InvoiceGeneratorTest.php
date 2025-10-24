<?php

declare(strict_types=1);

namespace App\E02InvoiceGenerator\Solution;

use App\E02InvoiceGenerator\Solution\Domain\Service\Invoice\Formatter\TextInvoiceFormatter;
use App\E02InvoiceGenerator\Solution\Domain\Service\Invoice\Storage\FileInvoiceStorage;
use App\E02InvoiceGenerator\Solution\Domain\Service\Invoice\Storage\InvoiceStorage;
use App\E02InvoiceGenerator\Solution\Util\Storage\FakeStorage;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use Tests\E02InvoiceGenerator\InvoiceGeneratorDataProvider;

class InvoiceGeneratorTest extends TestCase
{
    private const INVOICE_FILE = 'invoice.txt';

    private InvoiceGenerator $invoiceGenerator;
    private InvoiceStorage $storage;

    protected function setUp(): void
    {
        $formatter = new TextInvoiceFormatter();

        $this->storage = new FileInvoiceStorage(new FakeStorage());

        $this->invoiceGenerator = new InvoiceGenerator($formatter, $this->storage);
    }

    #[DataProviderExternal(InvoiceGeneratorDataProvider::class, 'generatesInvoiceTextWithCorrectTotals')]
    public function testGeneratesInvoiceTextWithCorrectTotals(array $products, $expectedOutput): void
    {
        $output = $this->invoiceGenerator->generate($products);

        $this->assertSame($expectedOutput, $output);
    }

    #[DataProviderExternal(InvoiceGeneratorDataProvider::class, 'createsInvoiceFile')]
    public function testStoresInvoiceContent(array $products, array $expectedStringsContained): void
    {
        $this->invoiceGenerator->generate($products);

        $content = $this->storage->getContent(self::INVOICE_FILE);

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
