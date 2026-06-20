<div class="table-responsive table-responsive-custom">
    <table class="table table-hover js-sliders-table" id="responsiveTable">
        <thead>
            <tr>
                <th class="details-col"></th>
                <th class="text-start">#</th>
                <th class="text-start d-none d-md-table-cell">{!! __('sliders.photo') !!}</th>
                <th class="text-start">{!! __('sliders.title') !!}</th>
                <th class="text-start">{!! __('sliders.subtitle') !!}</th>
                <th class="text-center d-none d-md-table-cell">{!! __('sliders.status') !!}</th>
                <th class="text-center d-none d-xl-table-cell">{!! __('sliders.manage_status') !!}</th>
                <th class="text-center">{!! __('general.actions') !!}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($sliders as $slider)
                <tr id="slider-row-{{ $slider->id }}">
                    <td class="details-col">
                        <i class="mdi mdi-plus-circle details-control" data-title="{!! $slider->getTranslation('title', Lang()) !!}"></i>
                    </td>
                    <td class="text-start">{!! $loop->iteration !!}</td>
                    <td class="text-start d-none d-md-table-cell">
                        @include('dashboard.sliders.parts.photo', [
                            'slider' => $slider,
                        ])
                    </td>
                    <td class="text-start">{!! $slider->getTranslation('title', Lang()) !!}</td>
                    <td class="text-start">{!! $slider->getTranslation('subtitle', Lang(), false) ?? '-' !!}</td>
                    <td class="text-center d-none d-md-table-cell td-fit td-center-content">
                        @include('dashboard.sliders.parts.status', [
                            'slider' => $slider,
                        ])
                    </td>
                    <td class="text-center d-none d-xl-table-cell td-fit td-center-content">
                        @include('dashboard.sliders.parts.manage_status', [
                            'slider' => $slider,
                        ])
                    </td>
                    <td class="text-end td-fit">
                        @include('dashboard.sliders.parts.actions', [
                            'slider' => $slider,
                        ])
                    </td>

                    {{-- Hidden content for Details Modal --}}
                    <td class="d-none row-details">
                        <div class="px-2 py-3">
                            <div class="d-flex align-items-center mb-4 p-3 bg-light rounded-3 border">
                                <div class="me-3 flex-shrink-0">
                                    <div class="rounded bg-white d-flex align-items-center justify-content-center border shadow-sm"
                                        style="width: 80px; height: 48px; overflow: hidden;">
                                        @include('dashboard.sliders.parts.photo', ['slider' => $slider])
                                    </div>
                                </div>
                                <div>
                                    <h5 class="mb-1 text-dark fw-bold" style="font-size: 1.1rem;">
                                        {!! $slider->getTranslation('title', Lang()) !!}
                                    </h5>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-12 mt-3">
                                    <div
                                        class="p-3 border rounded-3 bg-white h-100 shadow-sm d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3 border shadow-sm"
                                                style="width: 36px; height: 36px;">
                                                <i class="mdi mdi-toggle-switch-outline text-primary fs-5"></i>
                                            </div>
                                            <div>
                                                <label class="small text-muted d-block text-uppercase fw-bold mb-0"
                                                    style="font-size: 0.7rem;">{!! __('sliders.status') !!}</label>
                                                <div class="mt-1">
                                                    @include('dashboard.sliders.parts.status', [
                                                        'slider' => $slider,
                                                    ])
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11">
                        <x-dashboard.empty-state icon="mdi-image-off-outline" :message="__('sliders.no_sliders_found')" />
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4 pagination-wrapper d-flex justify-content-end">
        {!! $sliders->withQueryString()->links() !!}
    </div>
</div>
