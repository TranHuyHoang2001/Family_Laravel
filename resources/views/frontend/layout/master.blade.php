<!DOCTYPE html>
<html>
<head>
    <title>FAMILY</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('frontend/css/bootstrap/bootstrap-theme.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('frontend/css/bootstrap/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('frontend/css/reset.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('frontend/css/carousel/owl.carousel.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('frontend/css/carousel/owl.theme.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('frontend/css/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/solid.min.css">

    <link href="{{asset('frontend/css/style.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('frontend/css/responsive.css')}}" rel="stylesheet" type="text/css"/>

    <script src="{{asset('frontend/js/jquery-2.2.4.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('frontend/js/elevatezoom-master/jquery.elevatezoom.js')}}" type="text/javascript"></script>
    <script src="{{asset('frontend/js/bootstrap/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('frontend/js/carousel/owl.carousel.js')}}" type="text/javascript"></script>
    <script src="{{asset('frontend/js/main.js')}}" type="text/javascript"></script>
</head>
<body>
<div id="site">
    <div id="container">
        <div id="header-wp">
            <div id="head-top" class="clearfix">

                <div class="wp-inner clearfix d-flex" id="tk">
                    <div class="logo">
                        <a href="{{route('dashboard')}}" title="" id="logo" class="fl-left">
                        FAMILY
                        </a>
                    </div>
                    

                    <div class="accout clearfix">
                        @if(!\Cartalyst\Sentinel\Laravel\Facades\Sentinel::check())
                        <div class="reg clearfix">
                            <a href="{{route('login')}}">Đăng nhập</a>
                        </div>
                        <div class="reg clearfix">
                            <a href="{{route('register')}}">Đăng ký</a>
                        </div>
                        @endif
                        @if(\Cartalyst\Sentinel\Laravel\Facades\Sentinel::check())
                        <div class="login clearfix">

                            <a href="{{route('logout')}}">Đăng xuất</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="wp-inner">
                <div id="head-body" class="clearfix">
                   

                    <div id="main-menu-wp" >
                        <ul id="main-menu" class="clearfix d-flex">
                            <li>
                                <a href="{{route('dashboard')}}" title="">Trang chủ</a>
                            </li>
                            <li>
                                <a href="{{route('job')}}" title="">Công việc</a>
                            </li>
                            <li>
                                <a href="{{route('moment')}}" title="">Khoảnh khắc</a>
                            </li>
                            <li>
                                <a href="{{route('experience')}}" title="">Kinh nghiệm</a>
                            </li>
                            <li>
                                <a href="{{route('product')}}" title="">Sản phẩm</a>
                            </li>
                            <li>
                                <a href="{{route('introduce')}}" title="">Giới thiệu</a>
                            </li>
                            <li>
                                <a href="{{route('contact')}}" title="">Liên hệ</a>
                            </li>
                        </ul>

                    </div>
                    <div class="form-search form-inline">
                        <form action="#" class="d-flex">
                            <input type="text" class="form-control form-search" name="keyword"  placeholder="Tìm kiếm">
                            <i class="fas fa-search"></i>
                        </form>
                    </div>
                    <div id="action-wp" class="fl-right">
                        <div id="search">
                        <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                        </div>
                        <div id="cart-wp" class="fl-right">
                            <div id="btn-cart">
                                <a href="{{ route('cart') }}" style="color: #fff;">
                                     <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span id="num">{{ Cart::count() }}</span>
                                </a>
                               
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @include('frontend.layout.notification')
        @yield('content')
        <div id="footer-wp">
            <div id="foot-body">
                <div class="wp-inner clearfix">
                    <div class="block" id="info-company">
                        <h3 class="title">FAMILY</h3>
                        <p class="desc">FAMILY là nơi tình yêu luôn hiện hữu, nó đến từ cha mẹ bạn, từ anh chị em của bạn, hãy lấp đầy ngôi nhà bằng tình yêu thương, gia đình - nơi chốn yêu thương.</p>
                        <div id="payment">
                            <div class="thumb">
                                <img src="{{asset('frontend/images/img-foot.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="block menu-ft" id="info-shop">
                        <h3 class="title">Thông tin liên hệ</h3>
                        <ul class="list-item">
                            <li>
                                <p>106 - Trần Bình - Cầu Giấy - Hà Nội</p>
                            </li>
                            <li>
                                <p>0987.654.321 - 0989.989.989</p>
                            </li>
                            <li>
                                <p>vshop@gmail.com</p>
                            </li>
                        </ul>
                    </div>
                    <div class="block menu-ft policy" id="info-shop">
                        <h3 class="title">Quy định thành viên</h3>
                        <ul class="list-item">
                            <li>
                                <a href="" title="">Quy định - Cam kết</a>
                            </li>
                            <li>
                                <a href="" title="">Văn hóa -Văn minh</a>
                            </li>
                            <li>
                                <a href="" title="">Chính sách thành viên</a>
                            </li>
                            <li>
                                <a href="" title="">Sản phẩm uy tín</a>
                            </li>
                        </ul>
                    </div>
                    <div class="block" id="newfeed">
                        <h3 class="title">Bảng tin</h3>
                        <p class="desc">Đăng ký với chung tôi để nhận được thông tin ưu đãi sớm nhất</p>
                        <div id="form-reg">
                            <form method="POST" action="">
                                <input type="email" name="email" id="email" placeholder="Nhập email tại đây">

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="foot-bot">
                <div class="wp-inner">
                    <p id="copyright">© VNH hân hạnh tài trợ</p>
                </div>
            </div>
        </div>
    </div>

    <div id="btn-top"><img src="{{asset('frontend/images/icon-to-top.png')}}" alt=""/></div>
    <div id="fb-root"></div>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
                return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=849340975164592";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
</div>
</body>
</html>
