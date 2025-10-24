<?php

declare(strict_types=1);

namespace App\E02InvoiceGenerator\Solution\Util\Helper;

class NumericFormatter
{
    public static function formatMoney(float $amount, int $precision = 2): string
    {
        // Always round to 2 decimals and format as string
        return number_format(round($amount, $precision), $precision, '.', '');
    }

    public static function formatQuantity(float $quantity): string
    {
        // Round to integer if whole number, otherwise show decimals
        return (fmod($quantity, 1) === 0.0) ? (string) (int) $quantity : (string) $quantity;
    }
}
