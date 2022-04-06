<?php

namespace App\Repositories;

interface  ProductRepository
{
    public function getAllProducts();
    public function getProductByCode(string $productCode);
    public function getProductVarieties(array $productVarieties);
}

