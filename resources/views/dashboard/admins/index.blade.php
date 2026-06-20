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
                                <li class="breadcrumb-item active" aria-current="page">{!! __('admins.admins') !!}</li>
                            </ol>
                        </nav>
                        <div class="btn-wrapper mt-3 mt-sm-0">
                            <button type="button" class="btn btn-primary text-white me-0" data-bs-toggle="modal"
                                data-bs-target="#createAdminModal">
                                <i class="icon-plus"></i> {!! __('admins.create_new_admin') !!}
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            @include('dashboard.admins.partials._search')

                            <div class="card card-rounded mt-1">
                                <div class="card-body">
                                    <h4 class="card-title mb-4 d-flex align-items-center">
                                        <span class="card-icon-premium me-3">
                                            <i class="mdi mdi-account-group-outline"></i>
                                        </span>
                                        {!! __('admins.show_all_admins') !!}
                                    </h4>
                                    <div class="table-loader-container" style="position: relative;">
                                        <div class="table-loader-overlay">
                                            <span class="premium-loader"></span>
                                        </div>
                                        <div id="table_data">
                                            @include('dashboard.admins.partials._table', [
                                                'admins' => $admins,
                                            ])
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('modals')
        @include('dashboard.admins.modals.create')
        @include('dashboard.admins.modals.edit')
        @include('dashboard.general.tr-details')
    @endpush

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Initialize Generic Index Table Handler
                window.initIndexTable({
                    container: '#table_data',
                    loader: '.table-loader-overlay',
                    detailsModal: '#detailsModal',
                    detailsModalLabel: '#detailsModalLabel',
                    detailsModalBody: '#modalBody'
                });

                // Toggle password visibility
                $(document).on('click', '.toggle-password', function() {
                    const targetId = $(this).data('target');
                    const input = $('#' + targetId);
                    const icon = $(this).find('i');
                    if (input.attr('type') === 'password') {
                        input.attr('type', 'text');
                        icon.css('opacity', '0.5'); // Visually indicate "eye off"
                        icon.parent().css('background-color', '#ebebeb');
                    } else {
                        input.attr('type', 'password');
                        icon.css('opacity', '1');
                        icon.parent().css('background-color', 'transparent');
                    }
                });


            });
        </script>
    @endpush
