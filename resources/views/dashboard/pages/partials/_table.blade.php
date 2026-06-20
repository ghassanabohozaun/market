<div class="table-responsive table-responsive-custom">
    <table class="table table-hover" id="responsiveTable">
        <thead>
            <tr>
                <th class="details-col"></th>
                <th class="text-start">#</th>
                <th class="text-start">{!! __('pages.photo') !!}</th>
                <th class="text-start">{!! __('pages.title') !!}</th>
                <th class="text-center d-none d-md-table-cell">{!! __('pages.status') !!}</th>
                <th class="text-center d-none d-xl-table-cell">{!! __('pages.manage_status') !!}</th>
                <th class="text-center">{!! __('general.actions') !!}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pages as $page)
                <tr id="page-row-{{ $page->id }}">
                    <td class="details-col">
                        <i class="mdi mdi-plus-circle details-control" data-title="{!! $page->getTranslation('title', Lang()) !!}"></i>
                    </td>
                    <td class="text-start">{!! $loop->iteration !!}</td>
                    <td class="text-start">
                        @include('dashboard.pages.parts.photo', [
                            'page' => $page,
                        ])
                    </td>
                    <td class="text-start">{!! $page->getTranslation('title', Lang()) !!}</td>
                    <td class="text-center d-none d-md-table-cell td-fit td-center-content">
                        @include('dashboard.pages.parts.status', [
                            'page' => $page,
                        ])
                    </td>
                    <td class="text-center d-none d-xl-table-cell td-fit td-center-content">
                        @include('dashboard.pages.parts.manage-status', ['page' => $page])
                    </td>
                    <td class="text-end td-fit">
                        @include('dashboard.pages.parts.actions', [
                            'page' => $page,
                        ])
                    </td>

                    {{-- Hidden content for Details Modal --}}
                    <td class="d-none row-details">
                        <div class="px-2 py-3">
                            <div class="d-flex align-items-center mb-4 p-3 bg-light rounded-3 border">
                                <div class="me-3 flex-shrink-0">
                                    <div class="rounded bg-white d-flex align-items-center justify-content-center border shadow-sm"
                                        style="width: 80px; height: 48px; overflow: hidden;">
                                        @include('dashboard.pages.parts.photo', ['page' => $page])
                                    </div>
                                </div>
                                <div>
                                    <h5 class="mb-1 text-dark fw-bold" style="font-size: 1.1rem;">
                                        {!! $page->getTranslation('title', Lang()) !!}
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
                                                    style="font-size: 0.7rem;">{!! __('pages.status') !!}</label>
                                                <div class="mt-1">
                                                    @include('dashboard.pages.parts.status', [
                                                        'page' => $page,
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
                        <x-dashboard.empty-state icon="mdi-file-remove-outline" :message="__('pages.no_pages_found')" />
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4 pagination-wrapper d-flex justify-content-end">
        {!! $pages->withQueryString()->links() !!}
    </div>
</div>
