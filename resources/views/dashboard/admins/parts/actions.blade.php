<div class="d-flex justify-content-end gap-2">
    <a href="javascript:void(0)" class="action-icon-btn action-edit edit_admin_button"
        title="{!! __('general.edit') !!}" data-id="{!! $admin->id !!}" data-name-ar="{!! $admin->getTranslation('name', 'ar') !!}"
        data-name-en="{!! $admin->getTranslation('name', 'en') !!}" data-email="{!! $admin->email !!}" data-role-id="{!! $admin->role_id !!}"
        data-status-active="{!! $admin->status !!}" data-photo="{!! $admin->photo !!}">
        <i class="icon-pencil"></i>
    </a>

    <button type="button" class="action-icon-btn action-delete {!! auth('admin')->id() != $admin->id ? 'js-delete-btn' : '' !!}"
        data-id="{!! $admin->id !!}" data-url="{!! route('dashboard.admins.destroy', $admin->id) !!}" title="{!! auth('admin')->id() == $admin->id ? __('general.prevent_delete') : __('general.delete') !!}"
        {!! auth('admin')->id() == $admin->id ? 'disabled' : '' !!}>
        <i class="ti-trash"></i>
    </button>
</div>
