@extends('frontend.layout.master')

@section('title', 'Trang chủ')

@section('content')
    <div id="main-content-wp" class="clearfix detail-blog-page">
        <div class="wp-inner">
            <div class="secion" id="breadcrumb-wp">
                <div class="secion-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="" title="">Blog</a>
                        </li>
                    </ul>
                </div>
            </div>
            @if($introduce)
            <div class="main-content fl-right">
                <div class="section" id="detail-blog-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title">{{$introduce->description}}</h3>
                    </div>
                    <div class="section-detail">
                        <span class="create-date">{{$introduce->created_at}}</span>

                        <div class="detail">


                            <img src="{{asset($introduce->image)}}" alt="">
                            <p>{!! $introduce->detail !!}</p>

                        </div>
                    </div>
                </div>
                <div class="section" id="social-wp">
                    <div class="section-detail">
                        <div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                        <div class="g-plusone-wp">
                            <div class="g-plusone" data-size="medium"></div>
                        </div>
                        <div class="fb-comments" id="fb-comment" data-href="" data-numposts="5"></div>
                    </div>
                </div>
            </div>
            @endif
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
                            <img src="{{ asset('images/banner-3.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
