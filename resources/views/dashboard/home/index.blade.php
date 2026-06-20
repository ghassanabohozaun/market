@extends('layouts.dashboard.app')
@section('title')
    {!! $title !!}
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <!--------------------  Start Breadcrumb  ---------------------------->
                    <div class="d-md-flex align-items-center justify-content-between border-bottom mb-1">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard.index') }}">{!! __('dashboard.dashboard') !!}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{!! __('dashboard.home') !!}</li>
                            </ol>
                        </nav>
                    </div>
                    <!--------------------  End Breadcrumb  ---------------------------->

                    <div class="mt-4 text-center">
                        <h4 class="text-muted">مرحباً بك في لوحة تحكم دكانة</h4>
                        <p class="text-muted">لوحة التحكم قيد الإنشاء للمشروع الجديد</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
