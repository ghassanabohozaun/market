@extends('layouts.dashboard.auth')
@section('title')
    {!! __('auth.enter_email') !!}
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
                <p>{!! __('auth.recover_password') !!}</p>
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
                
                <h2 class="auth-title">{!! __('auth.recover_password') !!}</h2>
                <p class="auth-subtitle">{!! __('auth.enter_email_to_recover_password') !!}</p>

                @if ($errors->has('error'))
                    <div class="auth-alert auth-alert-danger">
                        {!! $errors->first('error') !!}
                    </div>
                @endif

                <form action="{!! route('dashboard.password.post.email') !!}" method="post" novalidate>
                    @csrf
                    <div class="auth-input-group">
                        <label>{!! __('auth.email') !!}</label>
                        <div class="auth-input-wrapper">
                            <i class="mdi mdi-email-open-outline auth-input-icon"></i>
                            <input type="email" name="email" class="auth-input @error('email') is-invalid @enderror" placeholder="{!! __('auth.enter_email') !!}" autocomplete="off" value="{{ old('email') }}">
                        </div>
                        @error('email')
                            <span class="auth-error-text">{!! $message !!}</span>
                        @enderror
                    </div>

                    <button type="submit" class="auth-btn-submit mb-4 mt-2">
                        <i class="mdi mdi-email-fast-outline"></i>
                        {!! __('auth.send_otp') !!}
                    </button>

                    <div class="text-center">
                        <a href="{{ route('dashboard.get.login') }}" class="auth-link">
                            <i class="mdi mdi-arrow-left"></i> {!! __('auth.back_to_login') !!}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
