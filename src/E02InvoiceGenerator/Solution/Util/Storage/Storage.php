<?php

declare(strict_types=1);

namespace App\E02InvoiceGenerator\Solution\Util\Storage;

interface Storage
{
    public function save(string $destination, string $data): bool;

    public function getContent(string $destination): string;
}
