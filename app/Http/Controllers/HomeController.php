<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ProductRequest;

use Illuminate\Support\Facades\Validator;

use App\Rules\UpperCase;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public $data = [];

    public function index(){
        $this->data['title'] = 'Trang chủ';
        $this->data['message'] = 'Đăng ký tài khoản thành công';

        // $users = DB::select('select * from users');

        // dd($users);

        // return 'Unicode';
        return view('clients.home', $this->data);
    }

    public function products(){
        $this->data['title'] = 'Sản phẩm';
        return view('clients.products', $this->data);
    }

    public function getAdd(){
        $this->data['title'] = 'Thêm sản phẩm';
        return view('clients.add', $this->data);
    }

    public function postAdd(Request $request){
        $rules = [
            'product_name' => ['required', 'min:6'],
            'product_price' => ['required', 'integer'],
        ];

        $messages = [
            'required' => ':attribute bắt buộc phải nhập',
            'min' => ':attribute không được nhỏ hơn :min ký tự',
            'integer' => ':attribute phải là một số',
        ];

        $attributes = [
            'product_name' => 'Tên sản phẩm',
            'product_price' => 'Giá sản phẩm',
        ];

        // $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        // $validator->validate();

        $request->validate($rules, $messages);

        return response()->json(['status'=>'success']);

        // $rules = [
        //     'product_name' => ['required', 'min:6', function($attribute, $value, $fail){
        //         isUpperCase($value, 'Trường :attribute không hợp lệ', $fail);
        //     }],
        //     'product_price' => 'required|integer',
        // ];

        // $messages = [
        //     'required' => ':attribute bắt buộc phải nhập',
        //     'min' => ':attribute không được nhỏ hơn :min ký tự',
        //     'integer' => ':attribute phải là một số',
        // ];

        // $attributes = [
        //     'product_name' => 'Tên sản phẩm',
        //     'product_price' => 'Giá sản phẩm',
        // ];

        // $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        // if ($validator->fails()) {
        //     $validator->errors()->add('msg', 'Vui lòng kiểm tra lại dữ liệu');
        //     // return 'Validate false';
        // }else{
        //     // return 'Validate thành công';
        //     return redirect()->route('products')->with('msg', 'Validate thành công!');
        // }

        // return back()->withErrors($validator);

        // dd($request->all());
        // $request->validate([
        //     'product_name' => 'required|min:6',
        //     'product_price' => 'required|integer',
        // ],[
        //     'product_name.required' => 'Tên sản phẩm là bắt buộc',
        //     'product_name.min' => 'Tên sản phẩm không được nhỏ hơn :min ký tự',
        //     'product_price.required' => 'Giá sản phẩm bắt buộc phải nhập',
        //     'product_price.integer' => 'Giá sản phẩm phải là một số',
        // ]);

        // $rules = [
        //     'product_name' => 'required|min:6',
        //     'product_price' => 'required|integer',
        // ];

        // $messages = [
        //     'required' => 'Trường :attribute bắt buộc phải nhập',
        //     'min' => 'Trường :attribute không được nhỏ hơn :min ký tự',
        //     'integer' => 'Trường :attribute phải là một số',
        // ];

        // $request->validate($rules, $messages);
    }

    public function putAdd(Request $request){
        dd($request);
    }

    public function getArr(){
        $contentArr = [
            'name' => 'Laravel 8.x',
            'lesson' => 'Khóa học lập trình Laravel',
            'academy' => 'Unnicode Academy',
        ];

        return $contentArr;
    }

    public function downloadImage(Request $request){
        if(!empty($request->image)){
            $image = trim($request->image);

            $fileName = 'image_'.uniqid().'.jpg';

            // Stream download
            // return response()->streamDownload(function () use ($image) {
            //     $imageContent = file_get_contents($image);
            //     echo $imageContent;
            // }, $fileName);

            // Download file từ hệ thống
            return response()->download($image, $fileName);
        }
    }
    
    public function downloadDoc(Request $request){
        if(!empty($request->file)){
            $file = trim($request->file);

            $fileName = 'tai-lieu'.uniqid().'.xlxs';

            $headers = [
                'Content-Type' => 'application/vnd.ms-excel',
            ];

            // Download file từ hệ thống
            return response()->download($file, $fileName, $headers);
        }
    }
}
