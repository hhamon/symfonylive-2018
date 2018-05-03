<?php

namespace App\Shop;

use App\Shop\Visitor\ProductVisitor;
use Money\Currency;
use Money\Money;

class ProductPackage extends PhysicalProduct
{
    /**
     * @var PhysicalProduct[]
     */
    private $products = [];

    public function __construct(array $products, string $sku, Money $salePrice = null)
    {
        if (count($products) < 2) {
            throw new \InvalidArgumentException('Not a combo');
        }

        $this->products = $products;

        parent::__construct(
            $sku,
            $salePrice ?: $this->getTotalPrice(),
            $this->getTotalWeight()
        );
    }

    public function getNumberOfProducts(): int
    {
        return count($this->products);
    }

    private function getTotalPrice(): Money
    {
        $price = new Money(0, new Currency('EUR'));
        foreach ($this->products as $product) {
            $price = $price->add($product->getPrice());
        }

        return $price;
    }

    private function getTotalWeight(): Weight
    {
        $weight = Weight::fromGrams(0);
        foreach ($this->products as $product) {
            $weight = $weight->load($product->getWeight());
        }

        return $weight;
    }

    public function accept(ProductVisitor $visitor): void
    {
        $visitor->visitPackage($this);

        foreach ($this->products as $product) {
            $product->accept($visitor);
        }
    }
}