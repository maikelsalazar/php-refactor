<?php

declare(strict_types=1);

namespace App\E01DiscountCalculator\Solution\Domain\Model;

class Order
{
    public function __construct(
        private readonly float $total,
        private readonly float $shipping,
        private readonly float $guestDiscount,
        private readonly ?string $coupon,
        private readonly ?User $user,
    ) {

    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function getShipping(): float
    {
        return $this->shipping;
    }

    public function getGuestDiscount(): float
    {
        return $this->guestDiscount;
    }

    public function getCoupon(): ?string
    {
        return $this->coupon;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public static function fromData(array $order): self
    {
        $user = isset($order['user']) ? User::fromData($order['user']) : null;

        return new self(
            $order['total']          ?? 0.0,
            $order['shipping']       ?? 0.0,
            $order['guest_discount'] ?? 0.0,
            $order['coupon']         ?? null,
            $user
        );
    }
}
