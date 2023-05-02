@extends('frontend.layout.master')

@section('title', 'Trang chủ')

@section('content')<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Kinh nghiệm</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div id="detail_exprience">
                <div class="section" id="list-product-wp">
                  
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            <li> 
                                <a href="" title="" class="Experience-name">{{$Experience->name}}</a>
                                <a title="" class="thumb">
                                    <img src="{{asset($Experience->image)}}">
                                </a>
                               
                               
                                <div class="detail-experience">
                                        <span>{!! preg_replace('/<br\\s*?\/??>/i', '', $Experience->content) !!}</span>
                                    </div>
                            </li>
                           
                          

                        </ul>
                    </div>
                </div>
            </div>
                
        
    </div>
    <div class="sidebar fl-left">
            <div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Kinh nghiệm</h3>
                </div>
                <div class="secion-detail">
                    <ul class="list-item">

                        <li>
                            <a href="#cook" title="">Nấu ăn</a>
                        </li>
                        <li>
                            <a href="#travel" title="">Du lịch</a>
                        </li>
                        <li>
                            <a href="#health" title="">Sức khỏe</a>
                        </li>

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
                    <a href="?page=detail_product" title="" class="thumb">
                        <img src="{{ asset('images/banner-4.jpg') }}" alt="">
                    </a>
                </div>
            </div>
        </div> 
</div>
@stop
