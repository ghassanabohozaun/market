@extends('layouts.dashboard.auth')
@section('title')
    {!! __('auth.verify_otp') !!}
@endsection
@section('content')
    @php
        $currentLocale = LaravelLocalization::getCurrentLocale();
        $targetLocale = $currentLocale == 'ar' ? 'en' : 'ar';
        $targetNative = LaravelLocalization::getSupportedLocales()[$targetLocale]['native'];
    @endphp
    
    <div class="auth-premium-wrapper">
        <!-- Visual Presentation Side -->
        <div class="auth-visual-side">
            <div class="auth-visual-shape-1"></div>
            <div class="auth-visual-shape-2"></div>
            <div class="auth-visual-content">
                <h1 style="font-family: var(--font-serif);">{!! optional(setting())->getTranslation('site_name', Lang()) !!}</h1>
                <p>{!! __('auth.verify_otp') !!}</p>
            </div>
        </div>

        <!-- Form Interaction Side -->
        <div class="auth-form-side">
            <a href="{{ LaravelLocalization::getLocalizedURL($targetLocale, null, [], true) }}" class="auth-lang-switcher">
                <i class="mdi mdi-web"></i>
                <span>{{ $targetNative }}</span>
            </a>

            <!-- Glassmorphism Form Card -->
            <div class="auth-card-glass">
                @if (optional(setting())->logo)
                    <div class="auth-logo-wrapper">
                        <img src="{{ asset('uploads/settings/' . optional(setting())->logo) }}" alt="logo" class="auth-brand-logo">
                    </div>
                @endif
                
                <h2 class="auth-title">{!! __('auth.verify_otp') !!}</h2>
                <p class="auth-subtitle">{!! __('auth.enter_otp_code_sent_to_email') !!}</p>

                @if ($errors->has('error'))
                    <div class="auth-alert auth-alert-danger">
                        {!! $errors->first('error') !!}
                    </div>
                @endif

                <form action="{!! route('dashboard.password.post.verify') !!}" method="post" novalidate>
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">

                    <div class="auth-input-group">
                        <label class="text-center w-100">{!! __('auth.verify_otp') !!}</label>
                        <div class="auth-input-wrapper">
                            <input type="text" name="code" class="auth-input text-center fw-bold @error('code') is-invalid @enderror" placeholder="######" maxlength="6" autocomplete="off" required style="font-size: 2rem !important; letter-spacing: 0.5rem; height: 70px; padding: 0;">
                        </div>
                        @error('code')
                            <span class="auth-error-text text-center mt-2">{!! $message !!}</span>
                        @enderror
                    </div>

                    <button type="submit" class="auth-btn-submit mb-4 mt-2">
                        <i class="mdi mdi-shield-check-outline"></i>
                        {!! __('auth.verify') !!}
                    </button>

                    <div class="text-center">
                        <a href="{{ route('dashboard.password.get.email') }}" class="auth-link">
                            <i class="mdi mdi-refresh"></i> {!! __('auth.resend_otp') !!}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
