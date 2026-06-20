<div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog" aria-labelledby="createCategoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered premium-modal-xl" role="document">
        <form class="forms-sample w-100" action="{!! route('dashboard.categories.store') !!}" method="POST" enctype="multipart/form-data"
            id="create_category_form">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCategoryModalLabel">
                        <i class="mdi mdi-plus-circle me-2"></i>{!! __('categories.create_new_category') !!}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3 theme-primary">
                                <label for="name_ar" class="form-label-premium">{!! __('categories.name_ar') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-format-title"></i></span>
                                    <input type="text" id="name_ar" name="name[ar]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('categories.enter_name_ar') !!}">
                                </div>
                                <strong id="name_ar_error" class="text-danger small"></strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3 theme-primary">
                                <label for="name_en" class="form-label-premium">{!! __('categories.name_en') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-format-title"></i></span>
                                    <input type="text" id="name_en" name="name[en]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('categories.enter_name_en') !!}">
                                </div>
                                <strong id="name_en_error" class="text-danger small"></strong>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3 theme-primary">
                                <label for="slug_ar" class="form-label-premium">{!! __('categories.slug_ar') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-link-variant"></i></span>
                                    <input type="text" id="slug_ar" name="slug[ar]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('categories.enter_slug_ar') !!}">
                                </div>
                                <strong id="slug_ar_error" class="text-danger small"></strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3 theme-primary">
                                <label for="slug_en" class="form-label-premium">{!! __('categories.slug_en') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-link-variant"></i></span>
                                    <input type="text" id="slug_en" name="slug[en]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('categories.enter_slug_en') !!}">
                                </div>
                                <strong id="slug_en_error" class="text-danger small"></strong>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <label for="parent" class="form-label-premium">{!! __('categories.parent') !!}</label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-file-tree"></i></span>
                                    <select class="form-select" id="parent" name="parent">
                                        <option value="" selected>{!! __('categories.main_category') !!}</option>
                                        @foreach ($allCategories as $cat)
                                            <option value="{{ $cat->id }}">
                                                {{ $cat->getTranslation('name', Lang()) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <strong id="parent_error" class="text-danger small"></strong>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <x-dashboard.file-input name="icon" id="icon"
                                label="{!! __('categories.icon') !!} <span class='text-danger'>*</span>"
                                placeholderIcon="mdi-shape-outline" errorId="icon_error" isRequired="false" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-2 theme-success">
                                <div class="input-group-premium p-1 pe-3" style="background-color: #fafafafa;">
                                    <span class="input-group-text"><i class="mdi mdi-power"></i></span>
                                    <div class="d-flex align-items-center justify-content-between flex-grow-1">
                                        <label class="mb-0 form-label-premium"
                                            for="status_active">{!! __('categories.status') !!}</label>
                                        <div class="form-check form-switch mb-0">
                                            <input type="hidden" name="status" value="0">
                                            <input type="checkbox" class="form-check-input m-0" role="switch" name="status"
                                                id="status_active" value="1" checked style="width: 2.5rem; height: 1.25rem; cursor: pointer;">
                                        </div>
                                    </div>
                                </div>
                                <strong id="status_error" class="text-danger small"></strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Floating Command HUD -->
                <x-dashboard.command-hud formId="create_category_form" hudId="create_category_hud"
                    countId="create_category_count" discardId="create_category_discard"
                    submitId="create_category_save" />
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        function resetCreateForm() {
            $('#create_category_form')[0].reset();
            window.clearFormErrors('#create_category_form');
            $('#reset_photo_create_btn').click();
            // Reset select to default
            $('#parent').val('');
        }

        $('#createCategoryModal').on('hidden.bs.modal', function() {
            resetCreateForm();
        });

        $('#createCategoryModal').on('shown.bs.modal', function() {
            initHud('create_category_form', {
                hudId: 'create_category_hud',
                countId: 'create_category_count',
                discardId: 'create_category_discard',
                submitId: 'create_category_save'
            });
        });

        window.handleFormSubmit('#create_category_form', {
            modalToHide: '#createCategoryModal',
            tableToLoad: '#responsiveTable',
            successMessage: "{!! __('general.add_success_message') !!}",
            onSuccess: function() {
                resetCreateForm();
            }
        });
    </script>
@endpush
