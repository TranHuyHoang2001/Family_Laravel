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
            <div id="main-content-wp" class="clearfix detail-blog-page">
                <div class="wp-inner">
                    <div class="secion" id="breadcrumb-wp">

                    </div>
                </div>

                <div class="contact">
                    @include('frontend.layout.notification')
                    <h3>Register</h3>
                    <form name="myForm" action="{{route('post_register')}}" method="POST">
                        @csrf
                        <input type="email" name="email" placeholder="Email">
                        <input type="password" name="password" placeholder="Password">
                        <input type="text" name="first_name" placeholder="Họ tên">
                        <button style="margin: 0 !important;" type="submit">Send</button>
                    </form>
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

