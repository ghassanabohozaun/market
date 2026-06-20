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
                    <div class="d-md-flex align-items-center justify-content-between border-bottom mb-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard.index') }}">{!! __('dashboard.dashboard') !!}</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard.sliders.index') }}">{!! __('sliders.sliders') !!}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{!! __('sliders.update_slider') !!}</li>
                            </ol>
                        </nav>
                        <div class="btn-wrapper">
                            <a href="{{ route('dashboard.sliders.index') }}"
                                class="btn btn-outline-dark btn-sm me-0 custom-shadow-sm">
                                <i class="mdi mdi-arrow-left"></i> {!! __('general.back') !!}
                            </a>
                        </div>
                    </div>
                    <!--------------------  End Breadcrumb  ---------------------------->

                    <div class="row">
                        <div class="col-md-12">
                            <form id="updateSliderForm" action="{{ route('dashboard.sliders.update', $slider->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card card-settings-premium">
                                    <div class="card-body">
                                        <h4 class="card-title card-title-dash mb-4">
                                            <i class="mdi mdi-pencil-circle-outline text-primary me-2"></i>
                                            {!! __('sliders.update_slider') !!}
                                        </h4>
                                        <div class="row g-4">
                                            <!-- Arabic Title -->
                                            <div class="col-md-6 theme-primary">
                                                <div class="form-group mb-0">
                                                    <label class="form-label-premium" for="title_ar">{!! __('sliders.title_ar') !!}
                                                        <span class="text-danger">*</span></label>
                                                    <div class="input-group-premium">
                                                        <span class="input-group-text"><i
                                                                class="mdi mdi-format-title text-primary"></i></span>
                                                        <input type="text" id="title_ar" name="title[ar]"
                                                            class="form-control"
                                                            value="{{ $slider->getTranslation('title', 'ar') }}"
                                                            placeholder="{!! __('sliders.enter_title_ar') !!}" autocomplete="off">
                                                    </div>
                                                    <strong id="title_ar_error" class="text-danger small"></strong>
                                                </div>
                                            </div>
                                            <!-- Arabic Subtitle -->
                                            <div class="col-md-6">
                                                <div class="form-group position-relative">
                                                    <label class="form-label-premium" for="subtitle_ar">{!! __('sliders.subtitle_ar') !!} <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group input-group-premium">
                                                        <span class="input-group-text"><i
                                                                class="mdi mdi-format-title text-primary"></i></span>
                                                        <input type="text" id="subtitle_ar" name="subtitle[ar]"
                                                            value="{{ $slider->getTranslation('subtitle', 'ar', false) ?? '' }}"
                                                            class="form-control" placeholder="{!! __('sliders.enter_subtitle_ar') !!}">
                                                    </div>
                                                    <strong id="subtitle_ar_error" class="text-danger small"></strong>
                                                </div>
                                            </div>
                                            <!-- English Title -->
                                            <div class="col-md-6 theme-info">
                                                <div class="form-group mb-0">
                                                    <label class="form-label-premium" for="title_en">{!! __('sliders.title_en') !!}
                                                        <span class="text-danger">*</span></label>
                                                    <div class="input-group-premium">
                                                        <span class="input-group-text"><i
                                                                class="mdi mdi-format-title text-primary"></i></span>
                                                        <input type="text" id="title_en" name="title[en]"
                                                            class="form-control"
                                                            value="{{ $slider->getTranslation('title', 'en') }}"
                                                            placeholder="{!! __('sliders.enter_title_en') !!}" autocomplete="off">
                                                    </div>
                                                    <strong id="title_en_error" class="text-danger small"></strong>
                                                </div>
                                            </div>
                                            <!-- English Subtitle -->
                                            <div class="col-md-6">
                                                <div class="form-group position-relative">
                                                    <label class="form-label-premium" for="subtitle_en">{!! __('sliders.subtitle_en') !!} <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group input-group-premium">
                                                        <span class="input-group-text"><i
                                                                class="mdi mdi-format-title text-primary"></i></span>
                                                        <input type="text" id="subtitle_en" name="subtitle[en]"
                                                            value="{{ $slider->getTranslation('subtitle', 'en', false) ?? '' }}"
                                                            class="form-control" placeholder="{!! __('sliders.enter_subtitle_en') !!}">
                                                    </div>
                                                    <strong id="subtitle_en_error" class="text-danger small"></strong>
                                                </div>
                                            </div>

                                            <!-- Arabic Details -->
                                            <div class="col-md-6 theme-primary">
                                                <div class="form-group mb-0">
                                                    <label class="form-label-premium"
                                                        for="details_ar">{!! __('sliders.details_ar') !!} <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group-premium">
                                                        <textarea id="details_ar" name="details[ar]" class="form-control" rows="3" placeholder="{!! __('sliders.enter_details_ar') !!}">{{ $slider->getTranslation('details', 'ar') }}</textarea>
                                                    </div>
                                                    <strong id="details_ar_error" class="text-danger small"></strong>
                                                </div>
                                            </div>
                                            <!-- English Details -->
                                            <div class="col-md-6 theme-info">
                                                <div class="form-group mb-0">
                                                    <label class="form-label-premium"
                                                        for="details_en">{!! __('sliders.details_en') !!} <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group-premium">
                                                        <textarea id="details_en" name="details[en]" class="form-control" rows="3" placeholder="{!! __('sliders.enter_details_en') !!}">{{ $slider->getTranslation('details', 'en') }}</textarea>
                                                    </div>
                                                    <strong id="details_en_error" class="text-danger small"></strong>
                                                </div>
                                            </div>

                                            <!-- Arabic URL -->
                                            <div class="col-md-6 theme-primary">
                                                <div class="form-group mb-0">
                                                    <label class="form-label-premium"
                                                        for="url_ar">{!! __('sliders.url_ar') !!}</label>
                                                    <div class="input-group-premium">
                                                        <span class="input-group-text"><i
                                                                class="mdi mdi-link-variant text-primary"></i></span>
                                                        <input type="text" id="url_ar" name="url[ar]"
                                                            class="form-control"
                                                            value="{{ $slider->getTranslation('url', 'ar') }}"
                                                            placeholder="{!! __('sliders.enter_url_ar') !!}">
                                                    </div>
                                                    <strong id="url_ar_error" class="text-danger small"></strong>
                                                </div>
                                            </div>
                                            <!-- English URL -->
                                            <div class="col-md-6 theme-info">
                                                <div class="form-group mb-0">
                                                    <label class="form-label-premium"
                                                        for="url_en">{!! __('sliders.url_en') !!}</label>
                                                    <div class="input-group-premium">
                                                        <span class="input-group-text"><i
                                                                class="mdi mdi-link-variant text-primary"></i></span>
                                                        <input type="text" id="url_en" name="url[en]"
                                                            class="form-control"
                                                            value="{{ $slider->getTranslation('url', 'en') }}"
                                                            placeholder="{!! __('sliders.enter_url_en') !!}">
                                                    </div>
                                                    <strong id="url_en_error" class="text-danger small"></strong>
                                                </div>
                                            </div>

                                            <!-- Photo Upload -->
                                            <div class="col-md-12">
                                                <x-dashboard.file-input name="photo" id="edit_slider_photo_input"
                                                    label="{!! __('sliders.photo') !!}" placeholderIcon="mdi-image-outline"
                                                    placeholderText="1920 × 742" isRequired="false" errorId="photo_error"
                                                    currentImageUrl="{{ $slider->photo ? asset('uploads/sliders/' . $slider->photo) : null }}" />
                                                <small class="text-muted mt-1 d-block text-center w-100">
                                                    <i
                                                        class="mdi mdi-information-outline me-1"></i>{!! __('sliders.slider_size') !!}
                                                    (1920 × 742)
                                                </small>
                                            </div>

                                            <!-- Toggles -->
                                            <div class="col-md-4 theme-success">
                                                <div class="form-group mb-0">
                                                    <div class="input-group-premium p-1 pe-3"
                                                        style="background-color: #fafafafa;">
                                                        <span class="input-group-text"><i
                                                                class="mdi mdi-power text-success"></i></span>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between flex-grow-1">
                                                            <label class="mb-0 form-label-premium"
                                                                for="status_active">{!! __('sliders.status') !!} <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="form-check form-switch mb-0">
                                                                <input type="hidden" name="status" value="0">
                                                                <input type="checkbox" class="form-check-input m-0" role="switch"
                                                                    name="status" id="status_active" value="1"
                                                                    @checked($slider->status == 1) style="width: 2.5rem; height: 1.25rem; cursor: pointer;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <strong id="status_error" class="text-danger small"></strong>
                                                </div>
                                            </div>
                                            <div class="col-md-4 theme-warning">
                                                <div class="form-group mb-0">
                                                    <div class="input-group-premium p-1 pe-3"
                                                        style="background-color: #fafafafa;">
                                                        <span class="input-group-text"><i
                                                                class="mdi mdi-format-list-bulleted-type text-warning"></i></span>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between flex-grow-1">
                                                            <label class="mb-0 form-label-premium"
                                                                for="details_status_active">{!! __('sliders.details_status') !!} <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="form-check form-switch mb-0">
                                                                <input type="hidden" name="details_status"
                                                                    value="0">
                                                                <input type="checkbox" class="form-check-input m-0" role="switch"
                                                                    name="details_status" id="details_status_active"
                                                                    value="1" @checked($slider->details_status == 1) style="width: 2.5rem; height: 1.25rem; cursor: pointer;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <strong id="details_status_error" class="text-danger small"></strong>
                                                </div>
                                            </div>
                                            <div class="col-md-4 theme-info">
                                                <div class="form-group mb-0">
                                                    <div class="input-group-premium p-1 pe-3"
                                                        style="background-color: #fafafafa;">
                                                        <span class="input-group-text"><i
                                                                class="mdi mdi-gesture-tap-button text-info"></i></span>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between flex-grow-1">
                                                            <label class="mb-0 form-label-premium"
                                                                for="button_status_active">{!! __('sliders.button_status') !!} <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="form-check form-switch mb-0">
                                                                <input type="hidden" name="button_status"
                                                                    value="0">
                                                                <input type="checkbox" class="form-check-input m-0" role="switch"
                                                                    name="button_status" id="button_status_active"
                                                                    value="1" @checked($slider->button_status == 1) style="width: 2.5rem; height: 1.25rem; cursor: pointer;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <strong id="button_status_error" class="text-danger small"></strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <x-dashboard.command-hud formId="updateSliderForm" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize HUB
            initHud('updateSliderForm');

            // Handle Form Submission
            window.handleFormSubmit('#updateSliderForm', {
                successMessage: "{!! __('general.update_success_message') !!}",
                resetForm: false,
                onSuccess: function() {
                    if (window.activeHud) window.activeHud.changedFields.clear();
                    setTimeout(function() {
                        window.location.href = "{!! route('dashboard.sliders.index') !!}";
                    }, 1500);
                }
            });
        });
    </script>
@endpush
