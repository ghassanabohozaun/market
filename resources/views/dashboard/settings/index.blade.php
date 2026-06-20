@extends('layouts.dashboard.app')
@section('title')
    {!! $title !!}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">

                {{-- Breadcrumb --}}
                <div class="d-md-flex align-items-center justify-content-between border-bottom mb-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.index') }}">{!! __('dashboard.dashboard') !!}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{!! __('settings.settings') !!}</li>
                        </ol>
                    </nav>


                </div>

                <form id="settings_form" action="" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id='id' name="id" value="{!! setting()->id !!}">

                    <div class="row g-4 mb-5">

                        {{-- ===== Section 1: Basic Info ===== --}}
                        <div class="col-12 theme-primary">
                            <div class="card shadow-sm border-0 card-settings-premium">
                                <div class="card-header bg-white border-bottom d-flex align-items-center gap-2 py-3">
                                    <span class="settings-section-icon bg-primary-subtle text-primary rounded-2 p-2">
                                        <i class="mdi mdi-web fs-5"></i>
                                    </span>
                                    <div>
                                        <h6 class="mb-0 fw-bold text-dark">{{ __('settings.basic_settings_section') }}</h6>
                                        <small class="text-muted">{{ __('settings.site_name_ar') }} /
                                            {{ __('settings.site_name_en') }}</small>
                                    </div>
                                </div>
                                <div class="card-body py-4">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <label class="form-label-premium">{!! __('settings.site_name_ar') !!} <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text"><i
                                                        class="mdi mdi-translate text-primary"></i></span>
                                                <input type="text" id="site_name_ar" name="site_name[ar]"
                                                    value="{!! old('site_name.ar', setting()->getTranslation('site_name', 'ar')) !!}" class="form-control" autocomplete="off"
                                                    placeholder="{!! __('settings.enter_site_name_ar') !!}">
                                            </div>
                                            <strong id="site_name_ar_error" class="text-danger small"></strong>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label-premium">{!! __('settings.site_name_en') !!} <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text"><i
                                                        class="mdi mdi-alpha-e-box-outline text-primary"></i></span>
                                                <input type="text" id="site_name_en" name="site_name[en]"
                                                    value="{!! old('site_name.en', setting()->getTranslation('site_name', 'en')) !!}" class="form-control" autocomplete="off"
                                                    placeholder="{!! __('settings.enter_site_name_en') !!}">
                                            </div>
                                            <strong id="site_name_en_error" class="text-danger small"></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ===== Section 1.5: SEO Settings ===== --}}
                        <div class="col-12 theme-secondary">
                            <div class="card shadow-sm border-0 card-settings-premium">
                                <div class="card-header bg-white border-bottom d-flex align-items-center gap-2 py-3">
                                    <span class="settings-section-icon bg-secondary-subtle text-secondary rounded-2 p-2">
                                        <i class="mdi mdi-magnify fs-5"></i>
                                    </span>
                                    <div>
                                        <h6 class="mb-0 fw-bold text-dark">{{ __('settings.seo_section') }}</h6>
                                        <small class="text-muted">{{ __('settings.description_ar') }} / {{ __('settings.description_en') }} · {{ __('settings.keywords_ar') }} / {{ __('settings.keywords_en') }}</small>
                                    </div>
                                </div>
                                <div class="card-body py-4">
                                    <div class="row g-4">
                                        <!-- Description AR -->
                                        <div class="col-md-6">
                                            <label class="form-label-premium">{!! __('settings.description_ar') !!}</label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text align-items-start pt-2"><i class="mdi mdi-text text-primary"></i></span>
                                                <textarea id="description_ar" name="description[ar]" class="form-control" rows="5" placeholder="{!! __('settings.enter_description_ar') !!}">{!! old('description.ar', setting()->getTranslation('description', 'ar')) !!}</textarea>
                                            </div>
                                            <strong id="description_ar_error" class="text-danger small"></strong>
                                        </div>
                                        <!-- Description EN -->
                                        <div class="col-md-6">
                                            <label class="form-label-premium">{!! __('settings.description_en') !!}</label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text align-items-start pt-2"><i class="mdi mdi-alphabet-latin text-primary"></i></span>
                                                <textarea id="description_en" name="description[en]" class="form-control" rows="5" placeholder="{!! __('settings.enter_description_en') !!}">{!! old('description.en', setting()->getTranslation('description', 'en')) !!}</textarea>
                                            </div>
                                            <strong id="description_en_error" class="text-danger small"></strong>
                                        </div>
                                        <!-- Keywords AR -->
                                        <div class="col-md-6">
                                            <label class="form-label-premium">{!! __('settings.keywords_ar') !!}</label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text align-items-start pt-2"><i class="mdi mdi-tag-multiple text-primary"></i></span>
                                                <textarea id="keywords_ar" name="keywords[ar]" class="form-control" rows="5" placeholder="{!! __('settings.enter_keywords_ar') !!}">{!! old('keywords.ar', setting()->getTranslation('keywords', 'ar')) !!}</textarea>
                                            </div>
                                            <strong id="keywords_ar_error" class="text-danger small"></strong>
                                        </div>
                                        <!-- Keywords EN -->
                                        <div class="col-md-6">
                                            <label class="form-label-premium">{!! __('settings.keywords_en') !!}</label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text align-items-start pt-2"><i class="mdi mdi-tag-multiple-outline text-primary"></i></span>
                                                <textarea id="keywords_en" name="keywords[en]" class="form-control" rows="5" placeholder="{!! __('settings.enter_keywords_en') !!}">{!! old('keywords.en', setting()->getTranslation('keywords', 'en')) !!}</textarea>
                                            </div>
                                            <strong id="keywords_en_error" class="text-danger small"></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ===== Section 1.6: Address Settings ===== --}}
                        <div class="col-12 theme-primary">
                            <div class="card shadow-sm border-0 card-settings-premium">
                                <div class="card-header bg-white border-bottom d-flex align-items-center gap-2 py-3">
                                    <span class="settings-section-icon bg-primary-subtle text-primary rounded-2 p-2">
                                        <i class="mdi mdi-map-marker fs-5"></i>
                                    </span>
                                    <div>
                                        <h6 class="mb-0 fw-bold text-dark">{{ __('settings.address_section') }}</h6>
                                        <small class="text-muted">{{ __('settings.address_ar') }} / {{ __('settings.address_en') }}</small>
                                    </div>
                                </div>
                                <div class="card-body py-4">
                                    <div class="row g-4">
                                        <!-- Address AR -->
                                        <div class="col-md-6">
                                            <label class="form-label-premium">{!! __('settings.address_ar') !!}</label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text"><i class="mdi mdi-map-marker text-primary"></i></span>
                                                <input type="text" id="address_ar" name="address[ar]"
                                                    value="{!! old('address.ar', setting()->getTranslation('address', 'ar')) !!}" class="form-control" autocomplete="off"
                                                    placeholder="{!! __('settings.enter_address_ar') !!}">
                                            </div>
                                            <strong id="address_ar_error" class="text-danger small"></strong>
                                        </div>
                                        <!-- Address EN -->
                                        <div class="col-md-6">
                                            <label class="form-label-premium">{!! __('settings.address_en') !!}</label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text"><i class="mdi mdi-map-marker-outline text-primary"></i></span>
                                                <input type="text" id="address_en" name="address[en]"
                                                    value="{!! old('address.en', setting()->getTranslation('address', 'en')) !!}" class="form-control" autocomplete="off"
                                                    placeholder="{!! __('settings.enter_address_en') !!}">
                                            </div>
                                            <strong id="address_en_error" class="text-danger small"></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ===== Section 2: Social Media ===== --}}
                        <div class="col-12 theme-info">
                            <div class="card shadow-sm border-0 card-settings-premium">
                                <div class="card-header bg-white border-bottom d-flex align-items-center gap-2 py-3">
                                    <span class="settings-section-icon bg-info-subtle text-info rounded-2 p-2">
                                        <i class="mdi mdi-share-variant fs-5"></i>
                                    </span>
                                    <div>
                                        <h6 class="mb-0 fw-bold text-dark">{{ __('settings.social_media_section') }}</h6>
                                        <small class="text-muted">Facebook · X (Twitter) · Instagram · YouTube</small>
                                    </div>
                                </div>
                                <div class="card-body py-4">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <label class="form-label-premium">{!! __('settings.facebook') !!}</label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text"><i
                                                        class="mdi mdi-facebook text-primary"></i></span>
                                                <input type="text" id="facebook" name="facebook"
                                                    value="{!! old('facebook', setting()->facebook) !!}" class="form-control" autocomplete="off"
                                                    placeholder="{!! __('settings.enter_facebook') !!}">
                                            </div>
                                            <strong id="facebook_error" class="text-danger small"></strong>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label-premium">{!! __('settings.twitter') !!}</label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text"><i
                                                        class="mdi mdi-twitter text-info"></i></span>
                                                <input type="text" id="twitter" name="twitter"
                                                    value="{!! old('twitter', setting()->twitter) !!}" class="form-control" autocomplete="off"
                                                    placeholder="{!! __('settings.enter_twitter') !!}">
                                            </div>
                                            <strong id="twitter_error" class="text-danger small"></strong>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label-premium">{!! __('settings.instegram') !!}</label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text"><i
                                                        class="mdi mdi-instagram text-danger"></i></span>
                                                <input type="text" id="instegram" name="instegram"
                                                    value="{!! old('instegram', setting()->instegram) !!}" class="form-control"
                                                    autocomplete="off" placeholder="{!! __('settings.enter_instegram') !!}">
                                            </div>
                                            <strong id="instegram_error" class="text-danger small"></strong>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label-premium">{!! __('settings.youtube') !!}</label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text"><i
                                                        class="mdi mdi-youtube text-danger"></i></span>
                                                <input type="text" id="youtube" name="youtube"
                                                    value="{!! old('youtube', setting()->youtube) !!}" class="form-control"
                                                    autocomplete="off" placeholder="{!! __('settings.enter_youtube') !!}">
                                            </div>
                                            <strong id="youtube_error" class="text-danger small"></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ===== Section 3: Contact ===== --}}
                        <div class="col-12 theme-success">
                            <div class="card shadow-sm border-0 card-settings-premium">
                                <div class="card-header bg-white border-bottom d-flex align-items-center gap-2 py-3">
                                    <span class="settings-section-icon bg-success-subtle text-success rounded-2 p-2">
                                        <i class="mdi mdi-phone-outline fs-5"></i>
                                    </span>
                                    <div>
                                        <h6 class="mb-0 fw-bold text-dark">{{ __('settings.contact_section') }}</h6>
                                        <small class="text-muted">{{ __('settings.phone') }} ·
                                            {{ __('settings.email') }}</small>
                                    </div>
                                </div>
                                <div class="card-body py-4">
                                    <div class="row g-4">
                                        <div class="col-md-4">
                                            <label class="form-label-premium">{!! __('settings.phone') !!}</label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text"><i
                                                        class="mdi mdi-phone text-muted"></i></span>
                                                <input type="text" id="phone" name="phone"
                                                    value="{!! old('phone', setting()->phone) !!}" class="form-control"
                                                    autocomplete="off" placeholder="{!! __('settings.enter_phone') !!}">
                                            </div>
                                            <strong id="phone_error" class="text-danger small"></strong>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label-premium">{!! __('settings.mobile') !!}</label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text"><i
                                                        class="mdi mdi-cellphone text-muted"></i></span>
                                                <input type="text" id="mobile" name="mobile"
                                                    value="{!! old('mobile', setting()->mobile) !!}" class="form-control"
                                                    autocomplete="off" placeholder="{!! __('settings.enter_mobile') !!}">
                                            </div>
                                            <strong id="mobile_error" class="text-danger small"></strong>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label-premium">{!! __('settings.whatsapp') !!}</label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text"><i
                                                        class="mdi mdi-whatsapp text-success"></i></span>
                                                <input type="text" id="whatsapp" name="whatsapp"
                                                    value="{!! old('whatsapp', setting()->whatsapp) !!}" class="form-control"
                                                    autocomplete="off" placeholder="{!! __('settings.enter_whatsapp') !!}">
                                            </div>
                                            <strong id="whatsapp_error" class="text-danger small"></strong>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label-premium">{!! __('settings.email') !!}</label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text"><i
                                                        class="mdi mdi-email-outline text-muted"></i></span>
                                                <input type="text" id="email" name="email"
                                                    value="{!! old('email', setting()->email) !!}" class="form-control"
                                                    autocomplete="off" placeholder="{!! __('settings.enter_email') !!}">
                                            </div>
                                            <strong id="email_error" class="text-danger small"></strong>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label-premium">{!! __('settings.email_support') !!}</label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text"><i
                                                        class="mdi mdi-face-agent text-muted"></i></span>
                                                <input type="text" id="email_support" name="email_support"
                                                    value="{!! old('email_support', setting()->email_support) !!}" class="form-control"
                                                    autocomplete="off" placeholder="{!! __('settings.enter_email_support') !!}">
                                            </div>
                                            <strong id="email_support_error" class="text-danger small"></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ===== Section 4: Media ===== --}}
                        <div class="col-12 theme-warning">
                            <div class="card shadow-sm border-0 card-settings-premium">
                                <div class="card-header bg-white border-bottom d-flex align-items-center gap-2 py-3">
                                    <span class="settings-section-icon bg-warning-subtle text-warning rounded-2 p-2">
                                        <i class="mdi mdi-image-multiple-outline fs-5"></i>
                                    </span>
                                    <div>
                                        <h6 class="mb-0 fw-bold text-dark">{{ __('settings.media_section') }}</h6>
                                        <small class="text-muted">{{ __('settings.logo') }} ·
                                            {{ __('settings.favicon') }}</small>
                                    </div>
                                </div>
                                <div class="card-body py-4">
                                    <div class="row g-4">
                                        <!-- Logo Section -->
                                        <div class="col-md-6">
                                            <x-dashboard.file-input name="logo" id="logo_input"
                                                label="{!! __('settings.logo') !!}" placeholderIcon="mdi-image-outline"
                                                currentImageUrl="{{ setting()->logo ? asset('uploads/settings/' . setting()->logo) : null }}"
                                                isRequired="false" errorId="logo_error" />
                                        </div>
                                        <!-- Favicon Section -->
                                        <div class="col-md-6">
                                            <x-dashboard.file-input name="favicon" id="favicon_input"
                                                label="{!! __('settings.favicon') !!}" placeholderIcon="mdi-star-outline"
                                                currentImageUrl="{{ setting()->favicon ? asset('uploads/settings/' . setting()->favicon) : null }}"
                                                isRequired="false" errorId="favicon_error" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>{{-- end row --}}
                </form>

            </div>
        </div>
    </div>

    <x-dashboard.command-hud formId="settings_form" />
