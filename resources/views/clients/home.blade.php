@extends('layouts.client')
@section('title')
    {{$title}}
@endsection

@section('sidebar')
    @parent
    <h3>Home sidebar</h3>
@endsection

@section('content')
    <h1>Trang chủ</h1>
    @include('clients.contents.slide')
    @include('clients.contents.about')

    {{-- @env('production')
        <p>Đây là môi trường production</p>
    @elseenv('test')
        <p>Môi trường test</p>
    @else
        <p>Không phải môi trường DEV</p>
    @endenv --}}

    <x-alert type="info" content="{{$message}}" data-icon="youtube"/>

    {{-- <x-inputs.button />

    <x-forms.button /> --}}

    <p><img src="https://bloganh.net/wp-content/uploads/2021/03/chup-anh-dep-anh-sang-min.jpg" alt="" class="src"></p>
    <p><a href="{{route('download-image').'?image='.public_path('storage/image_625566247dd51.jpg')}}" class="btn btn-primary">Download ảnh</a></p>
    
    <p><a href="{{route('download-doc').'?file='.public_path('storage/Info_ez_system.xlsx')}}" class="btn btn-primary">Download tài liệu</a></p>
@endsection

@section('css')
<style>
    img{
        max-width: 100%;
    }
</style>
@endsection