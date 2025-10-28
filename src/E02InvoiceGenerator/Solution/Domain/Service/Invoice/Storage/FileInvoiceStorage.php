<?php

declare(strict_types=1);

namespace App\E02InvoiceGenerator\Solution\Domain\Service\Invoice\Storage;

use App\E02InvoiceGenerator\Solution\Util\Storage\Storage;

class FileInvoiceStorage implements InvoiceStorage
{
    public function __construct(private readonly Storage $storage)
    {

    }

    public function save(string $destination, string $invoiceData): bool
    {
        return $this->storage->save($destination, $invoiceData);
    }

    public function getContent(string $destination): string
    {
        return $this->storage->getContent($destination);
    }
}
