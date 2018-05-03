<?php

namespace App\Shop\Visitor;

use App\Shop\PhysicalProduct;
use App\Shop\ProductPackage;
use Money\Money;

class LuxuryGoodFinderVisitor implements ProductVisitor
{
    private $luxuryGoodPriceThreshold;
    private $luxuryGoods = [];

    public function __construct(Money $luxuryGoodPriceThreshold)
    {
        $this->luxuryGoodPriceThreshold = $luxuryGoodPriceThreshold;
    }

    public function visitProduct(PhysicalProduct $product): void
    {
        $price = $product->getPrice();
        if ($price->greaterThanOrEqual($this->luxuryGoodPriceThreshold)) {
            $this->luxuryGoods[$product->getSku()] = sprintf(
                '%s %s',
                $price->getCurrency(),
                $price->getAmount()
            );
        }
    }

    public function getLuxuryGoods(): array
    {
        return $this->luxuryGoods;
    }

    public function visitPackage(ProductPackage $package): void
    {
    }
}