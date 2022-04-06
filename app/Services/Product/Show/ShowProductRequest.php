<?php

namespace App\Services\Product\Show;

class ShowProductRequest
{
    private string $productCode;

    public function __construct(string $productCode)
    {
        $this->productCode = $productCode;
    }

    public function getProductCode(): string
    {
        return $this->productCode;
    }
}
