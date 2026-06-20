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
                                <li class="breadcrumb-item active" aria-current="page">{!! __('addresses.countries') !!}</li>
                            </ol>
                        </nav>
                        <div class="btn-wrapper mt-3 mt-sm-0">
                            <button type="button" class="btn btn-primary text-white me-0" data-bs-toggle="modal"
                                data-bs-target="#createCountryModal">
                                <i class="icon-plus"></i> {!! __('addresses.create_new_country') !!}
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            @include('dashboard.addresses.countries.partials._search')

                            <div class="card card-rounded mt-1">
                                <div class="card-body">
                                    <h4 class="card-title mb-4 d-flex align-items-center">
                                        <span class="card-icon-premium me-3">
                                            <i class="mdi mdi-earth"></i>
                                        </span>
                                        {!! __('addresses.show_all_countries') !!}
                                    </h4>
                                    <div class="table-loader-container" style="position: relative;">
                                        <div class="table-loader-overlay">
                                            <span class="premium-loader"></span>
                                        </div>
                                        <div id="table_data">
                                            @include('dashboard.addresses.countries.partials._table', [
                                                'countries' => $countries,
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
    </div>
@endsection

    @push('modals')
        @include('dashboard.addresses.countries.modals.create')
        @include('dashboard.addresses.countries.modals.edit')
        @include('dashboard.addresses.countries.parts.countries_data')
        @include('dashboard.addresses.countries.modals.flags_reference')
        @include('dashboard.general.tr-details')
    @endpush

    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                // Initialize Generic Index Table Handler
                window.initIndexTable({
                    container: '#table_data',
                    loader: '.table-loader-overlay',
                    detailsModal: '#detailsModal',
                    detailsModalLabel: '#detailsModalLabel',
                    detailsModalBody: '#modalBody'
                });
            });
        </script>
    @endpush
