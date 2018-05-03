<?php

namespace App\Shop;

final class Weight
{
    private $value;

    private function __construct(int $grams)
    {
        if ($grams < 0) {
            throw new \InvalidArgumentException('You may not be on Earth...');
        }

        $this->value = $grams;
    }

    public static function fromGrams(int $grams): self
    {
        return new self($grams);
    }

    public static function fromKilogram(float $kilograms): self
    {
        return new self($kilograms * 1000);
    }

    public function load(self $weight): self
    {
        return new self($this->value + $weight->value);
    }

    public function lighten(self $weight): self
    {
        if ($weight->value > $this->value) {
            throw new \InvalidArgumentException('Invalid');
        }

        return new self($this->value - $weight->value);
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }

    public function getValue(): int
    {
        return $this->value;
    }
}