@endsection

@push('css')
@endpush

@push('scripts')
    <script type="text/javascript">
        // Initialize Floating Command HUD
        initHud('settings_form', {
            onDiscard: function(form) {
                // The global fix in fileinput.js handles this automatically on change,
                // but we trigger it explicitly here for maximum reliability.
                $(form).find('.fileinput-local-reset:not(.d-none)').click();
            }
        });

        window.handleFormSubmit('#settings_form', {
            url: function(form) {
                const settings_id = $("#id").val();
                return "{!! route('dashboard.settings.update', 'id') !!}".replace('id', settings_id);
            },
            successMessage: "{!! __('general.update_success_message') !!}",
            resetForm: false,
            onSuccess: function(data) {
                // Professional HUD Reset
                if (window.activeHud) {
                    window.activeHud.reset();
                }

                // Make the new images the permanent "original" ones
                if (data.data.logo) {
                    const logoUrl = "{{ asset('uploads/settings') }}/" + data.data.logo;
                    const $logoPreview = $('#logo_input_preview');
                    $logoPreview.find('img').attr('src', logoUrl);
                    $logoPreview.data('original-html',
                        `<img src="${logoUrl}" class="fileinput-current-img" style="width:100%; height:100%; object-fit:contain; background-color: #f8f9fa;">`
                    );
                    $('#reset_logo_input_btn').addClass('d-none');
                }

                if (data.data.favicon) {
                    const faviconUrl = "{{ asset('uploads/settings') }}/" + data.data.favicon;
                    const $faviconPreview = $('#favicon_input_preview');
                    $faviconPreview.find('img').attr('src', faviconUrl);
                    $faviconPreview.data('original-html',
                        `<img src="${faviconUrl}" class="fileinput-current-img" style="width:100%; height:100%; object-fit:contain; background-color: #f8f9fa;">`
                    );
                    $('#reset_favicon_input_btn').addClass('d-none');
                }

                // Sync Top Navbar Logos
                if (data.data.logo) {
                    var logoUrl = "{{ asset('uploads/settings') }}/" + data.data.logo;
                    $('#navbar_brand_logo').attr('src', logoUrl);
                }
                if (data.data.favicon) {
                    var faviconUrl = "{{ asset('uploads/settings') }}/" + data.data.favicon;
                    $('#navbar_brand_logo_mini').attr('src', faviconUrl);
                }
            }
        });
    </script>
@endpush
