<?php

namespace App\Services\Product\Varieties;

class VarietiesProductRequest
{
    private array $productVarieties;

    public function __construct(array $productVarieties)
    {
        $this->productVarieties = $productVarieties;
    }

    public function getProductVarieties(): array
    {
        return $this->productVarieties;
    }
}