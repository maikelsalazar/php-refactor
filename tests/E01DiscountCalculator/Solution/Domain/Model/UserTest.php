<?php

declare(strict_types=1);

namespace App\E01DiscountCalculator\Solution\Domain\Model;

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testItIsBuildingPremiumUser(): void
    {
        $premium = User::fromData(['premium' => true]);
        $this->assertInstanceOf(User::class, $premium);
        $this->assertTrue($premium->isPremium());
    }

    public function testItIsBuildingNonPremiumUser(): void
    {
        $regular = User::fromData(['premium' => false]);
        $this->assertInstanceOf(User::class, $regular);
        $this->assertFalse($regular->isPremium());
    }

    public function testItIsBuildingWithEmptyData(): void
    {
        $this->assertInstanceOf(User::class, User::fromData([]));
    }
}
