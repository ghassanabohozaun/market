<?php $__env->startSection('title'); ?>
    <?php echo __('dashboard.login'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php
        $currentLocale = Lang();
        $targetLocale = $currentLocale == 'ar' ? 'en' : 'ar';
        $targetNative = LaravelLocalization::getSupportedLocales()[$targetLocale]['native'];
    ?>
    
    <div class="auth-premium-wrapper">
        <!-- Visual Presentation Side (Hidden on small screens) -->
        <div class="auth-visual-side">
            <div class="auth-visual-shape-1"></div>
            <div class="auth-visual-shape-2"></div>
            <div class="auth-visual-content">
                <h1 style="font-family: var(--font-serif);"><?php echo optional(setting())->getTranslation('site_name', Lang()); ?></h1>
                <p><?php echo __('auth.welcome_back'); ?>. <?php echo __('dashboard.dashboard'); ?></p>
            </div>
        </div>

        <!-- Form Interaction Side -->
        <div class="auth-form-side">
            <a href="<?php echo e(LaravelLocalization::getLocalizedURL($targetLocale, null, [], true)); ?>" class="auth-lang-switcher">
                <i class="mdi mdi-web"></i>
                <span><?php echo e($targetNative); ?></span>
            </a>

            <!-- Glassmorphism Form Card -->
            <div class="auth-card-glass">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(optional(setting())->logo): ?>
                    <div class="auth-logo-wrapper">
                        <img src="<?php echo asset('uploads/settings/' . optional(setting())->logo); ?>" alt="logo" class="auth-brand-logo">
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <h2 class="auth-title"><?php echo __('auth.welcome_back'); ?></h2>
                <p class="auth-subtitle"><?php echo __('auth.sign_in_to_continue'); ?></p>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
                    <div class="auth-alert auth-alert-success">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <form id="loginForm" action="<?php echo route('dashboard.post.login'); ?>" method="post" novalidate>
                    <?php echo csrf_field(); ?>
                    
                    <div class="auth-input-group">
                        <label><?php echo __('auth.email'); ?></label>
                        <div class="auth-input-wrapper">
                            <i class="mdi mdi-email-outline auth-input-icon"></i>
                            <input type="email" name="email" class="auth-input <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="<?php echo __('auth.enter_email'); ?>" autocomplete="off" value="<?php echo e(old('email')); ?>">
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="auth-error-text"><?php echo $message; ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div class="auth-input-group">
                        <label><?php echo __('auth.password'); ?></label>
                        <div class="auth-input-wrapper">
                            <i class="mdi mdi-lock-outline auth-input-icon"></i>
                            <input type="password" name="password" id="auth-password" class="auth-input <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="<?php echo __('auth.enter_password'); ?>" autocomplete="new-password">
                            <button type="button" class="auth-password-toggle js-password-toggle">
                                <i class="mdi mdi-eye-outline"></i>
                            </button>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="auth-error-text"><?php echo $message; ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div class="auth-options">
                        <label class="auth-checkbox">
                            <input type="checkbox" name="remmber">
                            <span><?php echo __('auth.remmber_me'); ?></span>
                        </label>
                        <a href="<?php echo e(route('dashboard.password.get.email')); ?>" class="auth-link"><?php echo __('auth.forget_password'); ?></a>
                    </div>

                    <button type="submit" class="auth-btn-submit">
                        <i class="mdi mdi-login-variant"></i>
                        <?php echo __('auth.login'); ?>

                    </button>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.dashboard.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\market\resources\views/dashboard/auth/login.blade.php ENDPATH**/ ?>