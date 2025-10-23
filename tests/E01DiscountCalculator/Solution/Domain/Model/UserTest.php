<?php

declare(strict_types=1);

namespace App\E01DiscountCalculator\Solution\Domain\Model;

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testBuildsPremiumUser(): void
    {
        $premium = User::fromData(['is_premium' => true]);
        $this->assertInstanceOf(User::class, $premium);
        $this->assertTrue($premium->isPremium());
    }

    public function testBuildsNonPremiumUser(): void
    {
        $regular = User::fromData(['is_premium' => false]);
        $this->assertInstanceOf(User::class, $regular);
        $this->assertFalse($regular->isPremium());
    }

    public function testBuildsUserWithEmptyData(): void
    {
        $user = User::fromData([]);

        $this->assertInstanceOf(User::class, $user);
        $this->assertFalse($user->isPremium(), 'Default user is non-premium');
    }
}
