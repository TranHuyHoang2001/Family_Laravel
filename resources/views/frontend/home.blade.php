@extends('frontend.layout.master')

@section('title', 'Trang chủ')

@section('content')
    <div id="main-content-wp" class="home-page clearfix">
        <div class="wp-inner">
            <div class="main-content fl-right">
                <div class="section" id="slider-wp">
                    <div class="section-detail">
                        <div class="item">
                            <img src="{{asset('frontend/images/1.jpg')}}" alt="">
                        </div>
                        <div class="item">
                            <img src="{{asset('frontend/images/2.jpg')}}" alt="">
                        </div>
                        <div class="item">
                            <img src="{{asset('frontend/images/3.jpg')}}" alt="">
                        </div>
                    </div>
                </div>


                <div class="section" id="feature-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Hình ảnh công việc</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            @if($family && $family->job->count()>0)
                                @php
                                    $jobs = $family->job()->orderBy('id', 'desc')->limit(4)->get();
                                @endphp
                            @forelse($jobs as $job)
                                <li>
                                <a href="" title="" class="thumb">
                                    <img src="{{asset($job->job->image)}}">
                                </a>
                                <a href="" title="" class="product-name">{{$job->job->name}}</a>


                            </li>
                            @empty
                            @endforelse
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="section" id="list-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Kinh nghiệm</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            @forelse($experiences as $experience)
                                <li>
                                    <a href="{{ route('detail.experience',$experience->id) }}" title="" class="thumb">
                                        <img src="{{asset($experience->image)}}">
                                    </a>
                                    <a href="{{ route('detail.experience',$experience->id) }}" title="" class="product-name">{{$experience->name}}</a>
                                   

                                </li>
                            @empty
                            @endforelse

                        </ul>
                    </div>
                </div>
                <div class="section" id="list-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Sản phẩm bán chạy</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            @forelse($products as $product)
                                <li>
                                <a href="?page=detail_product" title="" class="thumb">
                                    <img src="{{asset($product->image)}}">
                                </a>
                                <a href="?page=detail_product" title="" class="product-name">{{$product->name}}</a>
                                <div class="price">
                                    <span class="new">{{number_format($product->price)}}đ</span>
                                </div>
                                <div class="action">
                                    <a href="{{ route('cart.add',$product->id)}}" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                  
                                </div>

                            </li>
                            @empty
                            @endforelse

                        </ul>
                    </div>
                </div>
            </div>
            <div class="sidebar fl-left">
                <div class="section" id="category-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Công việc làm nhiều nhất</h3>
                    </div>
                    <div class="secion-detail">
                        <ul class="list-item">
                            @if($family && isset($family->job))
                                @php
                                    $jobs = $family->job()->orderBy('id', 'desc')->limit(4)->get();
                                @endphp
                                @forelse($jobs as $job)
                                    <li>
                                        <a href="?page=category_product" title="">{{$job->job->name}}</a>
                                    </li>
                                @empty
                                @endforelse
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="section" id="category-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Thành viên điểm cao nhất</h3>
                    </div>
                    <div class="secion-detail">
                        <ul class="list-item">
                                @forelse($members as $member)
                                    <li>
                                        <a href="" title="">{{$member->first_name}}</a>
                                    </li>
                                @empty
                                @endforelse
                          </ul>
                    </div>
                </div>

                <div class="section" id="banner-wp">
                    <div class="section-detail">
                        <a href="" title="" class="thumb">
                            <img src="{{asset('images/banner-4.jpg')}}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
