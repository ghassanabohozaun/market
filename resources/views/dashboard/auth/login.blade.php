@extends('layouts.dashboard.auth')
@section('title')
    {!! __('dashboard.login') !!}
@endsection
@section('content')
    @php
        $currentLocale = Lang();
        $targetLocale = $currentLocale == 'ar' ? 'en' : 'ar';
        $targetNative = LaravelLocalization::getSupportedLocales()[$targetLocale]['native'];
    @endphp
    
    <div class="auth-premium-wrapper">
        <!-- Visual Presentation Side (Hidden on small screens) -->
        <div class="auth-visual-side">
            <div class="auth-visual-shape-1"></div>
            <div class="auth-visual-shape-2"></div>
            <div class="auth-visual-content">
                <h1 style="font-family: var(--font-serif);">{!! optional(setting())->getTranslation('site_name', Lang()) !!}</h1>
                <p>{!! __('auth.welcome_back') !!}. {!! __('dashboard.dashboard') !!}</p>
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
                        <img src="{!! asset('uploads/settings/' . optional(setting())->logo) !!}" alt="logo" class="auth-brand-logo">
                    </div>
                @endif

                <h2 class="auth-title">{!! __('auth.welcome_back') !!}</h2>
                <p class="auth-subtitle">{!! __('auth.sign_in_to_continue') !!}</p>

                @if (session('success'))
                    <div class="auth-alert auth-alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form id="loginForm" action="{!! route('dashboard.post.login') !!}" method="post" novalidate>
                    @csrf
                    
                    <div class="auth-input-group">
                        <label>{!! __('auth.email') !!}</label>
                        <div class="auth-input-wrapper">
                            <i class="mdi mdi-email-outline auth-input-icon"></i>
                            <input type="email" name="email" class="auth-input @error('email') is-invalid @enderror" placeholder="{!! __('auth.enter_email') !!}" autocomplete="off" value="{{ old('email') }}">
                        </div>
                        @error('email')
                            <span class="auth-error-text">{!! $message !!}</span>
                        @enderror
                    </div>

                    <div class="auth-input-group">
                        <label>{!! __('auth.password') !!}</label>
                        <div class="auth-input-wrapper">
                            <i class="mdi mdi-lock-outline auth-input-icon"></i>
                            <input type="password" name="password" id="auth-password" class="auth-input @error('password') is-invalid @enderror" placeholder="{!! __('auth.enter_password') !!}" autocomplete="new-password">
                            <button type="button" class="auth-password-toggle js-password-toggle">
                                <i class="mdi mdi-eye-outline"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="auth-error-text">{!! $message !!}</span>
                        @enderror
                    </div>

                    <div class="auth-options">
                        <label class="auth-checkbox">
                            <input type="checkbox" name="remmber">
                            <span>{!! __('auth.remmber_me') !!}</span>
                        </label>
                        <a href="{{ route('dashboard.password.get.email') }}" class="auth-link">{!! __('auth.forget_password') !!}</a>
                    </div>

                    <button type="submit" class="auth-btn-submit">
                        <i class="mdi mdi-login-variant"></i>
                        {!! __('auth.login') !!}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Specific minimal JS for toggling password inside auth-premium context
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtns = document.querySelectorAll('.js-password-toggle');
        toggleBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const input = this.parentElement.querySelector('input[type="password"], input[type="text"]');
                const icon = this.querySelector('i');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('mdi-eye-outline');
                    icon.classList.add('mdi-eye-off-outline');
                } else {
                    input.type = 'password';
                    icon.classList.remove('mdi-eye-off-outline');
                    icon.classList.add('mdi-eye-outline');
                }
            });
        });
    });
</script>
@endpush
