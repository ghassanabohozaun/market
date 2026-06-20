<li class="nav-item dropdown" wire:poll.10s="loadNotifications">
    <a class="nav-link count-indicator position-relative" id="notificationDropdown" href="#"
        data-bs-toggle="dropdown">
        <i class="icon-bell"></i>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($unreadCount > 0): ?>
            <span class="notification-badge badge rounded-pill bg-danger border border-white">
                <?php echo e($unreadCount > 99 ? '99+' : $unreadCount); ?>

            </span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </a>
    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0 shadow-sm border-0"
        aria-labelledby="notificationDropdown" style="min-width: 320px;">
        <div class="dropdown-item py-3 border-bottom d-flex justify-content-between align-items-center">
            <p class="mb-0 fw-medium text-dark" style="font-size: 0.8rem;">
                <?php echo e(__('navbar.notifications_summary', ['count' => $unreadCount])); ?></p>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($unreadCount > 0): ?>
                <span wire:click.stop="markAllAsRead" class="badge badge-pill badge-primary"
                    style="cursor: pointer; font-size: 0.65rem;"><?php echo e(__('navbar.mark_all_read')); ?></span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div style="max-height: 350px; overflow-y: auto;">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <a wire:click="markAsRead('<?php echo e($notification->id); ?>')"
                    class="dropdown-item preview-item py-3 border-bottom d-flex align-items-center"
                    href="<?php echo e(route('dashboard.products.edit', $notification->data['product_id'])); ?>">
                    <div class="preview-thumbnail">
                        <i class="mdi mdi-alert-circle m-auto <?php echo e(!$notification->read_at ? 'text-danger' : 'text-muted'); ?>"
                            style="font-size: 1.25rem;"></i>
                    </div>
                    <div
                        class="preview-item-content ms-3 me-3 d-flex flex-column align-items-start justify-content-center w-100">
                        <h6 class="preview-subject <?php echo e(!$notification->read_at ? 'fw-bold text-dark' : 'text-muted'); ?> mb-1 text-start"
                            style="font-size: 0.75rem; white-space: normal; line-height: 1.4;">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($notification->data['message_key'])): ?>
                                <?php echo e(__($notification->data['message_key'],collect($notification->data['message_params'] ?? [])->map(fn($v) => is_string($v) && str_starts_with($v, 'notifications.') ? __($v) : $v)->toArray())); ?>

                            <?php else: ?>
                                <?php echo e($notification->data['message'] ?? __('notifications.notification')); ?>

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </h6>
                        <p class="fw-light mb-0 text-muted text-start" style="font-size: 0.65rem;">
                            <?php echo e($notification->created_at->diffForHumans()); ?> </p>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="dropdown-item preview-item py-4 border-bottom">
                    <div class="preview-item-content text-center w-100">
                        <p class="fw-medium mb-0 text-muted" style="font-size: 0.75rem;">
                            <?php echo e(__('notifications.no_new_notifications')); ?> </p>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</li>
<?php /**PATH C:\laragon\www\market\resources\views/livewire/dashboard/notifications.blade.php ENDPATH**/ ?>