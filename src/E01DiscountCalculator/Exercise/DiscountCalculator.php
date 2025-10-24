<?php

declare(strict_types=1);

namespace App\E01DiscountCalculator\Exercise;

class DiscountCalculator
{
    public function calculate(array $order): float
    {
        $discount = 0;

        if (isset($order['user'])) {
            $user = $order['user'];
            if ($user['is_premium']) {
                if ($order['total'] > 1000) {
                    $discount = $order['total'] * 0.2;
                } else {
                    $discount = $order['total'] * 0.1;
                }
            } else {
                if ($order['total'] > 500) {
                    $discount = $order['total'] * 0.05;
                } else {
                    if (isset($order['coupon'])) {
                        if ($order['coupon'] === 'WELCOME') {
                            $discount = 50;
                        } else {
                            if ($order['coupon'] === 'FREESHIP') {
                                if ($order['shipping'] > 0) {
                                    $discount = $order['shipping'];
                                }
                            }
                        }
                    }
                }
            }
        } else {
            if (isset($order['guest_discount'])) {
                $discount = $order['guest_discount'];
            }
        }

        if ($discount > $order['total']) {
            $discount = $order['total'];
        }

        return $discount;
    }
}
