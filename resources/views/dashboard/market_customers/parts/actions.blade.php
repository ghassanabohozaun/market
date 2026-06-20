<div class="d-flex justify-content-end gap-2">
    <a href="#" class="action-icon-btn action-edit edit_market_customer_button" title="{!! __('general.edit') !!}"
        data-id="{!! $market_customer->id !!}" 
        data-name="{!! $market_customer->name !!}" 
        data-phone="{!! $market_customer->phone !!}" 
        data-balance="{!! $market_customer->balance !!}">
        <i class="icon-pencil"></i>
    </a>

    <button type="button" class="action-icon-btn action-delete js-delete-btn" data-id="{!! $market_customer->id !!}"
        data-url="{!! route('dashboard.market.customers.destroy') !!}" data-title="{!! __('general.ask_delete_record') !!}" data-text="{!! __('general.delete_warning_text') !!}"
        data-confirm-btn="{!! __('general.yes') !!}" data-cancel-btn="{!! __('general.no') !!}"
        data-success-title="{!! __('general.deleted') !!}" data-success-text="{!! __('general.delete_success_message') !!}"
        title="{!! __('general.delete') !!}">
        <i class="ti-trash"></i>
    </button>
</div>
