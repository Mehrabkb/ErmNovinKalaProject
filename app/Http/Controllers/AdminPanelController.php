<?php

namespace App\Http\Controllers;

use App\Repositories\alertifyRepository;
use App\Repositories\productRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
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
                return view('panel/product/add');
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
                $categories = $this->productRepository->getAllCategories();
                return view('panel/product/category' , compact('categories'));
                break;
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
