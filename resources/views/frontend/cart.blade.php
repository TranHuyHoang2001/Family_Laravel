@extends('frontend.layout.master')

@section('title', 'Trang chủ')

@section('content')
    <div id="main-content-wp" class="cart-page">
        <div class="section" id="breadcrumb-wp">
            <div class="wp-inner">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="?page=home" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="" title="">Giỏ hàng</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="wrapper" class="wp-inner clearfix">
            <div class="section" id="info-cart-wp">
                <div class="section-detail table-responsive">
                    <p>Hiện tại có {{ Cart::count() }} sản phẩm trong giỏ hàng</p>
                    <form action="{{ route('cart.update') }}" method="POST">
                        @csrf
                    @if (Cart::count()>0)
                      <table class="table">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td>Ảnh sản phẩm</td>  
                            <td>Tên sản phẩm</td>                          
                            <td>Giá sản phẩm</td>
                            <td>Số lượng</td>
                            <td colspan="2">Thành tiền</td>
                            <td>Tác vụ</td>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $t=0;
                            @endphp
                            @foreach (Cart::Content() as $row)
                            @php
                                $t++;
                            @endphp
                        <tr>
                            <td>{{ $t }}</td>
                              
                                <td>
                                    <a href="" title="" class="thumb">
                                        <img src="{{ asset($row->options->image) }}" alt="">
                                    </a>
                                </td>
                                 <td>
                                    <a href="" title="" class="name-product">{{ $row->name }}</a>
                                </td>
                                <td>{{ number_format($row->price,0,',','.') }} VNĐ</td>
                                <td>
                                    <input type="number" min="1" name="qty[{{ $row->rowId }}]" value="{{ $row->qty }}" class="num-order">
                                </td>
                                <td>{{ number_format($row->total,0,',','.') }} VNĐ</td>
                                <td>
                                    <a href="" title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                                </td>
                                <td><a href="{{ route('cart.remove',$row->rowId) }}" class="text-danger">Xóa</a></td>
                        </tr>  
                            @endforeach
                      
                       
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <p id="total-price" class="fl-right">Tổng giá: <span>{{ Cart::total() }}</span></p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <div class="fl-right">
                                        <input type="submit" name="btn-update" class="btn btn-primary" value="Cập nhật giỏ hàng">

                                        
                                        <a href="{{route('order')}}" title="" id="checkout-cart">Thanh toán</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="section" id="action-cart-wp">
                <div class="section-detail">
                    <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.</p>
                    <a href="?page=home" title="" id="buy-more">Mua tiếp</a><br/>
                    <a href="{{ route('cart.destroy') }}" title="" id="delete-cart">Xóa giỏ hàng</a>
                </div>
            </div>  
                    @endif
                </form>
                    
        </div>
    </div>
@stop
