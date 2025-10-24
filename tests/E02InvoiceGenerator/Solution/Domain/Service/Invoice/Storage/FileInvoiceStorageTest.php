<?php

declare(strict_types=1);

namespace App\E02InvoiceGenerator\Solution\Domain\Service\Invoice\Storage;

use App\E02InvoiceGenerator\Solution\Util\Storage\FakeStorage;
use PHPUnit\Framework\TestCase;

class FileInvoiceStorageTest extends TestCase
{
    private InvoiceStorage $invoiceStorage;

    protected function setUp(): void
    {
        $this->invoiceStorage = new FileInvoiceStorage(new FakeStorage());
    }

    public function testStoragesAInvoice(): void
    {
        $content = 'Invoice ... some details ... totals summary';

        $this->assertTrue($this->invoiceStorage->save('invoice.txt', $content));
        $this->assertSame($content, $this->invoiceStorage->getContent('invoice.txt'));
    }

    public function testReturnsEmptyStringWhenFileDoesNotExist(): void
    {
        $content = 'Invoice ... some details ... totals summary';

        $this->assertTrue($this->invoiceStorage->save('invoice.txt', $content));
        $this->assertSame('', $this->invoiceStorage->getContent('unexisting_file.txt'));
    }

    public function testOverwritesContentWhenSavingMultipleTimes(): void
    {
        $destination      = 'invoice.txt';
        $contentInvoiceV1 = 'Invoice V1';
        $contentInvoiceV2 = 'Invoice V2';
        $contentInvoiceV3 = 'Invoice V3';

        $this->assertTrue($this->invoiceStorage->save($destination, $contentInvoiceV1));
        $this->assertTrue($this->invoiceStorage->save($destination, $contentInvoiceV2));
        $this->assertTrue($this->invoiceStorage->save($destination, $contentInvoiceV3));

        $this->assertSame($contentInvoiceV3, $this->invoiceStorage->getContent($destination));
    }
}
