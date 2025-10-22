<?php

declare(strict_types=1);

namespace App\E01DiscountCalculator\Solution;

use App\E01DiscountCalculator\Solution\Domain\Model\Order;

class DiscountCalculator
{
    public function calculate(array $orderData): float
    {
        $order    = Order::fromData($orderData);
        $discount = 0;

        if ($order->getUser()) {
            $user = $order->getUser();
            if ($user->isPremium()) {
                if ($order->getTotal() > 1000) {
                    $discount = $order->getTotal() * 0.2;
                } else {
                    $discount = $order->getTotal() * 0.1;
                }
            } else {
                if ($order->getTotal() > 500) {
                    $discount = $order->getTotal() * 0.05;
                } else {
                    if ($order->getCoupon()) {
                        if ($order->getCoupon() === 'WELCOME') {
                            $discount = 50;
                        } else {
                            if ($order->getCoupon() === 'FREESHIP') {
                                if ($order->getShipping() > 0) {
                                    $discount = $order->getShipping();
                                }
                            }
                        }
                    }
                }
            }
        } else {
            if ($order->getGuestDiscount() > 0) {
                $discount = $order->getGuestDiscount();
            }
        }

        if ($discount > $order->getTotal()) {
            $discount = $order->getTotal();
        }

        return $discount;
    }
}
