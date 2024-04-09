<?php

namespace App\Http\Controllers;

use App\Imports\categoryImporterClass;
use App\Repositories\alertifyRepository;
use App\Repositories\productRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Middleware\ThrottleRequestsWithRedis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;

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
        $productsCount = $this->productRepository->getProductsCount();
        $brandsCount = $this->productRepository->getBrandsCount();
        $categoriesCount = $this->productRepository->getCategoriesCount();
        return view('panel/home' , compact('productsCount' , 'brandsCount' , 'categoriesCount'));
    }
    public function product(Request $request){
        switch ($request->method()){
            case 'GET':
                $products = DB::table('products')
                    ->join('product_categories' , 'products.product_category_id' , '=' , 'product_categories.product_category_id')
                    ->join('product_statuses' , 'products.product_status_id' , '=' , 'product_statuses.product_status_id')
                    ->join('users' , 'products.user_publisher_id' , '=' , 'users.user_id')
                    ->leftJoin('product_brands' , 'products.product_brand_id' , '=' , 'product_brands.product_brand_id')
                    ->leftJoin('public_tags' , 'products.product_tag_id' , '=' , 'public_tags.public_tag_id')
                    ->get();
                return view('panel/product/all' , compact('products'));
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
    public function deleteProduct(Request $request){
        if($request->isMethod('POST')){
            $validate = $request->validate([
                'product-id' => 'required'
            ],[
                'product-id.required' => 'ایدی محصول نمیتواند خالی باشد'
            ]);
            if($validate){
                $product_id = htmlspecialchars($request->input('product-id'));
                if($this->productRepository->deleteProductByProductId($product_id)){
                    return redirect()->back()->with(['success' => 'با موفقیت حذف شد']);
                }else{
                    return redirect()->back()->withErrors(['مشکلی در حذف این آیتم رخ داده است']);
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
                    'product-company-price' => 'required',
                    'product-category-id' => 'required',
                    'product-status-id' => 'required',
                    'product-brand-id' => 'required',
                    'main-image' => 'image | mimes:jpg,jpeg,png,webp'
                ],[
                    'product-title.required' => 'عنوان محصول الزامی می باشد',
                    'product-balance.required' => 'موجودی الزامی می باشد',
                    'product-price.required' => 'قیمت الزامی می باشد',
                    'product-company-price.required' => 'قیمت غیر رسمی الزامی می باشد',
                    'product-category-id.required' => 'دسته بندی الزامی می باشد',
                    'product-status-id.required' => 'وضعیت نمی تواند خالی باشد',
                    'product-brand-id.required' => 'برند نمیتواند خالی باشد',
                    'main-image.image' => 'فایل عکس معتبر نمی باشد',
                    'main-image.mimes' => 'فرمت فایل معتبر نمی باشد'
                ]);
                if($validate){
                    $data = [];
                    $data['product-title'] = htmlspecialchars($request->input('product-title'));
                    $data['product-balance'] = htmlspecialchars($request->input('product-balance'));
                    $data['product-price'] = htmlspecialchars($request->input('product-price'));
                    $data['product-company-price'] = htmlspecialchars($request->input('product-company-price'));
                    $data['product-category-id'] = htmlspecialchars($request->input('product-category-id'));
                    $data['product-status-id'] = htmlspecialchars($request->input('product-status-id'));
                    $data['product-brand-id'] = htmlspecialchars($request->input('product-brand-id'));
                    $data['product-tag-id'] = htmlspecialchars($request->input('product-tag-id'));
                    $data['product-description'] = htmlspecialchars($request->input('description'));
                    if($request->hasFile('main-image')){
                        $image = $request->file('main-image');
                        $imageName = 'images/' . time() . '.' . request()->file('main-image')->getClientOriginalExtension();

                        $image->move(public_path('images'), $imageName);
                        $data['image'] = url($imageName);
                    }
                    if($this->productRepository->addProduct($data)){
                        return redirect()->back()->with(['success' => 'با موفقیت اضافه شد']);
                    }else{
                        return redirect()->back()->withErrors('مشکلی در ثبت رخ داده است');
                    }
                }
                break;
        }
    }
    public function editProduct(Request $request , $id){
        if($request->isMethod('GET')){
            $categories = $this->productRepository->getAllCategories();
            $productStatuses = $this->productRepository->allProductStatuses();
            $brands = $this->productRepository->getAllBrand();
            $tags = $this->productRepository->getAllTags();
            $product = $this->productRepository->getProductById(htmlspecialchars($id));
            return view('panel/product/edit' , compact('categories' , 'productStatuses' , 'brands' , 'tags' , 'product'));
        }
    }
    public function editProductSingle(Request $request){
        $validate = $request->validate([
            'product-id' => 'required',
            'product-title' => 'required',
            'product-balance' => 'required',
            'product-price' => 'required',
            'product-company-price' => 'required',
            'product-category-id' => 'required',
            'product-status-id' => 'required',
            'product-brand-id' => 'required',
            'off' => 'required',
            'main-image' => 'image | mimes:jpg,jpeg,png,webp'
        ],[
            'product-id.required' => 'ایدی محصول نمیتواند خالی باشد',
            'product-title.required' => 'عنوان محصول الزامی می باشد',
            'product-balance.required' => 'موجودی الزامی می باشد',
            'product-price.required' => 'قیمت الزامی می باشد',
            'product-company-price' => 'قیمت فاکتور غیر رسمی الزامی می باشد',
            'product-category-id.required' => 'دسته بندی الزامی می باشد',
            'product-status-id.required' => 'وضعیت نمی تواند خالی باشد',
            'product-brand-id.required' => 'برند نمیتواند خالی باشد',
            'off.required' => 'تخفیف نمیتواند خالی باشد',
            'main-image.image' => 'فایل عکس معتبر نمی باشد',
            'main-image.mimes' => 'فرمت فایل معتبر نمی باشد'
        ]);
        if($validate){
            $data = [];
            $product_id = htmlspecialchars($request->input('product-id'));
            $data['product-id'] = htmlspecialchars($request->input('product-id'));
            $data['product-title'] = htmlspecialchars($request->input('product-title'));
            $data['product-balance'] = htmlspecialchars($request->input('product-balance'));
            $data['product-price'] = htmlspecialchars($request->input('product-price'));
            $data['product-company-price'] = htmlspecialchars($request->input('product-company-price'));
            $data['product-category-id'] = htmlspecialchars($request->input('product-category-id'));
            $data['product-status-id'] = htmlspecialchars($request->input('product-status-id'));
            $data['product-brand-id'] = htmlspecialchars($request->input('product-brand-id'));
            $data['product-tag-id'] = htmlspecialchars($request->input('product-tag-id'));
            $data['product-description'] = htmlspecialchars($request->input('description'));
            $data['off'] = htmlspecialchars($request->input('off'));
            if($request->hasFile('main-image')){
                $image = $request->file('main-image');
                $imageName = 'images/' . time() . '.' . request()->file('main-image')->getClientOriginalExtension();

                $image->move(public_path('images'), $imageName);
                $data['image'] = url($imageName);
            }
            if($this->productRepository->editProductById($product_id , $data)){
                return redirect()->back()->with(['success' => 'با موفقیت ویرایش شد']);
            }else{
                return redirect()->back()->withErrors('مشکلی در ثبت رخ داده است');
            }
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

    public function importerCategory(Request $request){
        $validate = $request->validate([
            'excel-file' => 'required|mimes:xls,xlsx,csv'
        ],[
            'excel-file.required' => 'لطفا فایل را وارد کنید',
            'excel-file.mimes' => 'لطفا فایل را با فرمت csv وارد کنید '
        ]);
        if($validate){
            $file = $request->file('excel-file');
            $row = 1;
            $customArray = [];
            if (($handle = fopen($file, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    array_push( $customArray , $data);

                }
                fclose($handle);
            }
            $customArray = array_reverse($customArray);
            for($i = 0 ; $i < count($customArray) ; $i++){
                    $categoryId = 0 ;
                    $exsitCat = $this->productRepository->getCategoryByPersianName($customArray[$i][1]);
                    if($exsitCat){
                       $categoryId = $exsitCat->product_category_id;
                    }else{
                        $d1 = [
                            'persian-category' => $customArray[$i][1],
                            'product-category-id' => 0
                        ];
                        $categoryId = $this->productRepository->addCategoryReturnCatId($d1);
                    }
                        for($j = 0 ; $j < count($customArray) ; $j++){
                            if($customArray[$i][0] == $customArray[$j][2]){
                                $d2 = [
                                    'persian-category' => $customArray[$j][1],
                                    'product-category-id' => $categoryId
                                ];
                                $this->productRepository->addCategoryReturnCatId($d2);
                            }
                        }
            }
            return redirect()->back()->with('success' , 'با موفقیت درون ریزی شد ');
        }
    }
    public function importProduct(Request $request){
        $validate = $request->validate([
            'excel-file' => 'required|mimes:xls,xlsx,csv'
        ],[
            'excel-file.required' => 'لطفا فایل را وارد کنید',
            'excel-file.mimes' => 'لطفا فایل را با فرمت csv وارد کنید '
        ]);
        if($validate){
            $file = $request->file('excel-file');
            $row = 1;
            $customArray = [];
        }
        if (($handle = fopen($file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $cat_arr = explode(">" , $data[4]);
                array_push( $customArray , [
                    'sku' => $data[0],
                    'name' => $data[1],
                    'description' => $data[2],
                    'price' => $data[3],
                    'category' => $cat_arr[count($cat_arr) - 1]
                ]);
                // echo '<br>';
            }
            fclose($handle);
        }
        for($i = 0 ; $i < count($customArray) ; $i++){
            $cat_id = $this->productRepository->getCategoryByPersianName($customArray[$i]['category']);
            isset($cat_id->product_category_id) ? $customArray[$i]['category'] = $cat_id->product_category_id : '';
            $data = [];
            $data['product-title'] = $customArray[$i]['name'];
            $data['product-balance'] = 100;
            $data['product-price'] = $customArray[$i]['price'];
            $data['product-category-id'] = $customArray[$i]['category'];
            $data['product-status-id'] = 1;
            $data['product-brand-id'] = 1;
            $data['product-description'] = $customArray[$i]['description'];
            $data['product-tag-id'] = '';
            $this->productRepository->addProduct($data);
            echo '<br>';
        }
        return redirect()->back()->with('success' , 'با موفقیت درون ریزی شد');
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
    public function users(Request $request){
        if($request->isMethod('GET')){
            $users = $this->userRepository->getAllUsersWithUserRoleName();
            $user_roles = $this->userRepository->getAllUserRoles();
            return view('panel.users' , compact('users' , 'user_roles'));
        }
    }
    public function addUser(Request $request){
        if($request->isMethod('POST')){
            $validate = $request->validate([
                    'phone' => 'required|max:11| regex:/[0]{1}[0-9]{10}/',
                    'first-name' => 'required',
                    'last-name' => 'required',
                    'user-role' => 'required',
                    'password' => 'required',
                    'username' => 'required| regex:/^[a-zA-Z]+$/'
            ],[
                'phone.required' => 'شماره موبایل الزامی می باشد',
                'phone.max' => 'تعداد ارقام شماره موبایل نامعتبر است',
                'phone.regex' => 'شماره موبایل نامعتبر',
                'first-name.required' => 'نام کاربر الزامی میباشد',
                'last-name.required' => 'نام خانوادگی کاربر نمیتواند خالی باشد',
                'user-role.required' => 'نقش کاربر الزامی است',
                'password.required' => 'رمز کاربری الزامی است',
                'username.required' => 'نام کاربری الزامی است',
                'username.regex' => 'نام کاربری میتواند شامل حروف انگلیسی باشد'
            ]);
            if($validate){
                $phone = htmlspecialchars($request->input('phone'));
                $firstName = htmlspecialchars($request->input('first-name'));
                $lastName = htmlspecialchars($request->input('last-name'));
                $user_role = htmlspecialchars($request->input('user-role'));
                $password = htmlspecialchars($request->input('password'));
                $userName = htmlspecialchars($request->input('username'));
                $data = [];
                $data['user-name'] = $userName;
                $data['phone'] = $phone;
                $data['first-name'] = $firstName;
                $data['last-name'] = $lastName;
                $data['password'] = $password;
                $data['user-role'] = $user_role;
                if($this->userRepository->createUser($data)){
                    return redirect()->back()->with(['success' => 'با موفقیت ثبت شد']);
                }else{
                    return redirect()->back()->withErrors('خطایی در ثبت کاربر رخ داده است');
                }
            }
        }
    }
    public function deleteUser(Request $request){
        if($request->isMethod('POST')){
            $validate = $request->validate([
                'user-data-id' => 'required'
            ],[
                'user-data-id.required' => 'ایدی کاربر نمیتواند خالی باشد'
            ]);
            if($validate){
                $user_id = htmlspecialchars($request->input('user-data-id'));
                if($user_id == Auth::user()->user_id){
                    return redirect()->back()->withErrors('نمیتوانید کاربر وارد شده را پاک کنید');
                }else{
                    if($this->userRepository->deleteUserByUserId($user_id)){
                        return redirect()->back()->with(['success' => 'با موفقیت حذف شد']);
                    }else{
                        return redirect()->back()->withErrors('حذف کاربر با مشکل مواجه شده است');
                    }
                }
            }
        }
    }
    public function getSingleUser(Request $request){
        if($request->isMethod('GET')){
            $validate = $request->validate([
                'id' => 'required'
            ],[
                'id.required' => 'یدی کاربر نمیتواند خالی باشد '
            ]);
            if($validate){
                $user_id = htmlspecialchars($request->input('id'));
                $user = $this->userRepository->getUserDataByUserId($user_id);
                if($user){
                    return $user;
                }
            }
        }
    }
    public function editUser(Request $request){
        if($request->isMethod('POST')){
            $validate = $request->validate([
                    'user-data-id' => 'required',
                    'phone' => 'required|max:11| regex:/[0]{1}[0-9]{10}/',
                    'first-name' => 'required',
                    'last-name' => 'required',
                    'user-role' => 'required',
                    'username' => 'required| regex:/^[a-zA-Z]+$/'
            ],[
                'user-data-id.required' => 'ایدی کاربر نمیتواند خالی باشد',
                'phone.required' => 'شماره موبایل الزامی می باشد',
                'phone.max' => 'تعداد ارقام شماره موبایل نامعتبر است',
                'phone.regex' => 'شماره موبایل نامعتبر',
                'first-name.required' => 'نام کاربر الزامی میباشد',
                'last-name.required' => 'نام خانوادگی کاربر نمیتواند خالی باشد',
                'user-role.required' => 'نقش کاربر الزامی است',
                'username.required' => 'نام کاربری الزامی است',
                'username.regex' => 'نام کاربری میتواند شامل حروف انگلیسی باشد'
            ]);
            if($validate){
                $userId = htmlspecialchars($request->input('user-data-id'));
                $phone = htmlspecialchars($request->input('phone'));
                $firstName = htmlspecialchars($request->input('first-name'));
                $lastName = htmlspecialchars($request->input('last-name'));
                $user_role = htmlspecialchars($request->input('user-role'));
                $password = htmlspecialchars($request->input('password'));
                $userName = htmlspecialchars($request->input('username'));
                $data = [];
                $data['user-name'] = $userName;
                $data['phone'] = $phone;
                $data['first-name'] = $firstName;
                $data['last-name'] = $lastName;
                $password != '' ? $data['password'] = $password : '';
                $data['user-role'] = $user_role;
            }
            if($this->userRepository->editUserByUserId($userId , $data)){
                return redirect()->back()->with(['success' => 'با موفقیت ویرایش شد']);
            }else{
                return redirect()->back()->withErrors('مشکلی رخ داده است');
            }
        }
    }
    public function editProductPrice(Request $request){
        if($request->isMethod('GET')){
            $products = $this->productRepository->allProductsFrontEndData();
            return view('panel/product/priceEdit' , compact('products'));
        }else if($request->isMethod('POST')){
            $validate = $request->validate([
                'id' => 'required',
                'price' => 'required'
            ],[
                'id.required' => 'ایدی الزامی میباشد',
                'price.required' => 'قیمت الزامی میباشدد'
            ]);
            if($validate){
                $id = htmlspecialchars($request->input('id'));
                $price = htmlspecialchars($request->input('price'));
                $final = $this->productRepository->updateProductPriceByProductId($id , $price);
                if($final){
                    return $final;
                }else{
                    return false;
                }
            }
        }
    }
    public function editBrandPrice(Request $request){
        if($request->isMethod('GET')){
            $products = $this->productRepository->allProductsFrontEndData();
            $brands = $this->productRepository->getAllBrand();
            return view('panel/product/brandEdit' , compact('products' , 'brands'));
        }else if($request->isMethod('POST')){
            $validate = $request->validate([
                'id' => 'required' ,
                'brand-id' => 'required'
            ],[
                'id.required' => 'ایدی محصول نمیتواند خالی باشد',
                'brand-id.required' => 'لطفا یک برند را انتخاب کنید'
            ]);
            if($validate){
                $id = htmlspecialchars($request->input('id'));
                $brand = htmlspecialchars($request->input('brand-id'));
                $final = $this->productRepository->updateProductBrandByProductId($id , $brand);
                if($final){
                    return $final;
                }else{
                    return false;
                }
            }
        }
    }
}
