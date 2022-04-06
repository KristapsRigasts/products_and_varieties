<?php

namespace App\Controllers;

use App\Services\Product\Index\IndexProductService;
use App\Services\Product\Show\ShowProductRequest;
use App\Services\Product\Show\ShowProductService;
use App\Services\Product\Varieties\VarietiesProductRequest;
use App\Services\Product\Varieties\VarietiesProductService;
use App\View;

class ProductsController
{
    private IndexProductService $indexProductService;
    private ShowProductService $showProductService;
    private VarietiesProductService $varietiesProductService;

    public function __construct(IndexProductService $indexProductService,
                                ShowProductService $showProductService,
                                VarietiesProductService $varietiesProductService)
    {
        $this->indexProductService = $indexProductService;
        $this->showProductService = $showProductService;
        $this->varietiesProductService = $varietiesProductService;
    }

    public function index(): view
    {

        $products = $this->indexProductService->execute();

        return new View('Products/index', ['products' => $products]);
    }

    public function show(array $vars): View
    {

        $productCode = $vars['id'];

        $product = $this->showProductService->execute(new ShowProductRequest($productCode));

        $varietiesOptions = $this->varietiesProductService->execute(new VarietiesProductRequest($product->getVarieties()));

        return new View('Products/show', [
            'product' => $product,
            'varieties' => $varietiesOptions
            ]);
    }

    public function information(array $vars): View
    {
        $productCode = $vars['id'];

        $options ="";

        if(isset($_POST['option1']) && isset($_POST['option2']))
        {
           $options = strlen($_POST['option1']) >= strlen($_POST['option2'])?
               ".{$_POST['option1']}.{$_POST['option2']}":".{$_POST['option2']}.{$_POST['option1']}";

        }
        else if(isset($_POST['option1']) && !isset($_POST['option2']))
        {
            $options = ".{$_POST['option1']}";
        }

        $information = $productCode . $options;

        return new View('Products/information', ['information' => $information]);
    }
}