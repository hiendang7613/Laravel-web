@extends('layouts.client')
@section('title')
    {{$title}}
@endsection

@section('content')
    @if (session('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>
    @endif

    <h1>{{$title}}</h1>
    <a href="{{route('users.add')}}" class="btn btn-primary">Thêm người dùng</a><hr>

    <form action="" method="get" class="mb-3">
        <div class="row">
            <div class="col-4">
                <input type="search" name="keyword" class="form-control" placeholder="Từ khóa tìm kiếm..." value="{{request()->keyword}}">
            </div>

            <div class="col-3">
                <select name="group_id" id="" class="form-control">
                    <option value="0">Tất cả nhóm</option>
                    @if (!empty(getAllGroups()))
                        @foreach (getAllGroups() as $item)
                            <option value="{{$item->id}}" {{request()->group_id==$item->id?'selected':false}}>{{$item->name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="col-3">
                <select name="status" id="" class="form-control">
                    <option value="0">Tất cả trạng thái</option>
                    <option value="active" {{request()->status=='active'?'selected':false}}>Kích hoạt</option>
                    <option value="inactive" {{request()->status=='inactive'?'selected':false}}>Chưa kích hoạt</option>
                </select>
            </div>

            <div class="col-2">
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </div>
        </div>
    </form>

    <table class="table table-borderd">
        <thead>
            <th width="50">STT</th>
            <th><a href="?sort-by=fullname&sort-type={{$sortType}}">Tên</a></th>
            <th>Nhóm</th>
            <th><a href="?sort-by=email&sort-type={{$sortType}}">Email</a></th>
            <th><a href="?sort-by=create_at&sort-type={{$sortType}}">Thời gian</a></th>
            <th>Trạng thái</th>
            <th with="10%">Sửa</th>
            <th with="10%">Xóa</th>
        </thead>
        <tbody>
            @if(!@empty($usersList))
                @foreach ($usersList as $key => $item)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$item->fullname}}</td>
                        <td>{{$item->group_name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->create_at}}</td>
                        <td>{!!$item->status==0?'<button class="btn btn-danger btn-sm">Chưa kích hoạt</button>':'<button class="btn btn-success btn-sm">Kích hoạt</button>'!!}</td>
                        <td><a href="{{route('users.edit', ['id'=>$item->id])}}" class="btn btn-warning btn-sm">Sửa</a></td>
                        <td><a href="{{route('users.delete', ['id'=>$item->id])}}" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa!')">Xóa</a></td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4">Không có người dùng</td>
                </tr>
            @endempty
        </tbody>
    </table>

    <div class="d-flex justify-content-end">{{$usersList->links()}}</div>
@endsection
{{-- 
<td><a href="#" class="btn btn-danger btn-edit" onclick="editItem('12345')">Sửa 2</a></td>
<script>
    function editItem(id){
        console.log(111);
    }
</script> --}}