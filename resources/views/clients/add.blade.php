@extends('layouts.client')
@section('title')
    {{$title}}
@endsection

@section('content')
    <h1>Thêm sản phẩm</h1>
    <form action="{{route('post-add')}}" method="post" id="product-form">
        @error('msg')
            <div class="alert alert-danger text-center">{{$message}}</div>
        @enderror

        <div class="mb-3">
            <label for="">Tên sản phẩm</label>
            <input type="text" class="form-control" name="product_name" placeholder="Tên sản phẩm" value="{{old('product_name')}}">
            {{-- @error('product_name')
            <span style="color: red" class="product_name_error"></span>
            @enderror --}}

            <span style="color: red" class="error product_name_error"></span>
        </div>

        <div class="mb-3">
            <label for="">Giá</label>
            <input type="text" class="form-control" name="product_price" placeholder="Giá sản phẩm" value="{{old('product_price')}}">
            {{-- @error('product_price')
            <span style="color: red" class="product_price_error"></span>
            @enderror --}}
            
            <span style="color: red" class="error product_price_error"></span>
        </div>

        @csrf
        
        <button type="submit" class="btn btn-primary">Thêm mới</button>
    </form>
@endsection

@section('css')
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $('#product-form').on('submit', function(e){
                e.preventDefault();
                
                let productName = $('input[name="product_name"]').val().trim();

                let productPrice = $('input[name="product_price"]').val().trim();

                let actionUrl = $(this).attr('action');

                let csrfToken = $(this).find('input[name="_token"]').val();

                $('.error').text('');

                $.ajax({
                    url: actionUrl,
                    type: 'POST',
                    data: {
                        product_name: productName,
                        product_price: productPrice,
                        _token: csrfToken,
                    },
                    dataType: 'json',
                    success: function(response){
                        console.log(response);
                    },
                    error: function(error){
                        let responseJSON = error.responseJSON.errors;

                        if(Object.keys(responseJSON).length>0){
                            for(let key in responseJSON){
                                $('.'+key+'_error').text(responseJSON[key]);
                            }
                        }
                        
                    }
                })
            })
        })
    </script>
@endsection