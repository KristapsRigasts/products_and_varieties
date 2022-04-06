<?php

namespace App\Services\Product\Varieties;

use App\Repositories\ProductRepository;


class VarietiesProductService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(VarietiesProductRequest $request): array
    {
        return $this->productRepository->getProductVarieties($request->getProductVarieties());
    }
}