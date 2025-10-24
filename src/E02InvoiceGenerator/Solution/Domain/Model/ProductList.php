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

    public function getSubtotal(): float
    {
        return array_reduce($this->list, fn ($carry, Product $product) => $carry + $product->getSubtotal(), 0);
    }


    /**
     * @return Product
     */
    public function getIterator(): Traversable
    {
        yield from $this->list;
    }
}
