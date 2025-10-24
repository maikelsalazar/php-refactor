<?php

declare(strict_types=1);

namespace App\E02InvoiceGenerator\Solution\Domain\Service\Invoice\Formatter;

use App\E02InvoiceGenerator\Solution\Domain\Model\Invoice;
use App\E02InvoiceGenerator\Solution\Domain\Model\Product;
use App\E02InvoiceGenerator\Solution\Util\Helper\NumericFormatter;

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
                NumericFormatter::formatQuantity($product->getQuantity()),
                NumericFormatter::formatMoney($product->getSubtotal())
            ) . PHP_EOL;
        }

        return $lines;
    }

    public function getTotalSummary(Invoice $invoice): string
    {
        $text = sprintf('Subtotal: $%s', NumericFormatter::formatMoney($invoice->getSubtotal())) . PHP_EOL;
        $text .= sprintf(
            'Tax (%d%%): $%s',
            (int) ($invoice->getTaxRate() * 100),
            NumericFormatter::formatMoney($invoice->getTaxes())
        ) . PHP_EOL;
        $text .= sprintf('Total: $%s', NumericFormatter::formatMoney($invoice->getTotal())) . PHP_EOL;

        return $text;
    }
}
