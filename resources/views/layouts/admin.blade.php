<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/solid.min.css">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <title>Admintrator</title>
</head>

<body>
    <div id="warpper" class="nav-fixed">
        <nav class="topnav shadow navbar-light bg-white d-flex">
            <div class="navbar-brand"><a href="{{ url('/') }}"> Website Family</a></div>
            <div class="nav-right ">
                <div class="btn-group mr-auto">
                    <button type="button" class="btn dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="plus-icon fas fa-plus-circle"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ url('admin/page/add') }}">Thêm bài viết</a>
                        <a class="dropdown-item" href="{{ url('admin/product/add') }}">Thêm sản phẩm</a>
                    </div>
                </div>
                <div class="btn-group">
                    {{\Cartalyst\Sentinel\Laravel\Facades\Sentinel::getUser()->first_name}}
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">Tài khoản</a>
                        <a class="dropdown-item" href="{{ route('logout') }}">
                            <a class="dropdown-item" href="{{ route('logout') }}">
                             {{ __('Logout') }}
                         </a>

                         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                             @csrf
                         </form>
                    </div>
                </div>
            </div>
        </nav>
        <!-- end nav  -->
        <div id="page-body" class="d-flex">
            <div id="sidebar" class="bg-white">
                <ul id="sidebar-menu">
                    <li class="nav-link">
                        <a href="{{  route('job.index')  }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="fas fa-tachometer"></i>
                            </div>
                            Dashboard
                        </a>
                        <i class="arrow fas fa-angle-right"></i>
                    </li>
                    <li class="nav-link">
                        <a href="{{ route('introduce_family.index') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="fas fa-address-card"></i>
                            </div>
                            Giới thiệu
                        </a>
                        <i class="arrow fas fa-angle-right"></i>
                    </li>
                    <li class="nav-link">
                        <a href="{{ route('experience.index') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="fas fa-share-square"></i>
                            </div>
                            Chia sẻ kinh nghiệm
                        </a>
                        <i class="arrow fas fa-angle-right"></i>

                        <ul class="sub-menu">
                            <li><a href="{{ route('experience.create') }}">Thêm mới</a></li>
                            <li><a href="{{ route('experience.index') }}">Danh sách</a></li>
                        </ul>
                    </li>
                    @if(Sentinel::getUser()->family || Sentinel::getUser()->memberFamily)
                        <li class="nav-link">
                            <a href="{{ route('family.family_moment') }}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="fas fa-camera"></i>
                                </div>
                                Khoảnh khắc
                            </a>
                            <i class="arrow fas fa-angle-right"></i>

                            <ul class="sub-menu">
                                @php
                                    $id = Sentinel::getUser()->family ? Sentinel::getUser()->family->id : Sentinel::getUser()->memberFamily->id;
                                @endphp
                                <li><a href="{{ route('family.family_moment_create') }}">Tạo khoảnh khắc</a></li>
                                <li><a href="{{ route('family.family_moment', $id) }}">Chia sẻ khoảnh khắc</a></li>
                            </ul>
                        </li>
                    @endif
                    <li class="nav-link">
                        <a href="{{ route('product.index') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="fab fa-product-hunt"></i>
                            </div>
                           Sản phẩm
                        </a>
                        <i class="arrow fas fa-angle-right"></i>

                        <ul class="sub-menu">
                            <li><a href="{{ route('product.create') }}">Thêm mới</a></li>
                            <li><a href="{{ route('product.index') }}">Danh sách</a></li>
                          
                        </ul>
                    </li>
                    @if(\Cartalyst\Sentinel\Laravel\Facades\Sentinel::getUser()->inRole('root'))
                    <li class="nav-link">
                        <a href="{{ route('bill.index') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                          Đơn hàng
                        </a>
                        <i class="arrow fas fa-angle-right"></i>

                        <ul class="sub-menu">
                            <li><a href="{{ route('bill.index')  }}">Danh sách</a></li>
                            <li><a href="{{ route('bill.export') }}">Xuất danh sách</a></li>
                          
                        </ul>
                       
                    </li>
                    @endif
                    <li class="nav-link">
                        <a href="{{ route('job.index') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="fas fa-briefcase"></i>
                            </div>
                           Công việc
                        </a>
                        <i class="arrow fas fa-angle-right"></i>
                        <ul class="sub-menu">
                            <li><a href="{{ route('job.create') }}">Thêm mới</a></li>
                            <li><a href="{{ route('job.index') }}">Danh sách</a></li>
                            <li><a href="{{route('job.report')}}">Thống kê</a></li>
                        </ul>
                    </li>
                    <li class="nav-link">
                        <a href="{{ route('user.index') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="fas fa-users"></i>
                            </div>
                           Thành viên
                        </a>
                        <i class="arrow fas fa-angle-right"></i>

                        <ul class="sub-menu">
                            @php 
                                $role = Sentinel::getUser()->roles()->first() ? Sentinel::getUser()->roles()->first()->id : null;
                            @endphp
                            @if (in_array($role, [1,2,3]))
                            <li><a href="{{ route('user.create') }}">Thêm mới</a></li>
                            @endif
                            <li><a href="{{ route('user.index') }}">Danh sách</a></li>
                        </ul>
                    </li>
                    <li class="nav-link">
                        <a href="{{ route('family.index') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="fas fa-home"></i>
                            </div>
                            Gia đình
                        </a>
                        <i class="arrow fas fa-angle-right"></i>

                        <ul class="sub-menu">
                            <li><a href="{{ route('family.create') }}">Thêm mới</a></li>
                            <li><a href="{{ route('family.index') }}">Danh sách</a></li>
                            <li><a href="{{ route('family.job_of_family') }}">D/s công việc gia đình</a></li>
                        </ul>
                    </li>
                    @if(\Cartalyst\Sentinel\Laravel\Facades\Sentinel::getUser()->inRole('root'))
                    <li class="nav-link">
                        <a href="{{  route('criteria.index')}}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="fas fa-bullseye"></i>
                            </div>
                            Tiêu chí
                        </a>
                        <i class="arrow fas fa-angle-right"></i>

                        <ul class="sub-menu">
                            <li><a href="{{ route('criteria.create') }}">Thêm mới</a></li>
                            <li><a href="{{ route('criteria.index') }}">Danh sách</a></li>
                        </ul>
                    </li>
                    @endif

                    @if(\Cartalyst\Sentinel\Laravel\Facades\Sentinel::getUser()->inRole('root'))
                        <li class="nav-link">
                            <a href="{{ route('honors.index') }}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="fas fa-trophy"></i>
                                </div>
                                Vinh danh
                            </a>
                            <i class="arrow fas fa-angle-right"></i>

                            <ul class="sub-menu">
                                <li><a href="{{ route('honors.createUser') }}">Vinh danh cá nhân</a></li>
                                <li><a href="{{ route('honors.createFamily') }}">Vinh danh gia đình</a></li>
                                <li><a href="{{ route('honors.index') }}">Danh sách vinh danh</a></li>
                            </ul>
                        </li>
                    @endif

                </ul>
            </div>
            <div id="wp-content">
                @include('layouts.notification')
                @yield('content')
            </div>
        </div>


    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('admin/js/app.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    @yield('script')
</body>

</html>
