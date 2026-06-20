@extends('layouts.dashboard.app')

@section('title')
    {!! $title !!}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <div class="d-md-flex align-items-center justify-content-between border-bottom mb-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard.index') }}">{!! __('dashboard.dashboard') !!}</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard.roles.index') }}">{!! __('roles.roles') !!}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{!! __('roles.update_role') !!}</li>
                            </ol>
                        </nav>
                        <div class="btn-wrapper">
                            <a href="{{ route('dashboard.roles.index') }}" class="btn btn-outline-dark btn-sm me-0 custom-shadow-sm">
                                <i class="mdi mdi-arrow-left"></i> {!! __('general.back') !!}
                            </a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{!! __('roles.update_role') !!}</h4>
                            <form class="forms-sample" id="role_form" action="{!! route('dashboard.roles.update', $role->id) !!}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $role->id }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3 theme-primary">
                                            <label for="role_ar" class="form-label-premium">{!! __('roles.role_ar') !!} <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text"><i class="mdi mdi-format-title"></i></span>
                                                <input type="text" class="form-control" id="role_ar" name="role[ar]"
                                                    value="{!! old('role.ar', $role->getTranslation('role', 'ar')) !!}" placeholder="{!! __('roles.enter_role_ar') !!}">
                                            </div>
                                            <strong id="role_ar_error" class="text-danger small"></strong>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3 theme-primary">
                                            <label for="role_en" class="form-label-premium">{!! __('roles.role_en') !!} <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group-premium">
                                                <span class="input-group-text"><i class="mdi mdi-format-title"></i></span>
                                                <input type="text" class="form-control" id="role_en" name="role[en]"
                                                    value="{!! old('role.en', $role->getTranslation('role', 'en')) !!}" placeholder="{!! __('roles.enter_role_en') !!}">
                                            </div>
                                            <strong id="role_en_error" class="text-danger small"></strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12">
                                        <label class="mb-3 form-label-premium"><i
                                                class="mdi mdi-shield-check-outline me-1 text-primary"></i>{!! __('roles.permissions') !!}
                                            <span class="text-danger">*</span></label>
                                        <div class="row">
                                            @foreach (config('global.permissions') as $key => $value)
                                                <div class="col-md-3 mb-2">
                                                    <div class="form-check form-check-flat form-check-primary">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="permissions[]" value="{!! $key !!}"
                                                                @checked(in_array($key, $role->permissions))>
                                                            {{ __(config('global.permissions.' . $key)) }}
                                                            <i class="input-helper"></i></label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <strong id="permissions_error" class="text-danger small d-block mt-2"></strong>
                                    </div>
                                </div>

                                <!-- Floating Command HUD -->
                                <x-dashboard.command-hud formId="role_form" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            // --- Initialize HUD ---
            initHud('role_form');

            window.handleFormSubmit('#role_form', {
                successMessage: "{!! __('general.update_success_message') !!}",
                resetForm: false,
                onSuccess: function(data) {
                    if (window.activeHud) window.activeHud.changedFields
                        .clear(); // Clear tracking on success
                    setTimeout(() => {
                        window.location.href = "{!! route('dashboard.roles.index') !!}";
                    }, 1000);
                }
            });
        });
    </script>
@endpush
