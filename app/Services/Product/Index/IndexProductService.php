<?php

namespace App\Services\Product\Index;

use App\Repositories\ProductRepository;

class IndexProductService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(): array
    {
        return $this->productRepository->getAllProducts();
    }
}