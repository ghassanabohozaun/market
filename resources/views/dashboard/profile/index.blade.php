@extends('layouts.dashboard.app')
@section('title')
    {!! $title !!}
@endsection

@section('content')
    <div class="content-wrapper profile-page-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <!--------------------  Start Breadcrumb  ---------------------------->
                    <div class="d-md-flex align-items-center justify-content-between mb-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard.index') }}">{!! __('dashboard.dashboard') !!}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{!! $title !!}</li>
                            </ol>
                        </nav>
                        <div class="btn-wrapper mt-3 mt-sm-0">
                            <button type="button" class="btn btn-primary btn-sm text-white me-0" data-bs-toggle="modal"
                                data-bs-target="#changePasswordModal">
                                <i class="icon-plus"></i> {!! __('profile.change_password') !!}
                            </button>
                        </div>
                    </div>
                    <!--------------------  End Breadcrumb  ---------------------------->
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- Profile Left Panel -->
                            <div class="col-lg-4">
                                <div class="border-bottom text-center pb-4">
                                    @php
                                        $admin = admin()->user();
                                    @endphp
                                    <img src="{!! $admin->photo
                                        ? asset('uploads/adminsPhotos/' . $admin->photo)
                                        : asset('assets/dashboard/images/faces/avatar-male.jpg') !!}" alt="profile" class="img-lg rounded-circle mb-3"
                                        style="width: 100px; height: 100px; object-fit: contain; background-color: #f8f9fa;">
                                    <div class="mb-3">
                                        <h3>{{ $admin->name }}</h3>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <h5 class="mb-0 me-2 text-muted fw-normal">{{ __('dashboard.admin') }}</h5>
                                            <div class="br-wrapper br-theme-css-stars">
                                                <!-- Additional tags/status could go here -->
                                            </div>
                                        </div>
                                    </div>
                                    <p class="w-75 mx-auto mb-3">{{ __('profile.summary_placeholder') }}</p>
                                </div>

                                <div class="border-bottom py-4">
                                    <p>{{ __('profile.contact_info') }}</p>
                                    <div>
                                        <label class="badge badge-outline-dark">{{ __('profile.status') }}: <span
                                                class="text-success">{{ $admin->status == 1 ? __('general.active') : __('general.inactive') }}</span></label>
                                    </div>
                                </div>

                                <div class="py-4">
                                    <p class="clearfix">
                                        <span class="float-start">{{ __('profile.email') }}</span>
                                        <span class="float-end text-muted">{{ $admin->email }}</span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-start">{{ __('profile.joined_date') }}</span>
                                        <span class="float-end text-muted">{{ $admin->created_at }}</span>
                                    </p>
                                </div>
                            </div>

                            <!-- Profile Right Panel (Tabs Integration) -->
                            <div class="col-lg-8 pl-lg-5">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3>{{ $admin->name }}</h3>
                                        <div class="d-flex align-items-center">
                                            <h5 class="mb-0 me-2 text-muted">{{ $admin->email }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 py-2 border-top border-bottom">
                                    <ul class="nav profile-navbar" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="info-tab" data-bs-toggle="tab" href="#info"
                                                role="tab" aria-controls="info" aria-selected="true">
                                                <i class="mdi mdi-account-outline"></i> {{ __('profile.info') }}
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="feed-tab" data-bs-toggle="tab" href="#feed"
                                                role="tab" aria-controls="feed" aria-selected="false">
                                                <i class="mdi mdi-newspaper"></i> {{ __('profile.feed') }}
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="agenda-tab" data-bs-toggle="tab" href="#agenda"
                                                role="tab" aria-controls="agenda" aria-selected="false">
                                                <i class="mdi mdi-calendar"></i> {{ __('profile.agenda') }}
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="resume-tab" data-bs-toggle="tab" href="#resume"
                                                role="tab" aria-controls="resume" aria-selected="false">
                                                <i class="mdi mdi-attachment"></i> {{ __('profile.resume') }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-content" id="profile-tab-content">
                                    <!-- Info Tab Pane -->
                                    <div class="tab-pane fade show active" id="info" role="tabpanel"
                                        aria-labelledby="info-tab">
                                        <div class="profile-feed">
                                            <div class="d-flex align-items-start profile-feed-item mt-4">
                                                <img src="{!! $admin->photo
                                                    ? asset('uploads/adminsPhotos/' . $admin->photo)
                                                    : asset('assets/dashboard/images/faces/avatar-male.jpg') !!}" alt="profile"
                                                    class="img-sm rounded-circle"
                                                    style="object-fit: contain; background-color: #f8f9fa;">
                                                <div class="ms-4">
                                                    <h6>
                                                        {{ $admin->name }}
                                                        <small class="ms-4 text-muted"><i
                                                                class="mdi mdi-clock me-1"></i>{{ __('profile.just_now') }}</small>
                                                    </h6>
                                                    <p>{{ __('profile.welcome_message') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Feed Tab Pane -->
                                    <div class="tab-pane fade" id="feed" role="tabpanel"
                                        aria-labelledby="feed-tab">
                                        <div class="mt-4">
                                            <h5 class="text-muted text-center py-5">
                                                {{ __('general.no_data_available') ?? 'No data available' }}</h5>
                                        </div>
                                    </div>

                                    <!-- Agenda Tab Pane -->
                                    <div class="tab-pane fade" id="agenda" role="tabpanel"
                                        aria-labelledby="agenda-tab">
                                        <div class="mt-4">
                                            <h5 class="text-muted text-center py-5">
                                                {{ __('general.no_data_available') ?? 'No data available' }}</h5>
                                        </div>
                                    </div>

                                    <!-- Resume Tab Pane -->
                                    <div class="tab-pane fade" id="resume" role="tabpanel"
                                        aria-labelledby="resume-tab">
                                        <div class="mt-4">
                                            <h5 class="text-muted text-center py-5">
                                                {{ __('general.no_data_available') ?? 'No data available' }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@push('modals')
    @include('dashboard.profile.modals.change-password')
@endpush
