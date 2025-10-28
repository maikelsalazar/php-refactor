<?php

declare(strict_types=1);

namespace App\E02InvoiceGenerator\Solution\Domain\Model;

use IteratorAggregate;
use Traversable;

class ProductList implements IteratorAggregate
{
    /** @var Product[] */
    private readonly array $list;

    /**
     * @param Product[] $productList
     */
    public function __construct(array $productList)
    {
        foreach ($productList as $product) {
            if (!$product instanceof Product) {
                throw new \InvalidArgumentException('All elements must be an instance of Product');
            }
        }

        $this->list = $productList;
    }

    public function getSubtotal(int $precision = 2): float
    {
        return array_reduce(
            $this->list,
            fn (float $carry, Product $product) => $carry + round($product->getSubtotal(), $precision),
            0.0
        );
    }


    /**
     * @return Product
     */
    public function getIterator(): Traversable
    {
        yield from $this->list;
    }
}
