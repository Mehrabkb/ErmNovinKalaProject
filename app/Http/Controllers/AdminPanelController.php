<?php

namespace App\Http\Controllers;

use App\Repositories\alertifyRepository;
use App\Repositories\productRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Middleware\ThrottleRequestsWithRedis;
use Illuminate\Support\Facades\Auth;

class AdminPanelController extends Controller
{
    public function __construct(UserRepository $userRepository , productRepository $productRepository , alertifyRepository $alertifyRepository)
    {
        $this->middleware('checkUserLogin');
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->alertifyRepository = $alertifyRepository;
    }

    public function index(Request $request){
        return view('panel/home');
    }
    public function product(Request $request){
        switch ($request->method()){
            case 'GET':
                return view('panel/product/all');
        }
    }
    public function tag(Request $request){
        switch($request->method()){
            case 'GET' :
                $tags = $this->productRepository->getAllTags();
                return view('panel/product/tag' , compact('tags'));
        }
    }
    public function editTag(Request $request){
        switch ($request->method()){
            case 'GET' :
                $tag_id = htmlspecialchars($request->input('tag-id'));
                return $this->productRepository->getTagById($tag_id);
            case 'POST':
                $validate = $request->validate([
                    'tags-title' => 'required',
                    'tags-value' => 'required'
                ],
                    [
                        'tags-title.required' => 'نام تگ نمیتواند خالی باشد',
                        'tags-value.required' => 'مقدار تگ نمی تواند خالی باشد'
                    ]);
                if($validate){
                    $tag_id = htmlspecialchars($request->input('tag-data-id'));
                    $tags_title = htmlspecialchars($request->input('tags-title'));
                    $tags_value = htmlspecialchars($request->input('tags-value'));
                    $data = [
                        'tags-title' => $tags_title,
                        'tags-value' => $tags_value
                    ];
                    if($this->productRepository->editTagById($tag_id , $data)){
                        return $this->alertifyRepository->successMessage('با موفقیت ویرایش شد');
                    }else{
                        return $this->alertifyRepository->errorMessage('ویرایش با مشکل مواجه شده است');
                    }

                }
        }
    }
    public function addTag(Request $request){
        if($request->method() == 'POST'){
            $validate = $request->validate([
                'tags-title' => 'required',
                'tags-value' => 'required'
            ],
            [
                'tags-title.required' => 'نام تگ نمیتواند خالی باشد',
                'tags-value.required' => 'مقدار تگ نمی تواند خالی باشد'
            ]);
            if($validate){
                $tags_title = htmlspecialchars($request->input('tags-title'));
                $tags_value = htmlspecialchars($request->input('tags-value'));
                $data = [
                    'tags-title' => $tags_title,
                    'tags-value' => $tags_value
                ];
                if($this->productRepository->addTag($data)){
                    return $this->alertifyRepository->successMessage('با موفقیت ذخیره شد');
                }else{
                    return $this->alertifyRepository->errorMessage('مشکلی در ثبت تگ رخ داده است');
                }
            }
        }
    }

