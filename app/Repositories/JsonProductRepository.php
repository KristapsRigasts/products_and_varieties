<?php

namespace App\Repositories;

use App\Connection;
use App\Models\Options;
use App\Models\Product;
use App\Models\Varieties;

class JsonProductRepository implements ProductRepository
{
    public function getAllProducts(): array
    {
        $products =[];

        foreach ((Connection::connection())['items'] as $product)
        {
            $varieties=[];
            foreach ($product['varieties'] as $varietiesData)
            {
                $varieties[] = $varietiesData;
            }

            $products[] =new Product($product['code'], $product['description'], $varieties);
        }
        return $products;
    }

    public function getProductByCode(string $productCode): Product
    {
        $product ='';

        foreach ((Connection::connection())['items'] as $productData)
        {
            if($productData['code'] == $productCode)
            {
                $productVarieties=[];

                foreach ($productData['varieties'] as $varietiesData)
                {
                    $productVarieties[] = $varietiesData;
                }
                $product = new Product($productData['code'], $productData['description'], $productVarieties);
            }
        }
        return $product;
    }

    public function getProductVarieties(array $productVarieties): array
    {
        $varietiesOptions = [];

        foreach ((Connection::connection())['varieties'] as $varietiesData)
        {
            foreach($productVarieties as $value)
            {
                if($varietiesData['code'] == $value )
                {
                    $options=[];

                    foreach($varietiesData['options'] as $option)
                    {
                        $options[] = new Options($option['code'], $option['description']);
                    }
                    $varietiesOptions[] = new Varieties($varietiesData['code'],$varietiesData['description'], $options);
                }
            }
        }
        return $varietiesOptions;
    }
}