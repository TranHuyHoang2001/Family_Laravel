@extends('frontend.layout.master')

@section('title', 'Trang chủ')

@section('content')
    <div id="main-content-wp" class="clearfix detail-blog-page">
        <div class="wp-inner">
            <div class="secion" id="breadcrumb-wp">

            </div>
        </div>

        <div class="contact">
            <h3>CONTACT US</h3>
            <form name="myForm" action="" method="POST">
                <input type="text" name="username" id="username" placeholder="Your name">
                <input type="email" name="email" id="email" placeholder="Email@address.com">
                <input type="text" name="phone" id="phone" placeholder="Your phone">
                <input type="text" name="company" id="company" placeholder="Your commpany">
                <input type="text" name="website" id="website" placeholder="Your website">
                <textarea name="message" id="" cols="70" rows="5">Message</textarea>
                <button>Send</button>
            </form>
        </div>
    </div>
    </div>
    </div>
@stop
