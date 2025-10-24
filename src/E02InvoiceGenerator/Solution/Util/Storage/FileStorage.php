<?php

declare(strict_types=1);

namespace App\E02InvoiceGenerator\Solution\Util\Storage;

class FileStorage implements Storage
{
    public function save(string $destination, string $data): bool
    {
        return (bool) file_put_contents($destination, $data);
    }

    public function getContent(string $destination): string
    {
        $content = file_get_contents($destination);

        return $content ? $content : '';
    }
}
