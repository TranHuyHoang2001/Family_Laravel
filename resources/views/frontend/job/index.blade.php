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
                            <a href="" title="">Công việc</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-content fl-right">
                <div class="section" id="list-work-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title">Công việc</h3>
                    </div>
                    <div class="section-detail">
                        <table>
                            <tr class="table-head">

                                <td>#</td>
                                <td class="namework">Tên công việc</td>
                                <td>Điểm hoàn thành</td>
                                <td>Role</td>
                            </tr>
                            <tbody>
                            @if($jobs && count($jobs) > 0)
                                @foreach($jobs as $key => $job)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$job->job->name}}</td>
                                        <td>{{$job->job->point}}</td>
                                        <td>
                                            @php
                                                $role = \Cartalyst\Sentinel\Laravel\Facades\Sentinel::findRoleById($job->job->role_id ?? 1)
                                            @endphp
                                            {{$role->id == 1 ? 'Chung' : $role->name}}
                                        </td>
                                    </tr>
                                @endforeach
                                 
                            @endif
                            </tbody>
                           
                        </table>
                        {{-- {{ $jobs->links() }} --}}
                    </div>
                </div>
                @if(count($jobs) > 0)
                <div class="section" id="paging-wp">
                    {!! $jobs->withQueryString()->links('pagination::bootstrap-4') !!}
                </div>
                @endif
                <div class="honors">
                    <div class="section" id="list-work-wp">
                        <div class="section-head clearfix">
                            <h3 class="section-title">VINH DANH</h3>
                        </div>
                        <div class="section-detail">
                            <table>
                                <tr class="table-head">

                                    <td>#</td>
                                    <td class="namework">Thành viên / Gia đình</td>
                                    <td>Vinh danh</td>
                                </tr>
                                <tbody>
                                @if ($honors && count($honors) > 0)
                                    @foreach ($honors as $key => $val)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            @if(isset($val->user))
                                                <td>{{ $val->user->first_name }}</td>
                                            @elseif(isset($val->family))
                                                <td>{{ $val->family->name }}</td>
                                            @endif
                                            <td>{{ isset($val->criteria) ? $val->criteria->name : '' }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if(count($honors) > 0)
                    <div class="section" id="paging-wp">
                        {!! $honors->withQueryString()->links('pagination::bootstrap-4') !!}
                    </div>
                    @endif
                </div>

                <div class="section" id="list-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Công việc nổi bật</h3>
                    </div>
                    @if($jobs_highlight && count($jobs_highlight) > 0)
                        <div class="section-detail">
                            <ul class="list-item clearfix">
                                @foreach($jobs_highlight as $job_highlight)
                                    <li>
                                        <a href="javascript:void(0)"
                                           title="{{ isset($job_highlight->job) ? $job_highlight->job->name : ''}}"
                                           class="thumb">
                                            <img
                                                src="{{ $job_highlight->image_1 ? asset($job_highlight->image_1) : asset('images/empty_image_260x200.png')}}"
                                                onerror="this.onerror=null;this.src={{asset('images/empty_image_260x200.png')}};">
                                        </a>
                                        <a href="#" title=""
                                           class="product-name">{{ isset($job_highlight->job) ? $job_highlight->job->name : ''}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
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
                        <a href="" title="" class="thumb">
                            <img src="{{asset('images/banner-3.jpg')}}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
