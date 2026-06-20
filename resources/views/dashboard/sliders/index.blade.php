@extends('layouts.dashboard.app')

@section('title')
    {!! $title !!}
@endsection



@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <!--------------------  Start Breadcrumb  ---------------------------->
                    <div class="d-md-flex align-items-center justify-content-between border-bottom mb-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard.index') }}">{!! __('dashboard.dashboard') !!}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{!! __('sliders.sliders') !!}</li>
                            </ol>
                        </nav>
                        <div class="btn-wrapper mt-3 mt-sm-0">
                            <a href="{!! route('dashboard.sliders.create') !!}" class="btn btn-primary text-white me-0">
                                <i class="icon-plus"></i> {!! __('sliders.create_new_slider') !!}
                            </a>
                        </div>
                    </div>
                    <!--------------------  End Breadcrumb  ---------------------------->

                    <!--------------------  Start Table  ---------------------------->
                    <div class="row">
                        <div class="col-md-12">
                            @include('dashboard.sliders.partials._search')
                        </div>
                    </div>

                    <div class="card card-rounded shadow-sm">
                        <div class="card-body">
                            <h4 class="card-title mb-4 d-flex align-items-center">
                                <span class="card-icon-premium me-3">
                                    <i class="mdi mdi-view-carousel-outline text-primary"></i>
                                </span>
                                {!! __('sliders.show_all_sliders') !!}
                            </h4>
                            <div class="table-loader-container" style="position: relative;">
                                <div class="table-loader-overlay">
                                    <span class="premium-loader"></span>
                                </div>
                                <div id="table_data">
                                    @include('dashboard.sliders.partials._table', [
                                        'sliders' => $sliders,
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--------------------  End Table  ---------------------------->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('modals')
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
        });
    </script>
@endpush
