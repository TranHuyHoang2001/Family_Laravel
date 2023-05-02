@extends('frontend.layout.master')

@section('title', 'Trang chủ')

@section('content')
    <div id="main-content-wp" class="clearfix category-product-page">
        <div class="wp-inner">
            <div class="secion" id="breadcrumb-wp">
                <div class="secion-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="" title="">Sản Phẩm</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-content fl-right">
                <div class="section" id="list-product-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title fl-left">Sản Phẩm</h3>

                    </div>
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            @forelse($product as $value)
                                <li>
                                <a href="?page=detail_product" title="" class="thumb">
                                    <img src="{{asset($value->image)}}">
                                </a>
                                <a href="?page=detail_product" title="" class="product-name">{{$value->name}}</a>
                                <div class="price">
                                    <span class="new">{{number_format($value->price)}}đ</span>

                                </div>
                                <div class="action">
                                    <a href="{{ route('cart.add',$value->id)}}" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                  
                                </div>
                            </li>
                            @empty
                            @endforelse
                        </ul>
                    </div>
                </div>

            </div>
            <div class="sidebar fl-left">
               
                <div class="section" id="filter-product-wp">
                    <div class="section" id="category-product-wp">
                        <div class="section-head">
                            <h3 class="section-title">Thành viên điểm cao nhất</h3>
                        </div>
                        <div class="secion-detail">
                            <ul class="list-item">

                                    @forelse($members as $member)
                                        <li>
                                            <a href="?page=category_product" title="">{{$member->first_name}}</a>

                                        </li>
                                    @empty
                                    @endforelse

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="section" id="banner-wp">
                    <div class="section-detail">
                        <a href="?page=detail_product" title="" class="thumb">
                            <img src="{{ asset('images/banner-3.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
