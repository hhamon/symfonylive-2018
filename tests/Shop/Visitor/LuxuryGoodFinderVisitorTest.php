<?php

namespace App\Tests\Shop\Visitor;

use App\Shop\PhysicalProduct;
use App\Shop\ProductPackage;
use App\Shop\Visitor\LuxuryGoodFinderVisitor;
use App\Shop\Weight;
use Money\Money;
use PHPUnit\Framework\TestCase;

class LuxuryGoodFinderVisitorTest extends TestCase
{
    public function testFindLuxuryGoodsInPackage(): void
    {
        $combo = new ProductPackage(
            [
                new PhysicalProduct('12345', Money::EUR(1500), Weight::fromGrams(200)),
                new PhysicalProduct('32874', Money::EUR(900), Weight::fromGrams(300)),
                new PhysicalProduct('38246', Money::EUR(12800), Weight::fromGrams(300)),
                new PhysicalProduct('23843', Money::EUR(1575), Weight::fromGrams(300)),
                new PhysicalProduct('98524', Money::EUR(56500), Weight::fromGrams(300)),
            ],
            '39842'
        );

        $visitor = new LuxuryGoodFinderVisitor(Money::EUR(10000));
        $combo->accept($visitor);

        $this->assertSame(
            [
                '38246' => 'EUR 12800',
                '98524' => 'EUR 56500',
            ],
            $visitor->getLuxuryGoods()
        );
    }
}