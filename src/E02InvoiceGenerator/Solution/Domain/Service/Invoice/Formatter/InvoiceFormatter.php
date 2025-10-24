<?php

declare(strict_types=1);

namespace App\E02InvoiceGenerator\Solution\Domain\Service\Invoice\Formatter;

use App\E02InvoiceGenerator\Solution\Domain\Model\Invoice;

interface InvoiceFormatter
{
    public function format(Invoice $invoice): string;
}