    public function deleteTag(Request $request){
        if($request->method() == 'POST'){
            $validate = $request->validate([
                'tag-data-id' => 'required'
            ],
            [
                'tag-data-id.required' => 'مشکلی رخ داده است'
            ]);
            if($validate){
                $tag_data_id = htmlspecialchars($request->input('tag-data-id'));
                if($this->productRepository->deleteTag($tag_data_id)){
                    return $this->alertifyRepository->successMessage('با موفقیت حذف شد');
                }else{
                    return $this->alertifyRepository->errorMessage('مشکلی در حذف آیتم رخ داده است');
                }
            }
        }
    }
    public function addProduct(Request $request){
        switch($request->method()){
            case 'GET':
                $products = $this->productRepository->allProductsFrontEndData();
                $categories = $this->productRepository->getAllCategories();
                $productStatuses = $this->productRepository->allProductStatuses();
                $brands = $this->productRepository->getAllBrand();
                $tags = $this->productRepository->getAllTags();
                return view('panel/product/add' , compact('products' , 'categories' , 'productStatuses' , 'brands' , 'tags'));
                break;
            case 'POST':
                $validate = $request->validate([
                    'product-title' => 'required',
                    'product-balance' => 'required',
                    'product-price' => 'required',
                    'product-category-id' => 'required',
                    'product-status-id' => 'required',
                    'product-brand-id' => 'required',
                    'product-tag-id' => 'required'
                ],[
                    'product-title.required' => 'عنوان محصول الزامی می باشد',
                    'product-balance.required' => 'موجودی الزامی می باشد',
                    'product-price.required' => 'قیمت الزامی می باشد',
                    'product-category-id.required' => 'دسته بندی الزامی می باشد',
                    'product-status-id.required' => 'وضعیت نمی تواند خالی باشد',
                    'product-brand-id.required' => 'برند نمیتواند خالی باشد',
                    'product-tag-id.required' => 'تگ نمیتواند خالی باشد'
                ]);
                if($validate){
                    $data = [];
                    $data['product-title'] = htmlspecialchars($request->input('product-title'));
                    $data['product-balance'] = htmlspecialchars($request->input('product-balance'));
                    $data['product-price'] = htmlspecialchars($request->input('product-price'));
                    $data['product-category-id'] = htmlspecialchars($request->input('product-category-id'));
                    $data['product-status-id'] = htmlspecialchars($request->input('product-status-id'));
                    $data['product-brand-id'] = htmlspecialchars($request->input('product-brand-id'));
                    $data['product-tag-id'] = htmlspecialchars($request->input('product-tag-id'));
                    
                }
                break;
        }
    }
    public function unit(Request $request){
        switch($request->method()){
            case 'GET':
                $units = $this->productRepository->getAllUnits();
                return view('panel/product/unit' , compact('units'));
        }
    }
    public function importExport(Request $request){
        switch($request->method()){
            case 'GET':
                return view('panel/product/importExport');
        }
    }
    public function feature(Request $request){
        switch($request->method()){
            case 'GET':
                return view('panel/product/feature');
        }
    }
    public function category(Request $request){
        switch ($request->method()){
            case 'GET':
                $categories = $this->productRepository->allCategoriesWithParentName();
                $tags = $this->productRepository->getAllTags();
                return view('panel/product/category' , compact('categories' , 'tags'));
                break;
        }
    }
    public function deleteCategory(Request $request){
        if($request->method() == 'POST'){
            $validate = $request->validate([
                'category-data-id' => 'required'
            ],[
                'category-data-id.required' => 'آیدی دسته بندی الزامی می باشد'
            ]);
            if($validate){
                $product_category_id = htmlspecialchars($request->input('category-data-id'));
                if($this->productRepository->deleteCategoryById($product_category_id)){
                    return $this->alertifyRepository->successMessage('با موفقیت حذف شد');
                }else{
                    return $this->alertifyRepository->errorMessage('مشکلی در حذف آیتم مورد نظر رخ داده است');
                }
            }
        }
    }
    public function addCategory(Request $request){
        if($request->method() == 'POST'){
            $validate = $request->validate([
                'persian-category' => 'required',
                'main-image' => 'image|mimes:jpeg,jpg,png,webp'
            ],[
                'persian-category.required' => 'نام فارسی دسته بندی الزامی می باشد',
                'main-image.image' => 'فایل تصویر معتبر نمی باشد',
                'main-image.mimes' => 'فرمت عکس معتبر نمی باشد'
            ]);
            if($validate){
                $english_category = htmlspecialchars($request->input('english-category'));
                $persian_category = htmlspecialchars($request->input('persian-category'));
                $tag_id = htmlspecialchars($request->input('tag-id'));
                $category_parent = htmlspecialchars($request->input('category-parent'));
                $imageName = '';
                if($request->hasFile('main-image')){
                    $image = $request->file('main-image');
                    $imageName = 'images/' . time() . '.' . request()->file('main-image')->getClientOriginalExtension();

                    $image->move(public_path('images'), $imageName);

                }
                $data = [
                    'english_category' => $english_category,
                    'persian_category' => $persian_category,
                    'tag_id' => $tag_id,
                    'parent_category_id' => $category_parent,
                    'image' => $imageName
                ];
                if($this->productRepository->addCategory($data)){
                    return redirect()->back()->with(['success' => 'با موفقیت ثبت شد']);
                }else{
                    return redirect()->back()->withErrors('مشکلی رخ داده است');
                }

            }
        }
    }
    public function getCategorySingle(Request $request){
        if($request->method() == 'GET'){
            $product_category_id = htmlspecialchars($request->input('category_id'));
            return $this->productRepository->getCategoryById($product_category_id);
        }
    }
    public function editCategory(Request $request){
        if($request->method() == 'POST'){
            $category_id = htmlspecialchars($request->input('product-category-data-id'));
            $english_category = htmlspecialchars($request->input('english-category'));
            $persian_category = htmlspecialchars($request->input('persian-category'));
            $tag_id = htmlspecialchars($request->input('tag-id'));
            $category_parent = htmlspecialchars($request->input('category-parent'));
            $imageName = '';
            if($request->hasFile('main-image-edit')){
                $image = $request->file('main-image-edit');
                $imageName = 'images/' . time() . '.' . request()->file('main-image-edit')->getClientOriginalExtension();

                $image->move(public_path('images'), $imageName);

            }
            $data = [
                'english_category' => $english_category,
                'persian_category' => $persian_category,
                'tag_id' => $tag_id,
                'parent_category_id' => $category_parent,
            ];
            if($imageName != ''){
                $data['image'] = url($imageName);
            }
            if($this->productRepository->editCategoryById($category_id , $data)){
                return redirect()->back()->with(['success' => 'با موفقیت ثبت شد']);
            }else{
                return redirect()->back()->withErrors('مشکلی رخ داده است');
            }
        }
    }
    public function brand(Request $request){
        if($request->method() == 'GET'){
            $brands = $this->productRepository->getAllBrand();
            return view('panel/product/brand' , compact('brands'));
        }
    }
    public function addBrand(Request $request){
        if($request->method() == 'POST'){
            $validate = $request->validate([
                'brand-title' => 'required',
                'main-image' => 'image|mimes:jpeg,jpg,png,webp'
            ],[
                'brand-title.required' => 'نام  برند نمیتواند خالی باشد',
                'main-image.image' => 'فایل عکس معتبر نمیباشد',
                'main-image.mimes' => 'فرمت عکس معتبر نمی باشد'
            ]);
            if($validate){
                $data = [];
                $data['brand_title'] = htmlspecialchars($request->input('brand-title'));
                if($request->hasFile('main-image')){
                    $image = $request->file('main-image');
                    $imageName = 'images/' . time() . '.' . request()->file('main-image')->getClientOriginalExtension();

                    $image->move(public_path('images'), $imageName);
                    $data['brand_logo'] = url($imageName);
                }
                if($this->productRepository->addBrand($data)){
                    return redirect()->back()->with(['success' => 'با موفقیت ثبت شد']);
                }else{
                    return redirect()->back()->withErrors('مشکلی رخ داده است');
                }
            }
        }
    }
    public function deleteBrand(Request $request){
        $validate = $request->validate([
            'brand-data-id' => 'required'
        ],[
            'brand-data-id.required' => 'ایدی نمیتواند خالی باشد'
        ]);
        if($validate){
            $brand_id = htmlspecialchars($request->input('brand-data-id'));
            if($this->productRepository->deleteBrandById($brand_id)) {
                return redirect()->back()->with(['success' => 'با موفقیت حذف شد']);
            }else {
                return redirect()->back()->withErrors('مشکلی رخ داده است');
            }
        }
    }
    public function getBrandSingle(Request $request){
        if($request->isMethod('GET')){
            $validate = $request->validate([
                'product-brand-id' => 'required'
            ],[
                'product-brand-id.required' => 'ایدی نمیتواند خالی باشد'
            ]);
            if($validate){
                $brand_id = htmlspecialchars($request->input('product-brand-id'));
                return $this->productRepository->getBrandByBrandId($brand_id);
            }
        }
    }
    public function editBrand(Request $request){
        if($request->isMethod('POST')){
            $validate = $request->validate([
                'product-brand-data-id' => 'required',
                'main-image' => 'image|mimes:jpg,jpeg,png,webp'
            ],[
                'product-brand-data-id.required' => 'ایدی الزامی می باشد',
                'main-image.image' => 'فایل نامعتبر است',
                'main-image.mimes' => 'فرمت فایل نامعتبر است'
            ]);
            if($validate){
                $brand_id = htmlspecialchars($request->input('product-brand-data-id'));
                $brand_title = htmlspecialchars($request->input('brand-title'));
                $data = [];
                isset($brand_id) ? $data['product-brand-id'] = $brand_id : '';
                isset($brand_title) ? $data['brand_name'] = $brand_title : '';
                if($request->hasFile('main-image')){
                    $image = $request->file('main-image');
                    $imageName = 'images/' . time() . '.' . request()->file('main-image')->getClientOriginalExtension();

                    $image->move(public_path('images'), $imageName);
                    $data['brand_logo'] = url($imageName);
                }
                if($this->productRepository->updateBrandById($brand_id , $data)){
                    return redirect()->back()->with(['success' => 'با موفقیت ذخیره شد']);
                }else{
                    return redirect()->back()->withErrors('مشکلی در آپدیت مورد نظر رخ داده است ');
                }
            }

        }
    }
    public function addUnit(Request $request){
        if($request->method() == 'POST'){
            $validate = $request->validate([
                'long-title' => 'required ',
                'short-title' => 'required | regex:/^[a-zA-Z]+$/'
            ],[
                'long-title.required' => 'نام کامل واحد الزامی است',
//                'long-title.regex' => 'نام کامل واحد به صورت صحیح وارد نشده است',
                'short-title.required' => 'علامت واحد الزامی است',
                'short-title.regex' => 'فرمت علامت واحد صحیح نمی باشد'
            ]);
            if($validate){
                $long_title = htmlspecialchars($request->input('long-title'));
                $short_title = htmlspecialchars($request->input('short-title'));
                if($this->productRepository->addUnit($long_title , $short_title)){
                    return $this->alertifyRepository->successMessage('با موفقیت ثبت شد');
                }else{
                    return $this->alertifyRepository->errorMessage('خطایی در ثبت واحد رخ داده است');
                }
            }else{
                return $this->alertifyRepository->errorMessage('لطفا در وارد کردن مقادیر دقت کنید');
            }
        }
    }
    public function deleteUnit(Request $request)
    {
        if($request->method() == 'POST'){
            $unit_id = htmlspecialchars($request->input('unit-data-id'));
            if($this->productRepository->deleteUnitById($unit_id)){
                return  $this->alertifyRepository->successMessage('با موفقیت حذف شد');
            }else{
                return $this->alertifyRepository->errorMessage('خطایی در حذف مورد رخ داده است');
            }
        }else{
            return $this->alertifyRepository->errorMessage('درخواست نامعتبر');
        }

    }
    public function getUnit(Request $request){
        if($request->method() == 'GET'){
            $unit_id = htmlspecialchars($request->input('id'));
            $unit = $this->productRepository->getUnitByUnitId($unit_id);
            return $unit;
        }
    }
    public function editUnit(Request $request){
        if($request->method() == 'POST'){
            $validate = $request->validate([
                'unit-data-id' => 'required',
                'long-title' => 'required ',
                'short-title' => 'required | regex:/^[a-zA-Z]+$/'
            ],[
                'long-title.required' => 'نام کامل واحد الزامی است',
//                'long-title.regex' => 'نام کامل واحد به صورت صحیح وارد نشده است',
                'short-title.required' => 'علامت واحد الزامی است',
                'short-title.regex' => 'فرمت علامت واحد صحیح نمی باشد'
            ]);
            if($validate){
                $data = [];
                $unit_id = htmlspecialchars($request->input('unit-data-id'));
                $data['long_title'] = htmlspecialchars($request->input('long-title'));
                $data['short_title'] = htmlspecialchars($request->input('short-title'));
                if($this->productRepository->editUnitBySelectId($unit_id , $data)){
                    return $this->alertifyRepository->successMessage('با موفقیت ویرایش شد');
                }else{
                    return $this->alertifyRepository->errorMessage('مشکلی رخ داده است');
                }
            }
        }
    }
    public function logout($id){
        if($this->userRepository->logoutUserById($id)){
            return redirect()->route('login');
        }else{
            return redirect()->back()->withErrors(['msg' => 'در خروج شما از سیستم مشکلی پیش امده است']);
        }
    }
}
