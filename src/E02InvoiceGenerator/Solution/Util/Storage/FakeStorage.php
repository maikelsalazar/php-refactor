<?php

declare(strict_types=1);

namespace App\E02InvoiceGenerator\Solution\Util\Storage;

class FakeStorage implements Storage
{
    /**
     * array<string, string>
     */
    private array $files;

    public function save(string $destination, string $data): bool
    {
        $this->files[$destination] = $data;

        return true;
    }

    public function getContent(string $destination): string
    {
        return $this->files[$destination] ?? '';
    }
}
