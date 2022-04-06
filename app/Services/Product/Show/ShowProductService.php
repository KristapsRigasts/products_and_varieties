<?php

namespace App\Services\Product\Show;

use App\Models\Product;
use App\Repositories\ProductRepository;

class ShowProductService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(ShowProductRequest $request): Product
    {
        return $this->productRepository->getProductByCode($request->getProductCode());
    }

}