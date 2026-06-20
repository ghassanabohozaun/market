<?php $__env->startSection('title'); ?>
    <?php echo $title; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">

                
                <div class="d-md-flex align-items-center justify-content-between border-bottom mb-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?php echo e(route('dashboard.index')); ?>"><?php echo __('dashboard.dashboard'); ?></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo __('settings.settings'); ?></li>
                        </ol>
                    </nav>


                </div>

                <form id="settings_form" action="" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <input type="hidden" id='id' name="id" value="<?php echo setting()->id; ?>">

                    <div class="row g-4 mb-5">

                        
                        <div class="col-12 theme-primary">
                            <div class="card shadow-sm border-0 card-settings-premium">
                                <div class="card-header bg-white border-bottom d-flex align-items-center gap-2 py-3">
                                    <span class="settings-section-icon bg-primary-subtle text-primary rounded-2 p-2">
                                        <i class="mdi mdi-web fs-5"></i>
                                    </span>
                                    <div>
                                        <h6 class="mb-0 fw-bold text-dark"><?php echo e(__('settings.basic_settings_section')); ?></h6>
                                        <small class="text-muted"><?php echo e(__('settings.site_name_ar')); ?> /
                                            <?php echo e(__('settings.site_name_en')); ?></small>
                                    </div>
                                </div>
                                <div class="card-body py-4">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <label class="form-label-premium"><?php echo __('settings.site_name_ar'); ?> <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text"><i
                                                        class="mdi mdi-translate text-primary"></i></span>
                                                <input type="text" id="site_name_ar" name="site_name[ar]"
                                                    value="<?php echo old('site_name.ar', setting()->getTranslation('site_name', 'ar')); ?>" class="form-control" autocomplete="off"
                                                    placeholder="<?php echo __('settings.enter_site_name_ar'); ?>">
                                            </div>
                                            <strong id="site_name_ar_error" class="text-danger small"></strong>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label-premium"><?php echo __('settings.site_name_en'); ?> <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text"><i
                                                        class="mdi mdi-alpha-e-box-outline text-primary"></i></span>
                                                <input type="text" id="site_name_en" name="site_name[en]"
                                                    value="<?php echo old('site_name.en', setting()->getTranslation('site_name', 'en')); ?>" class="form-control" autocomplete="off"
                                                    placeholder="<?php echo __('settings.enter_site_name_en'); ?>">
                                            </div>
                                            <strong id="site_name_en_error" class="text-danger small"></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-12 theme-secondary">
                            <div class="card shadow-sm border-0 card-settings-premium">
                                <div class="card-header bg-white border-bottom d-flex align-items-center gap-2 py-3">
                                    <span class="settings-section-icon bg-secondary-subtle text-secondary rounded-2 p-2">
                                        <i class="mdi mdi-magnify fs-5"></i>
                                    </span>
                                    <div>
                                        <h6 class="mb-0 fw-bold text-dark"><?php echo e(__('settings.seo_section')); ?></h6>
                                        <small class="text-muted"><?php echo e(__('settings.description_ar')); ?> / <?php echo e(__('settings.description_en')); ?> · <?php echo e(__('settings.keywords_ar')); ?> / <?php echo e(__('settings.keywords_en')); ?></small>
                                    </div>
                                </div>
                                <div class="card-body py-4">
                                    <div class="row g-4">
                                        <!-- Description AR -->
                                        <div class="col-md-6">
                                            <label class="form-label-premium"><?php echo __('settings.description_ar'); ?></label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text align-items-start pt-2"><i class="mdi mdi-text text-primary"></i></span>
                                                <textarea id="description_ar" name="description[ar]" class="form-control" rows="5" placeholder="<?php echo __('settings.enter_description_ar'); ?>"><?php echo old('description.ar', setting()->getTranslation('description', 'ar')); ?></textarea>
                                            </div>
                                            <strong id="description_ar_error" class="text-danger small"></strong>
                                        </div>
                                        <!-- Description EN -->
                                        <div class="col-md-6">
                                            <label class="form-label-premium"><?php echo __('settings.description_en'); ?></label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text align-items-start pt-2"><i class="mdi mdi-alphabet-latin text-primary"></i></span>
                                                <textarea id="description_en" name="description[en]" class="form-control" rows="5" placeholder="<?php echo __('settings.enter_description_en'); ?>"><?php echo old('description.en', setting()->getTranslation('description', 'en')); ?></textarea>
                                            </div>
                                            <strong id="description_en_error" class="text-danger small"></strong>
                                        </div>
                                        <!-- Keywords AR -->
                                        <div class="col-md-6">
                                            <label class="form-label-premium"><?php echo __('settings.keywords_ar'); ?></label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text align-items-start pt-2"><i class="mdi mdi-tag-multiple text-primary"></i></span>
                                                <textarea id="keywords_ar" name="keywords[ar]" class="form-control" rows="5" placeholder="<?php echo __('settings.enter_keywords_ar'); ?>"><?php echo old('keywords.ar', setting()->getTranslation('keywords', 'ar')); ?></textarea>
                                            </div>
                                            <strong id="keywords_ar_error" class="text-danger small"></strong>
                                        </div>
                                        <!-- Keywords EN -->
                                        <div class="col-md-6">
                                            <label class="form-label-premium"><?php echo __('settings.keywords_en'); ?></label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text align-items-start pt-2"><i class="mdi mdi-tag-multiple-outline text-primary"></i></span>
                                                <textarea id="keywords_en" name="keywords[en]" class="form-control" rows="5" placeholder="<?php echo __('settings.enter_keywords_en'); ?>"><?php echo old('keywords.en', setting()->getTranslation('keywords', 'en')); ?></textarea>
                                            </div>
                                            <strong id="keywords_en_error" class="text-danger small"></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-12 theme-primary">
                            <div class="card shadow-sm border-0 card-settings-premium">
                                <div class="card-header bg-white border-bottom d-flex align-items-center gap-2 py-3">
                                    <span class="settings-section-icon bg-primary-subtle text-primary rounded-2 p-2">
                                        <i class="mdi mdi-map-marker fs-5"></i>
                                    </span>
                                    <div>
                                        <h6 class="mb-0 fw-bold text-dark"><?php echo e(__('settings.address_section')); ?></h6>
                                        <small class="text-muted"><?php echo e(__('settings.address_ar')); ?> / <?php echo e(__('settings.address_en')); ?></small>
                                    </div>
                                </div>
                                <div class="card-body py-4">
                                    <div class="row g-4">
                                        <!-- Address AR -->
                                        <div class="col-md-6">
                                            <label class="form-label-premium"><?php echo __('settings.address_ar'); ?></label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text"><i class="mdi mdi-map-marker text-primary"></i></span>
                                                <input type="text" id="address_ar" name="address[ar]"
                                                    value="<?php echo old('address.ar', setting()->getTranslation('address', 'ar')); ?>" class="form-control" autocomplete="off"
                                                    placeholder="<?php echo __('settings.enter_address_ar'); ?>">
                                            </div>
                                            <strong id="address_ar_error" class="text-danger small"></strong>
                                        </div>
                                        <!-- Address EN -->
                                        <div class="col-md-6">
                                            <label class="form-label-premium"><?php echo __('settings.address_en'); ?></label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text"><i class="mdi mdi-map-marker-outline text-primary"></i></span>
                                                <input type="text" id="address_en" name="address[en]"
                                                    value="<?php echo old('address.en', setting()->getTranslation('address', 'en')); ?>" class="form-control" autocomplete="off"
                                                    placeholder="<?php echo __('settings.enter_address_en'); ?>">
                                            </div>
                                            <strong id="address_en_error" class="text-danger small"></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-12 theme-info">
                            <div class="card shadow-sm border-0 card-settings-premium">
                                <div class="card-header bg-white border-bottom d-flex align-items-center gap-2 py-3">
                                    <span class="settings-section-icon bg-info-subtle text-info rounded-2 p-2">
                                        <i class="mdi mdi-share-variant fs-5"></i>
                                    </span>
                                    <div>
                                        <h6 class="mb-0 fw-bold text-dark"><?php echo e(__('settings.social_media_section')); ?></h6>
                                        <small class="text-muted">Facebook · X (Twitter) · Instagram · YouTube</small>
                                    </div>
                                </div>
                                <div class="card-body py-4">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <label class="form-label-premium"><?php echo __('settings.facebook'); ?></label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text"><i
                                                        class="mdi mdi-facebook text-primary"></i></span>
                                                <input type="text" id="facebook" name="facebook"
                                                    value="<?php echo old('facebook', setting()->facebook); ?>" class="form-control" autocomplete="off"
                                                    placeholder="<?php echo __('settings.enter_facebook'); ?>">
                                            </div>
                                            <strong id="facebook_error" class="text-danger small"></strong>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label-premium"><?php echo __('settings.twitter'); ?></label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text"><i
                                                        class="mdi mdi-twitter text-info"></i></span>
                                                <input type="text" id="twitter" name="twitter"
                                                    value="<?php echo old('twitter', setting()->twitter); ?>" class="form-control" autocomplete="off"
                                                    placeholder="<?php echo __('settings.enter_twitter'); ?>">
                                            </div>
                                            <strong id="twitter_error" class="text-danger small"></strong>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label-premium"><?php echo __('settings.instegram'); ?></label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text"><i
                                                        class="mdi mdi-instagram text-danger"></i></span>
                                                <input type="text" id="instegram" name="instegram"
                                                    value="<?php echo old('instegram', setting()->instegram); ?>" class="form-control"
                                                    autocomplete="off" placeholder="<?php echo __('settings.enter_instegram'); ?>">
                                            </div>
                                            <strong id="instegram_error" class="text-danger small"></strong>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label-premium"><?php echo __('settings.youtube'); ?></label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text"><i
                                                        class="mdi mdi-youtube text-danger"></i></span>
                                                <input type="text" id="youtube" name="youtube"
                                                    value="<?php echo old('youtube', setting()->youtube); ?>" class="form-control"
                                                    autocomplete="off" placeholder="<?php echo __('settings.enter_youtube'); ?>">
                                            </div>
                                            <strong id="youtube_error" class="text-danger small"></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-12 theme-success">
                            <div class="card shadow-sm border-0 card-settings-premium">
                                <div class="card-header bg-white border-bottom d-flex align-items-center gap-2 py-3">
                                    <span class="settings-section-icon bg-success-subtle text-success rounded-2 p-2">
                                        <i class="mdi mdi-phone-outline fs-5"></i>
                                    </span>
                                    <div>
                                        <h6 class="mb-0 fw-bold text-dark"><?php echo e(__('settings.contact_section')); ?></h6>
                                        <small class="text-muted"><?php echo e(__('settings.phone')); ?> ·
                                            <?php echo e(__('settings.email')); ?></small>
                                    </div>
                                </div>
                                <div class="card-body py-4">
                                    <div class="row g-4">
                                        <div class="col-md-4">
                                            <label class="form-label-premium"><?php echo __('settings.phone'); ?></label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text"><i
                                                        class="mdi mdi-phone text-muted"></i></span>
                                                <input type="text" id="phone" name="phone"
                                                    value="<?php echo old('phone', setting()->phone); ?>" class="form-control"
                                                    autocomplete="off" placeholder="<?php echo __('settings.enter_phone'); ?>">
                                            </div>
                                            <strong id="phone_error" class="text-danger small"></strong>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label-premium"><?php echo __('settings.mobile'); ?></label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text"><i
                                                        class="mdi mdi-cellphone text-muted"></i></span>
                                                <input type="text" id="mobile" name="mobile"
                                                    value="<?php echo old('mobile', setting()->mobile); ?>" class="form-control"
                                                    autocomplete="off" placeholder="<?php echo __('settings.enter_mobile'); ?>">
                                            </div>
                                            <strong id="mobile_error" class="text-danger small"></strong>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label-premium"><?php echo __('settings.whatsapp'); ?></label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text"><i
                                                        class="mdi mdi-whatsapp text-success"></i></span>
                                                <input type="text" id="whatsapp" name="whatsapp"
                                                    value="<?php echo old('whatsapp', setting()->whatsapp); ?>" class="form-control"
                                                    autocomplete="off" placeholder="<?php echo __('settings.enter_whatsapp'); ?>">
                                            </div>
                                            <strong id="whatsapp_error" class="text-danger small"></strong>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label-premium"><?php echo __('settings.email'); ?></label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text"><i
                                                        class="mdi mdi-email-outline text-muted"></i></span>
                                                <input type="text" id="email" name="email"
                                                    value="<?php echo old('email', setting()->email); ?>" class="form-control"
                                                    autocomplete="off" placeholder="<?php echo __('settings.enter_email'); ?>">
                                            </div>
                                            <strong id="email_error" class="text-danger small"></strong>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label-premium"><?php echo __('settings.email_support'); ?></label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text"><i
                                                        class="mdi mdi-face-agent text-muted"></i></span>
                                                <input type="text" id="email_support" name="email_support"
                                                    value="<?php echo old('email_support', setting()->email_support); ?>" class="form-control"
                                                    autocomplete="off" placeholder="<?php echo __('settings.enter_email_support'); ?>">
                                            </div>
                                            <strong id="email_support_error" class="text-danger small"></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-12 theme-warning">
                            <div class="card shadow-sm border-0 card-settings-premium">
                                <div class="card-header bg-white border-bottom d-flex align-items-center gap-2 py-3">
                                    <span class="settings-section-icon bg-warning-subtle text-warning rounded-2 p-2">
                                        <i class="mdi mdi-image-multiple-outline fs-5"></i>
                                    </span>
                                    <div>
                                        <h6 class="mb-0 fw-bold text-dark"><?php echo e(__('settings.media_section')); ?></h6>
                                        <small class="text-muted"><?php echo e(__('settings.logo')); ?> ·
                                            <?php echo e(__('settings.favicon')); ?></small>
                                    </div>
                                </div>
                                <div class="card-body py-4">
                                    <div class="row g-4">
                                        <!-- Logo Section -->
                                        <div class="col-md-6">
                                            <?php if (isset($component)) { $__componentOriginal9a0a8193654716494d8e7ad9515459d4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a0a8193654716494d8e7ad9515459d4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard.file-input','data' => ['name' => 'logo','id' => 'logo_input','label' => ''.__('settings.logo').'','placeholderIcon' => 'mdi-image-outline','currentImageUrl' => ''.e(setting()->logo ? asset('uploads/settings/' . setting()->logo) : null).'','isRequired' => 'false','errorId' => 'logo_error']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard.file-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'logo','id' => 'logo_input','label' => ''.__('settings.logo').'','placeholderIcon' => 'mdi-image-outline','currentImageUrl' => ''.e(setting()->logo ? asset('uploads/settings/' . setting()->logo) : null).'','isRequired' => 'false','errorId' => 'logo_error']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9a0a8193654716494d8e7ad9515459d4)): ?>
<?php $attributes = $__attributesOriginal9a0a8193654716494d8e7ad9515459d4; ?>
<?php unset($__attributesOriginal9a0a8193654716494d8e7ad9515459d4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9a0a8193654716494d8e7ad9515459d4)): ?>
<?php $component = $__componentOriginal9a0a8193654716494d8e7ad9515459d4; ?>
<?php unset($__componentOriginal9a0a8193654716494d8e7ad9515459d4); ?>
<?php endif; ?>
                                        </div>
                                        <!-- Favicon Section -->
                                        <div class="col-md-6">
                                            <?php if (isset($component)) { $__componentOriginal9a0a8193654716494d8e7ad9515459d4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a0a8193654716494d8e7ad9515459d4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard.file-input','data' => ['name' => 'favicon','id' => 'favicon_input','label' => ''.__('settings.favicon').'','placeholderIcon' => 'mdi-star-outline','currentImageUrl' => ''.e(setting()->favicon ? asset('uploads/settings/' . setting()->favicon) : null).'','isRequired' => 'false','errorId' => 'favicon_error']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard.file-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'favicon','id' => 'favicon_input','label' => ''.__('settings.favicon').'','placeholderIcon' => 'mdi-star-outline','currentImageUrl' => ''.e(setting()->favicon ? asset('uploads/settings/' . setting()->favicon) : null).'','isRequired' => 'false','errorId' => 'favicon_error']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9a0a8193654716494d8e7ad9515459d4)): ?>
<?php $attributes = $__attributesOriginal9a0a8193654716494d8e7ad9515459d4; ?>
<?php unset($__attributesOriginal9a0a8193654716494d8e7ad9515459d4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9a0a8193654716494d8e7ad9515459d4)): ?>
<?php $component = $__componentOriginal9a0a8193654716494d8e7ad9515459d4; ?>
<?php unset($__componentOriginal9a0a8193654716494d8e7ad9515459d4); ?>
<?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </form>

            </div>
        </div>
    </div>

    <?php if (isset($component)) { $__componentOriginal3538477eb67f181dd8c1abfba3a6ad25 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3538477eb67f181dd8c1abfba3a6ad25 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard.command-hud','data' => ['formId' => 'settings_form']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard.command-hud'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['formId' => 'settings_form']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3538477eb67f181dd8c1abfba3a6ad25)): ?>
