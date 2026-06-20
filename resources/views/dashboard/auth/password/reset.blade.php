@extends('layouts.dashboard.auth')
@section('title')
    {!! __('auth.reset_password') !!}
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
                <p>{!! __('auth.reset_password') !!}</p>
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
                
                <h2 class="auth-title">{!! __('auth.reset_password') !!}</h2>
                <p class="auth-subtitle">{!! __('auth.enter_new_password_below') !!}</p>

                @if ($errors->has('error'))
                    <div class="auth-alert auth-alert-danger">
                        {!! $errors->first('error') !!}
                    </div>
                @endif

                <form action="{!! route('dashboard.password.post.reset') !!}" method="post" novalidate>
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">

                    <div class="auth-input-group">
                        <label>{!! __('auth.new_password') !!}</label>
                        <div class="auth-input-wrapper">
                            <i class="mdi mdi-lock-reset auth-input-icon"></i>
                            <input type="password" name="password" class="auth-input @error('password') is-invalid @enderror" placeholder="{!! __('auth.enter_new_password') !!}" autocomplete="new-password">
                            <button type="button" class="auth-password-toggle js-password-toggle">
                                <i class="mdi mdi-eye-outline"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="auth-error-text">{!! $message !!}</span>
                        @enderror
                    </div>

                    <div class="auth-input-group">
                        <label>{!! __('auth.confirm_password') !!}</label>
                        <div class="auth-input-wrapper">
                            <i class="mdi mdi-lock-check-outline auth-input-icon"></i>
                            <input type="password" name="password_confirmation" class="auth-input" placeholder="{!! __('auth.confirm_new_password') !!}" autocomplete="new-password">
                            <button type="button" class="auth-password-toggle js-password-toggle">
                                <i class="mdi mdi-eye-outline"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="auth-btn-submit mb-2 mt-4">
                        <i class="mdi mdi-lock-reset"></i>
                        {!! __('auth.reset_password') !!}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
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
