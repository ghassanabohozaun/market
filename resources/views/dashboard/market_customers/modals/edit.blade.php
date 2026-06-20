<div class="modal fade" id="editMarketCustomerModal" tabindex="-1" role="dialog" aria-labelledby="editMarketCustomerModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered premium-modal-xl" role="document">
        <form class="forms-sample" action="" method="POST" enctype="multipart/form-data" id='edit_market_customer_form'>
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMarketCustomerModalLabel">
                        <i class="mdi mdi-pencil-circle me-2"></i>{!! __('market.update_customer') !!}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <label for="edit_name" class="form-label-premium">{!! __('market.name') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-account"></i></span>
                                    <input type="text" id="edit_name" name="name" class="form-control"
                                        autocomplete="off" placeholder="{!! __('market.name') !!}">
                                </div>
                                <strong id="edit_name_error" class="text-danger small"></strong>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <label for="edit_phone" class="form-label-premium">{!! __('market.phone') !!}</label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-phone"></i></span>
                                    <input type="text" id="edit_phone" name="phone" class="form-control"
                                        autocomplete="off" placeholder="{!! __('market.phone_optional') !!}">
                                </div>
                                <strong id="edit_phone_error" class="text-danger small"></strong>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <label for="edit_balance" class="form-label-premium">{!! __('market.balance') !!}</label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-cash-multiple"></i></span>
                                    <input type="number" step="0.01" id="edit_balance" name="balance" class="form-control"
                                        autocomplete="off" placeholder="0.00" value="0">
                                </div>
                                <strong id="edit_balance_error" class="text-danger small"></strong>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <!-- Buttons removed in favor of Floating Command HUD -->
                </div>

                <!-- Floating Command HUD -->
                <x-dashboard.command-hud formId="edit_market_customer_form" hudId="edit_market_customer_hud"
                    countId="edit_market_customer_count" discardId="edit_market_customer_discard"
                    submitId="edit_market_customer_save" />
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        $(document).on('click', '.edit_market_customer_button', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            const name = $(this).data('name');
            const phone = $(this).data('phone');
            const balance = $(this).data('balance');

            const updateUrl = `{{ route('dashboard.market.customers.update', ':id') }}`.replace(':id', id);

            $('#edit_market_customer_form').attr('action', updateUrl);
            $('#edit_name').val(name);
            $('#edit_phone').val(phone);
            $('#edit_balance').val(balance);

            $('#editMarketCustomerModal').modal('show');
        });

        $('#editMarketCustomerModal').on('hidden.bs.modal', function() {
            window.clearFormErrors('#edit_market_customer_form');
            $('#edit_market_customer_form')[0].reset();
        });

        window.handleFormSubmit('#edit_market_customer_form', {
            modalToHide: '#editMarketCustomerModal',
            successMessage: "{!! __('general.edit_success_message') !!}",
            onSuccess: function() {
                if (window.activeHud) window.activeHud.changedFields.clear();
            }
        });

        // Initialize HUD when modal opens
        $('#editMarketCustomerModal').on('shown.bs.modal', function() {
            initHud('edit_market_customer_form', {
                hudId: 'edit_market_customer_hud',
                countId: 'edit_market_customer_count',
                discardId: 'edit_market_customer_discard',
                submitId: 'edit_market_customer_save'
            });
        });
    </script>
@endpush