<?php $attributes = $__attributesOriginal3538477eb67f181dd8c1abfba3a6ad25; ?>
<?php unset($__attributesOriginal3538477eb67f181dd8c1abfba3a6ad25); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3538477eb67f181dd8c1abfba3a6ad25)): ?>
<?php $component = $__componentOriginal3538477eb67f181dd8c1abfba3a6ad25; ?>
<?php unset($__componentOriginal3538477eb67f181dd8c1abfba3a6ad25); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
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
                return "<?php echo route('dashboard.settings.update', 'id'); ?>".replace('id', settings_id);
            },
            successMessage: "<?php echo __('general.update_success_message'); ?>",
            resetForm: false,
            onSuccess: function(data) {
                // Professional HUD Reset
                if (window.activeHud) {
                    window.activeHud.reset();
                }

                // Make the new images the permanent "original" ones
                if (data.data.logo) {
                    const logoUrl = "<?php echo e(asset('uploads/settings')); ?>/" + data.data.logo;
                    const $logoPreview = $('#logo_input_preview');
                    $logoPreview.find('img').attr('src', logoUrl);
                    $logoPreview.data('original-html',
                        `<img src="${logoUrl}" class="fileinput-current-img" style="width:100%; height:100%; object-fit:contain; background-color: #f8f9fa;">`
                    );
                    $('#reset_logo_input_btn').addClass('d-none');
                }

                if (data.data.favicon) {
                    const faviconUrl = "<?php echo e(asset('uploads/settings')); ?>/" + data.data.favicon;
                    const $faviconPreview = $('#favicon_input_preview');
                    $faviconPreview.find('img').attr('src', faviconUrl);
                    $faviconPreview.data('original-html',
                        `<img src="${faviconUrl}" class="fileinput-current-img" style="width:100%; height:100%; object-fit:contain; background-color: #f8f9fa;">`
                    );
                    $('#reset_favicon_input_btn').addClass('d-none');
                }

                // Sync Top Navbar Logos
                if (data.data.logo) {
                    var logoUrl = "<?php echo e(asset('uploads/settings')); ?>/" + data.data.logo;
                    $('#navbar_brand_logo').attr('src', logoUrl);
                }
                if (data.data.favicon) {
                    var faviconUrl = "<?php echo e(asset('uploads/settings')); ?>/" + data.data.favicon;
                    $('#navbar_brand_logo_mini').attr('src', faviconUrl);
                }
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.dashboard.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\market\resources\views/dashboard/settings/index.blade.php ENDPATH**/ ?>