<?php

namespace App\Tests\Shop;

use App\Shop\PhysicalProduct;
use App\Shop\ProductPackage;
use App\Shop\Weight;
use Money\Money;
use PHPUnit\Framework\TestCase;

class ProductPackageTest extends TestCase
{
    public function testProductPackage(): void
    {
        $combo = new ProductPackage(
            [
                new PhysicalProduct('12345', Money::EUR(1500), Weight::fromGrams(200)),
                new PhysicalProduct('32874', Money::EUR(900), Weight::fromGrams(300)),
            ],
            '39842',
            Money::EUR(2000)
        );

        $this->assertEquals(
            Money::EUR(2000),
            $combo->getPrice()
        );

        $this->assertEquals(
            Weight::fromGrams(500),
            $combo->getWeight()
        );
    }
}