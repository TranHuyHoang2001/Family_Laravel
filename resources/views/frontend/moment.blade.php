@extends('frontend.layout.master')

@section('title', 'Trang chủ')

@section('content')
    <div id="main-content-wp" class="clearfix blog-page">
        <div class="wp-inner">
            <div class="secion" id="breadcrumb-wp">
                <div class="secion-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="" title="">Khoảnh khắc</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-content fl-right">
                <div class="section" id="list-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">KHOẢNH KHẮC</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            @forelse($moment as $value)
                                <li>
                                    <a href="javascript:void(0)" title="" class="thumb">
                                        <img src="{{asset($value->image->count() > 0 ? $value->image->first()->image : '')}}"
                                             onerror="this.onerror=null;this.src='http://via.placeholder.com/260x200'">
                                    </a>
                                    <div class="info">
                                        <div class="author">
                                            <p class="poster">{{ isset($value->user) ?  $value->user->first_name : ''}}</p>
                                            <p class="created_at">{{ date_format($value->created_at, 'd/m/Y') }}</p>
                                        </div>
                                        <div class="section" id="social-wp">
                                            <div class="section-detail">
                                                <div class="fb-like" data-href="" data-layout="button_count"
                                                     data-action="like" data-size="small" data-show-faces="true"
                                                     data-share="true"></div>
                                                <div class="g-plusone-wp">
                                                    <div class="g-plusone" data-size="medium"></div>
                                                </div>
                                                <div class="fb-comments" id="fb-comment" data-href=""
                                                     data-numposts="5"></div>
                                            </div>
                                        </div>
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
                <div class="section" id="banner-wp">
                    <div class="section-detail">
                        <a href="?page=detail_product" title="" class="thumb">
                            <img src="{{ asset('images/banner-4.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
