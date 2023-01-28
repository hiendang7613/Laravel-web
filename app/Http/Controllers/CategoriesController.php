<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //
    public function __construct(){

    }

    // Hiển thị danh sách chuyên mục (GET)
    public function index(){
        return view('clients/categories/list');
    }

    // Lấy ra một chuyên mục theo id (GET)
    public function getCategory($id){
        return view('clients/categories/edit');
    }

    // Sửa một chuyên mục (POST)
    public function updateCategory($id){
        return 'Submit sửa chuyên mục '.$id;
    }

    // Show form thêm dữ liệu (GET)
    public function addCategory(Request $request){
        $cateName = $request->old('category_name', 'Mặc định');

        return view('clients/categories/add', compact('cateName'));
    }

    // Thêm dữ liệu vào chuyên mục (POST)
    public function handleAddCategory(Request $request){
        if($request->has('category_name')){
            $cateName = $request->category_name;
            $request->flash();

            return redirect(route('categories.add'));
        }else{
            return 'Không có category_name';
        }
    }

    // Xóa dữ liệu (Delete)
    public function deleteCategory($id){
        return 'Xóa chuyên mục';
    }

    // Xử lý lấy thông tin file
    public function getFile(){
        return view('clients/categories/file');
    }

    // Xử lý lấy thông tin file
    public function handleFile(Request $request){
        if($request->hasFile('photo')){
            if($request->photo->isValid()){
                $file = $request->photo;
                // $path = $file->path();
                $ext = $file->extension();
                // $path = $file->store('file-txt', 'local');
                // $path = $file->storeAs('file-txt', 'khoa-hoc.txt');
                // Đổi tên
                $fileName = md5(uniqid()).'.'.$ext;
                dd($fileName);
            }else{
                return 'Upload không thành công';
            }
        }else{
            return 'Vui lòng chọn file';
        }
    }
}
