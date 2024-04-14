<?php

namespace App\Http\Controllers;

use App\Repositories\productRepository;
use Illuminate\Http\Request;

class PublicPanelController extends Controller
{
    public function __construct(productRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function categoryTableGetter(Request $request , $id){
        if($request->isMethod('GET')){
            $id = htmlspecialchars($id);
            $products = $this->productRepository->getProductsByCategoryId($id);
            return view('public/categoryTable' , compact('products'));
        }
    }
    public function productTableByCatIdBrandId( Request $request , $category_id , $brand_id){
        if($request->isMethod('GET')){
             $cat_id = htmlspecialchars($category_id);
             $brand_id = htmlspecialchars($brand_id);
            $products = $this->productRepository->getProductByCatIdBrandId($cat_id , $brand_id);
            return view('public/categoryTable' , compact('products'));
        }
    }
}
