<?php

declare(strict_types=1);

namespace App\E02InvoiceGenerator\Solution\Domain\Service\Invoice\Formatter;

use App\E02InvoiceGenerator\Solution\Domain\Model\Invoice;
use App\E02InvoiceGenerator\Solution\Domain\Model\Product;

class TextInvoiceFormatter implements InvoiceFormatter
{
    public function format(Invoice $invoice): string
    {
        $invoiceText = $this->getHeader();
        $invoiceText .= $this->getSeparator();
        $invoiceText .= $this->getLines($invoice);
        $invoiceText .= $this->getSeparator();
        $invoiceText .= $this->getTotalSummary($invoice);

        return $invoiceText;
    }

    private function getHeader(): string
    {
        $invoiceText = 'Invoice' . PHP_EOL;

        return $invoiceText;
    }

    private function getSeparator(): string
    {
        return '====================' . PHP_EOL;
    }

    private function getLines(Invoice $invoice): string
    {
        $lines = '';
        /** @var Product $product */
        foreach ($invoice->getProductList() as $product) {
            $lines .= sprintf(
                '%s x %s = $%s',
                $product->getName(),
                number_format($product->getQuantity(), 0),
                number_format($product->getSubtotal(), 2)
            ) . PHP_EOL;
        }

        return $lines;
    }

    public function getTotalSummary(Invoice $invoice): string
    {
        $text = sprintf('Subtotal: $%s', number_format($invoice->getSubtotal(), 2)) . PHP_EOL;
        $text .= sprintf(
            'Tax (%d%%): $%s',
            number_format($invoice->getTaxRate() * 100, 0),
            number_format($invoice->getTaxes(), 2)
        ) . PHP_EOL;
        $text .= sprintf('Total: $%s', number_format($invoice->getTotal(), 2)) . PHP_EOL;

        return $text;
    }
}
