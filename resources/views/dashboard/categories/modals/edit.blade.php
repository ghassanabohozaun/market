<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered premium-modal-xl" role="document">
        <form class="forms-sample w-100" action="" method="POST" enctype="multipart/form-data" id="edit_category_form">
            @csrf
            @method('PUT')
            <input type="hidden" id="id_edit" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">
                        <i class="mdi mdi-pencil me-2"></i>{!! __('categories.update_category') !!}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3 theme-primary">
                                <label for="name_ar_edit" class="form-label-premium">{!! __('categories.name_ar') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-format-title"></i></span>
                                    <input type="text" id="name_ar_edit" name="name[ar]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('categories.enter_name_ar') !!}">
                                </div>
                                <strong id="name_ar_error_edit" class="text-danger small"></strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3 theme-primary">
                                <label for="name_en_edit" class="form-label-premium">{!! __('categories.name_en') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-format-title"></i></span>
                                    <input type="text" id="name_en_edit" name="name[en]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('categories.enter_name_en') !!}">
                                </div>
                                <strong id="name_en_error_edit" class="text-danger small"></strong>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3 theme-primary">
                                <label for="slug_ar_edit" class="form-label-premium">{!! __('categories.slug_ar') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-link-variant"></i></span>
                                    <input type="text" id="slug_ar_edit" name="slug[ar]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('categories.enter_slug_ar') !!}">
                                </div>
                                <strong id="slug_ar_error_edit" class="text-danger small"></strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3 theme-primary">
                                <label for="slug_en_edit" class="form-label-premium">{!! __('categories.slug_en') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-link-variant"></i></span>
                                    <input type="text" id="slug_en_edit" name="slug[en]" class="form-control"
                                        autocomplete="off" placeholder="{!! __('categories.enter_slug_en') !!}">
                                </div>
                                <strong id="slug_en_error_edit" class="text-danger small"></strong>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <label for="parent_edit" class="form-label-premium">{!! __('categories.parent') !!}</label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-file-tree"></i></span>
                                    <select class="form-select" id="parent_edit" name="parent">
                                        <option value="">{!! __('categories.main_category') !!}</option>
                                        @foreach ($allCategories as $cat)
                                            <option value="{{ $cat->id }}">
                                                {{ $cat->getTranslation('name', Lang()) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <strong id="parent_error_edit" class="text-danger small"></strong>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <x-dashboard.file-input name="icon" id="icon_edit"
                                label="{!! __('categories.icon') !!} <span class='text-danger'>*</span>"
                                placeholderIcon="mdi-shape-outline" currentImageUrl="javascript:void(0)"
                                errorId="icon_error_edit" isRequired="false" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-2 theme-success">
                                <div class="input-group-premium p-1 pe-3" style="background-color: #fafafafa;">
                                    <span class="input-group-text"><i class="mdi mdi-power"></i></span>
                                    <div class="d-flex align-items-center justify-content-between flex-grow-1">
                                        <label class="mb-0 form-label-premium"
                                            for="status_active_edit">{!! __('categories.status') !!}</label>
                                        <div class="form-check form-switch mb-0">
                                            <input type="hidden" name="status" value="0">
                                            <input type="checkbox" class="form-check-input m-0" role="switch" name="status"
                                                id="status_active_edit" value="1" style="width: 2.5rem; height: 1.25rem; cursor: pointer;">
                                        </div>
                                    </div>
                                </div>
                                <strong id="status_error_edit" class="text-danger small"></strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Floating Command HUD -->
                <x-dashboard.command-hud formId="edit_category_form" hudId="edit_category_hud"
                    countId="edit_category_count" discardId="edit_category_discard" submitId="edit_category_save" />
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        window.populateModal('.edit-btn', {
            modal: '#editCategoryModal',
            form: '#edit_category_form',
            actionUrl: "{!! route('dashboard.categories.update', 'id') !!}",
            idKey: 'id',
            suffix: '_edit',
            onAfterPopulate: function(btn, data, form) {
                if (window.activeHud) window.activeHud.changedFields.clear();
                initHud('edit_category_form', {
                    hudId: 'edit_category_hud',
                    countId: 'edit_category_count',
                    discardId: 'edit_category_discard',
                    submitId: 'edit_category_save'
                });

                // Show all options, then hide the category's own ID to prevent self-parenting
                $('#parent_edit option').show();
                if (data.id) {
                    $('#parent_edit option[value="' + data.id + '"]').hide();
                }

                // Ensure the correct parent is selected or reset to main if null
                let defaultParent = data.parent !== null && data.parent !== undefined ? data.parent : '';
                $('#parent_edit').val(defaultParent).trigger('change');



                // Handle icon preview
                var previewContainer = $('#icon_edit_preview');
                var currentImg = previewContainer.find('.fileinput-current-img');
                var placeholder = previewContainer.find('.fileinput-placeholder');
                var deleteBtn = previewContainer.find('.fileinput-backend-delete');

                if (data.photo && data.photo !== "" && data.photo !== "null") {
                    var iconBase = "{{ asset('uploads/categories') }}";
                    var photoUrl = iconBase + '/' + data.photo;

                    previewContainer.data('original-html',
                        `<img src="${photoUrl}" class="fileinput-current-img" style="width:100%; height:100%; object-fit:contain; background-color: #f8f9fa;">`
                    );

                    currentImg.attr('src', photoUrl).removeClass('d-none');
                    placeholder.addClass('d-none');
                    if (deleteBtn.length) deleteBtn.removeClass('d-none');
                } else {
                    previewContainer.data('original-html', '');
                    currentImg.addClass('d-none').attr('src', '');
                    placeholder.removeClass('d-none');
                    if (deleteBtn.length) deleteBtn.addClass('d-none');
                }
            }
        });

        function resetEditForm() {
            window.clearFormErrors('#edit_category_form');
            $('#reset_icon_edit_btn').click();
        }

        $('#editCategoryModal').on('hidden.bs.modal', function() {
            resetEditForm();
        });

        window.handleFormSubmit('#edit_category_form', {
            modalToHide: '#editCategoryModal',
            tableToLoad: '#responsiveTable',
            successMessage: "{!! __('general.update_success_message') !!}",
            suffix: '_edit',
            resetForm: false,
            onSuccess: function() {
                if (window.activeHud) window.activeHud.changedFields.clear();
            }
        });
    </script>
@endpush
