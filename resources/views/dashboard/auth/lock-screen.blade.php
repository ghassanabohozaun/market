@extends('layouts.dashboard.auth')
@section('title')
    {!! __('dashboard.lock_screen') !!}
@endsection
@section('content')
    @php
        $currentLocale = Lang();
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
                <p>{!! __('dashboard.lock_screen') !!}</p>
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
                
                @php
                    $user = admin()->user();
                    $userPhoto = $user && $user->photo
                        ? asset('uploads/adminsPhotos/' . $user->photo)
                        : asset('assets/dashboard/images/faces/avatar-male.jpg');
                @endphp
                
                <div class="auth-avatar-wrapper">
                    <img src="{{ $userPhoto }}" class="auth-avatar" alt="User Avatar">
                    <div class="auth-status-badge" title="Identity Verified"></div>
                </div>

                <h2 class="auth-title">{{ $user ? $user->getTranslation('name', Lang()) : 'Admin' }}</h2>
                <p class="auth-subtitle text-success">{{ __('dashboard.active_session') ?? 'Active Secured Session' }}</p>

                <form id="lock-form" action="{{ route('dashboard.unlock.screen') }}" method="POST" novalidate>
                    @csrf
                    
                    <div class="auth-input-group">
                        <label>{!! __('auth.password') !!}</label>
                        <div class="auth-input-wrapper">
                            <i class="mdi mdi-shield-lock-outline auth-input-icon"></i>
                            <input type="password" name="password" id="lock-password" class="auth-input" placeholder="{{ __('auth.password') }}" autocomplete="off">
                            <button type="button" class="auth-password-toggle js-password-toggle">
                                <i class="mdi mdi-eye-outline"></i>
                            </button>
                        </div>
                        <span id="lock-error" class="auth-error-text d-none"></span>
                    </div>

                    <button type="submit" id="unlock-btn" class="auth-btn-submit mb-4">
                        <i class="mdi mdi-key"></i>
                        {{ __('auth.unlock') }}
                    </button>

                    <div class="text-center">
                        <a href="{{ route('dashboard.get.login') }}" class="auth-link">
                            <i class="mdi mdi-account-switch-outline"></i>
                            {{ __('auth.sign_in_different_account') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        window.Translations = {
            routes: {
                lock_screen: "{{ route('dashboard.lock.screen') }}",
                unlock_screen: "{{ route('dashboard.unlock.screen') }}",
                dashboard_index: "{{ route('dashboard.index') }}"
            },
            labels: {
                unlock: "{{ __('auth.unlock') }}"
            },
            messages: {
                error: "{{ __('general.error') }}",
                success: "{{ __('general.success') }}",
                failed: "{{ __('auth.failed') }}",
                unlock_success: "{{ __('auth.unlock_success') }}"
            }
        };
    </script>
    <script src="{!! asset('assets/dashboard/js/lock-screen.js') !!}"></script>
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
