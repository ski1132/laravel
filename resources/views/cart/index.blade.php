@extends('layouts.master')
@section('title') BikeShop | รายการสินค้า
@endsection
@section('content')
<div class="container">
    <h1> สินค้าในตะกร้า </h1>
    <div class="breadcrumb">
        <li><a href="{{ URL::to('home') }}"><i class="fa fa-home"></i> หน้าร้าน </a></li>
        <li class="active"> สินค้าในตะกร้า </li>
    </div>
    <div class="panel panel-default">
        @if(count($cart_items))
            <?php $sum_price = 0 ?>
            <?php $sum_qty = 0 ?>
            <?php $sum_total = 0 ?>
            <table class="table bs-table">
                <thead>
                    <tr>
                        <th> รูปสินค้า </th>
                        <th> รหัสสินค้า </th>
                        <th> ชื่อสินค้า </th>
                        <th> จำนวน </th>
                        <th> ราคาต่อชิ้น </th>
                        <th> ราคารวม </th>
                        <th width="50px"> </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart_items as $c)
                        <tr>
                            <td> <img src="{{ asset($c['image_url']) }}" height="36" ></td>
                            <td> {{ $c['code'] }} </td>
                            <td> {{ $c['name'] }} </td>
                            <td> <input type="text" class="form-control" value="{{ $c['qty'] }}" 
                                onkeyUp="updateCart({{$c['id']}},this)" > </td>
                            <script>
                                function updateCart(id,qty)
                                {
                                    window.location.href = '/cart/update/' + id + '/' + qty.value;
                                }
                            </script>
                            <td> {{ number_format($c['price'],2) }} </td>
                            <td> {{ number_format($c['price']*$c['qty'],2) }} </td>
                            <td> 
                                <a href= "{{ URL::to('cart/delete/'.$c['id']) }}" class="btn btn-danger"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        <?php $sum_price += $c['price'] ?>
                        <?php $sum_qty += $c['qty'] ?>
                        <?php $sum_total += $c['price']*$c['qty'] ?>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">รวม</th>
                        <th>{{ number_format($sum_qty,2) }}</th>
                        <th>  </th>
                        <th> {{number_format($sum_total,2)}} </th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        @else
            <div class="panel-body"><strong> ไม่พบรายการสินค้า! </strong></div>
        @endif
    </div>
    <!-- button -->
    <a href="{{ URL::to('/home') }}" class="btn btn-default">ย้อนกลับ</a>
    <div class="pull-right">
        <a href="{{ URL::to('cart/checkout') }}" class="btn btn-primary">
        ชำระเงิน <i class="fa fa-chevron-right"></i></a>
    </div>
</div>
@endsection