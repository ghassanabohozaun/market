<div class="modal fade" id="createMarketCustomerModal" tabindex="-1" role="dialog" aria-labelledby="createMarketCustomerModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered premium-modal-xl" role="document">
        <form class="forms-sample" action="{!! route('dashboard.market.customers.store') !!}" method="POST" enctype="multipart/form-data"
            id='create_market_customer_form'>
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createMarketCustomerModalLabel">
                        <i class="mdi mdi-plus-circle me-2"></i>{!! __('market.create_new_customer') !!}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <label for="name" class="form-label-premium">{!! __('market.name') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-account"></i></span>
                                    <input type="text" id="name" name="name" class="form-control"
                                        autocomplete="off" placeholder="{!! __('market.name') !!}">
                                </div>
                                <strong id="name_error" class="text-danger small"></strong>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <label for="phone" class="form-label-premium">{!! __('market.phone') !!}</label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-phone"></i></span>
                                    <input type="text" id="phone" name="phone" class="form-control"
                                        autocomplete="off" placeholder="{!! __('market.phone_optional') !!}">
                                </div>
                                <strong id="phone_error" class="text-danger small"></strong>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3 theme-primary">
                                <label for="balance" class="form-label-premium">{!! __('market.balance') !!}</label>
                                <div class="input-group-premium">
                                    <span class="input-group-text"><i class="mdi mdi-cash-multiple"></i></span>
                                    <input type="number" step="0.01" id="balance" name="balance" class="form-control"
                                        autocomplete="off" placeholder="0.00" value="0">
                                </div>
                                <strong id="balance_error" class="text-danger small"></strong>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <!-- Buttons removed in favor of Floating Command HUD -->
                </div>

                <!-- Floating Command HUD -->
                <x-dashboard.command-hud formId="create_market_customer_form" hudId="create_market_customer_hud"
                    countId="create_market_customer_count" discardId="create_market_customer_discard"
                    submitId="create_market_customer_save" />
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        $('#createMarketCustomerModal').on('hidden.bs.modal', function() {
            window.clearFormErrors('#create_market_customer_form');
            $('#create_market_customer_form')[0].reset();
        });

        window.handleFormSubmit('#create_market_customer_form', {
            modalToHide: '#createMarketCustomerModal',
            successMessage: "{!! __('general.add_success_message') !!}",
            onSuccess: function() {
                if (window.activeHud) window.activeHud.changedFields.clear(); // Clear tracking on success
            }
        });

        // Initialize HUD when modal opens
        $('#createMarketCustomerModal').on('shown.bs.modal', function() {
            initHud('create_market_customer_form', {
                hudId: 'create_market_customer_hud',
                countId: 'create_market_customer_count',
                discardId: 'create_market_customer_discard',
                submitId: 'create_market_customer_save'
            });
        });
    </script>
@endpush
