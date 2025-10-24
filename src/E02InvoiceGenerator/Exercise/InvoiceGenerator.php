<?php

declare(strict_types=1);

namespace App\E02InvoiceGenerator\Exercise;

class InvoiceGenerator
{
    public function generate(array $products): string
    {
        $total       = 0;
        $invoiceText = "Invoice\n";
        $invoiceText .= "====================\n";

        foreach ($products as $p) {
            $subtotal = $p['price'] * $p['quantity'];
            $invoiceText .= $p['name'] . ' x ' . $p['quantity'] . ' = $' . number_format($subtotal, 2) . "\n";
            $total += $subtotal;
        }

        $tax        = $total * 0.16;
        $finalTotal = $total + $tax;

        $invoiceText .= "====================\n";
        $invoiceText .= 'Subtotal: $' . number_format($total, 2) . "\n";
        $invoiceText .= 'Tax (16%): $' . number_format($tax, 2) . "\n";
        $invoiceText .= 'Total: $' . number_format($finalTotal, 2) . "\n";

        file_put_contents('invoice.txt', $invoiceText);

        return $invoiceText;
    }
}
