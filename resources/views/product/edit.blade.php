@extends('layouts.master')
@section('title') BikeShop | รายการสินค้า
@endsection
@section('content')

<div class="container" style="margin-left:200px; padding:20px;">
    
    <div class="panel panel-primary">
        <div class="panel-heading">
            <strong> <h1 align="center">แก้ไขสินค้า</h1></strong>
        </div>
    </div>
    <div class="panel-body">
        <ul class="breadcrumb">
            <li><a href="{{ URL::to('product') }}">หน้าแรก</a></li>
            <li class="active"> แก้ไขสินค้า</li>
        </ul><br>
        @if($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach
        </div>
        @endif
        {!!Form::model($product,array('action'=> 'ProductController@update','method' => 'post' , 'enctype' => 'multipart/form-data')) !!}
        <input type="hidden" name="id" value={{$product->id}}>
        
        <table >
            @if($product->image_url)
                <tr>
                    <td><strong> รูปสินค้า </strong></td>
                    <td><img src="{{ URL::to($product->image_url) }}" width="100px" ></td>
                </tr>
            @endif
            <tr>
                <td> {{Form::label('รหัสสินค้า')}}       </td>
                <td> {{Form::text('code',Input::old('code'),['class' => 'form-control'])}}</td>
            </tr>
            <tr>
                <td> {{Form::label('','ชื่อสินค้า')}}       </td>
                <td> {{Form::text('name',Input::old('name'),['class' => 'form-control'])}}</td>
            </tr>
            <tr>
                    <td> {{Form::label('','ประเภทสินค้า')}}       </td>
                    <td> {{Form::select('category_id',$categories,Input::old('category_id'),['class' => 'form-control'])}}</td>
                </tr>
            <tr>
                <td> {{ Form::label('stock_qty','คงเหลือ') }} </td>
                <td> {{Form::text('stock_qty',Input::old('stock_qty'),['class' => 'form-control'])}}</td>
            </tr>
            <tr>
                <td> {{ Form::label('price','ราคาต่อหน่วย') }} </td>
                <td> {{Form::text('price',Input::old('price'),['class' => 'form-control'])}}</td>
            </tr>
            <tr>
                <td> {{ Form::label('image','เลือกรูปภาพสินค้า') }} </td>
                <td> {{ Form::file('image') }}</td>
            </tr>
        </table>
        
    </div>
    <div class="panel-footer">
            <button type="reset" class="btn btn-danger"> ยกเลิก </button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก </button>
    </div>
</div>
@endsection