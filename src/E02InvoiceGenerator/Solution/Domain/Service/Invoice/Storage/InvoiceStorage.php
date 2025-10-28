<?php

declare(strict_types=1);

namespace App\E02InvoiceGenerator\Solution\Domain\Service\Invoice\Storage;

interface InvoiceStorage
{
    public function save(string $destination, string $invoiceData): bool;

    public function getContent(string $destination): string;
}
