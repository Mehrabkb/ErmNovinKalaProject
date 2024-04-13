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
}
