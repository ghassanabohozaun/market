@extends('layouts.dashboard.app')

@section('title')
    {!! $title !!}
@endsection

@push('css')
    <link rel="stylesheet" href="{!! asset('assets/dashboard/vendors/summernote/summernote-lite.min.css') !!}">
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <!--------------------  Start Breadcrumb  ---------------------------->
                    <div class="d-md-flex align-items-center justify-content-between border-bottom mb-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard.index') }}">{!! __('dashboard.dashboard') !!}</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard.pages.index') }}">{!! __('pages.pages') !!}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{!! __('pages.create_new_page') !!}</li>
                            </ol>
                        </nav>
                        <div class="btn-wrapper">
                            <a href="{{ route('dashboard.pages.index') }}"
                                class="btn btn-outline-dark btn-sm me-0 custom-shadow-sm">
                                <i class="mdi mdi-arrow-left"></i> {!! __('general.back') !!}
                            </a>
                        </div>
                    </div>
                    <!--------------------  End Breadcrumb  ---------------------------->

                    <div class="row">
                        <div class="col-md-12">
                            <form id="createPageForm" action="{!! route('dashboard.pages.store') !!}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card card-settings-premium">
                                    <div class="card-body">
                                        <h4 class="card-title card-title-dash mb-4">
                                            <i class="mdi mdi-plus-circle-outline text-primary me-2"></i>
                                            {!! __('pages.create_new_page') !!}
                                        </h4>

                                        <div class="row g-4">
                                            <!-- Arabic Title -->
                                            <div class="col-md-6">
                                                <div class="form-group mb-0 theme-primary">
                                                    <label class="form-label-premium" for="title_ar">
                                                        {!! __('pages.title_ar') !!} <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="input-group-premium">
                                                        <span class="input-group-text"><i
                                                                class="mdi mdi-format-title"></i></span>
                                                        <input type="text" id="title_ar" name="title[ar]"
                                                            class="form-control" value="{{ old('title.ar') }}"
                                                            placeholder="{!! __('pages.enter_title_ar') !!}">
                                                    </div>
                                                    <strong id="title_ar_error" class="text-danger small"></strong>
                                                </div>
                                            </div>

                                            <!-- English Title -->
                                            <div class="col-md-6">
                                                <div class="form-group mb-0 theme-info">
                                                    <label class="form-label-premium" for="title_en">
                                                        {!! __('pages.title_en') !!} <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="input-group-premium">
                                                        <span class="input-group-text"><i
                                                                class="mdi mdi-format-title"></i></span>
                                                        <input type="text" id="title_en" name="title[en]"
                                                            class="form-control" value="{{ old('title.en') }}"
                                                            placeholder="{!! __('pages.enter_title_en') !!}">
                                                    </div>
                                                    <strong id="title_en_error" class="text-danger small"></strong>
                                                </div>
                                            </div>

                                            <!-- Arabic Details -->
                                            <div class="col-md-12">
                                                <div class="form-group mb-0 theme-primary">
                                                    <label class="form-label-premium" for="details_ar">
                                                        {!! __('pages.details_ar') !!} <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="input-group-premium">
                                                        <textarea id="details_ar" name="details[ar]" class="form-control summernote"
                                                            data-placeholder="{!! __('pages.enter_details_ar') !!}">{{ old('details.ar') }}</textarea>
                                                    </div>
                                                    <strong id="details_ar_error" class="text-danger small"></strong>
                                                </div>
                                            </div>

                                            <!-- English Details -->
                                            <div class="col-md-12">
                                                <div class="form-group mb-0 theme-info">
                                                    <label class="form-label-premium" for="details_en">
                                                        {!! __('pages.details_en') !!} <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="input-group-premium">
                                                        <textarea id="details_en" name="details[en]" class="form-control summernote"
                                                            data-placeholder="{!! __('pages.enter_details_en') !!}">{{ old('details.en') }}</textarea>
                                                    </div>
                                                    <strong id="details_en_error" class="text-danger small"></strong>
                                                </div>
                                            </div>

                                            <!-- Page Image -->
                                            <div class="col-md-12">
                                                <x-dashboard.file-input name="photo" id="page_photo_input"
                                                    label="{!! __('pages.photo') !!} <span class='text-danger'>*</span>"
                                                    placeholderIcon="mdi-image-outline" placeholderText="1700 × 1000"
                                                    isRequired="false" errorId="photo_error" />
                                                <small class="text-muted mt-1 d-block">
                                                    <i class="mdi mdi-information-outline me-1"></i>{!! __('pages.page_size') !!}
                                                    (1700 × 1000)
                                                </small>
                                            </div>

                                            <!-- Status Toggle -->
                                            <div class="col-md-12 mt-3 theme-success">
                                                <div class="form-group mb-0">
                                                    <div class="input-group-premium p-1 pe-3"
                                                        style="background-color: #fafafafa;">
                                                        <span class="input-group-text"><i class="mdi mdi-power"></i></span>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between flex-grow-1">
                                                            <label class="mb-0 form-label-premium"
                                                                for="status_active_create">
                                                                {!! __('pages.status') !!} <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="form-check form-switch mb-0">
                                                                <input type="hidden" name="status" value="0">
                                                                <input type="checkbox" class="form-check-input"
                                                                    name="status" id="status_active_create"
                                                                    value="1" checked>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <strong id="status_error" class="text-danger small"></strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Floating Command HUD -->
                                <x-dashboard.command-hud formId="createPageForm" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{!! asset('assets/dashboard/vendors/summernote/summernote-lite.min.js') !!}"></script>
    <script>
        $(document).ready(function() {
            // --- Summernote Init ---
            $('.summernote').summernote({
                height: 300,
                placeholder: $('.summernote').first().data('placeholder'),
                tabsize: 2,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            // --- Initialize HUD ---
            initHud('createPageForm');

            // --- Page Create Form Handler ---
            window.handleFormSubmit('#createPageForm', {
                successMessage: "{!! __('general.add_success_message') !!}",
                onSuccess: function() {
                    if (window.activeHud) window.activeHud.changedFields
                        .clear(); // Clear tracking on success
                    setTimeout(function() {
                        window.location.href = "{!! route('dashboard.pages.index') !!}";
                    }, 1500);
                }
            });
        });
    </script>
@endpush
