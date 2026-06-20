<?php $__env->startSection('title'); ?>
    <?php echo __('dashboard.lock_screen'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php
        $currentLocale = Lang();
        $targetLocale = $currentLocale == 'ar' ? 'en' : 'ar';
        $targetNative = LaravelLocalization::getSupportedLocales()[$targetLocale]['native'];
    ?>
    
    <div class="auth-premium-wrapper">
        <!-- Visual Presentation Side -->
        <div class="auth-visual-side">
            <div class="auth-visual-shape-1"></div>
            <div class="auth-visual-shape-2"></div>
            <div class="auth-visual-content">
                <h1 style="font-family: var(--font-serif);"><?php echo optional(setting())->getTranslation('site_name', Lang()); ?></h1>
                <p><?php echo __('dashboard.lock_screen'); ?></p>
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
                
                <?php
                    $user = admin()->user();
                    $userPhoto = $user && $user->photo
                        ? asset('uploads/adminsPhotos/' . $user->photo)
                        : asset('assets/dashboard/images/faces/avatar-male.jpg');
                ?>
                
                <div class="auth-avatar-wrapper">
                    <img src="<?php echo e($userPhoto); ?>" class="auth-avatar" alt="User Avatar">
                    <div class="auth-status-badge" title="Identity Verified"></div>
                </div>

                <h2 class="auth-title"><?php echo e($user ? $user->getTranslation('name', Lang()) : 'Admin'); ?></h2>
                <p class="auth-subtitle text-success"><?php echo e(__('dashboard.active_session') ?? 'Active Secured Session'); ?></p>

                <form id="lock-form" action="<?php echo e(route('dashboard.unlock.screen')); ?>" method="POST" novalidate>
                    <?php echo csrf_field(); ?>
                    
                    <div class="auth-input-group">
                        <label><?php echo __('auth.password'); ?></label>
                        <div class="auth-input-wrapper">
                            <i class="mdi mdi-shield-lock-outline auth-input-icon"></i>
                            <input type="password" name="password" id="lock-password" class="auth-input" placeholder="<?php echo e(__('auth.password')); ?>" autocomplete="off">
                            <button type="button" class="auth-password-toggle js-password-toggle">
                                <i class="mdi mdi-eye-outline"></i>
                            </button>
                        </div>
                        <span id="lock-error" class="auth-error-text d-none"></span>
                    </div>

                    <button type="submit" id="unlock-btn" class="auth-btn-submit mb-4">
                        <i class="mdi mdi-key"></i>
                        <?php echo e(__('auth.unlock')); ?>

                    </button>

                    <div class="text-center">
                        <a href="<?php echo e(route('dashboard.get.login')); ?>" class="auth-link">
                            <i class="mdi mdi-account-switch-outline"></i>
                            <?php echo e(__('auth.sign_in_different_account')); ?>

                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        window.Translations = {
            routes: {
                lock_screen: "<?php echo e(route('dashboard.lock.screen')); ?>",
                unlock_screen: "<?php echo e(route('dashboard.unlock.screen')); ?>",
                dashboard_index: "<?php echo e(route('dashboard.index')); ?>"
            },
            labels: {
                unlock: "<?php echo e(__('auth.unlock')); ?>"
            },
            messages: {
                error: "<?php echo e(__('general.error')); ?>",
                success: "<?php echo e(__('general.success')); ?>",
                failed: "<?php echo e(__('auth.failed')); ?>",
                unlock_success: "<?php echo e(__('auth.unlock_success')); ?>"
            }
        };
    </script>
    <script src="<?php echo asset('assets/dashboard/js/lock-screen.js'); ?>"></script>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.dashboard.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\market\resources\views/dashboard/auth/lock-screen.blade.php ENDPATH**/ ?>