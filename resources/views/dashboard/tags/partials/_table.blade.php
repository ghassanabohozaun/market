<div class="table-responsive table-responsive-custom">
    <table class="table table-hover" id="responsiveTable">
        <thead>
            <tr>
                <th class="details-col"></th>
                <th class="text-start">#</th>
                <th class="text-start">{!! __('tags.name') !!}</th>
                <th class="text-start d-none d-xl-table-cell">{!! __('tags.slug') !!}</th>
                <th class="text-center d-none d-xl-table-cell">{!! __('general.status') !!}</th>
                <th class="text-center d-none d-xl-table-cell">{!! __('general.manage_status') !!}</th>
                <th class="text-center">{!! __('general.actions') !!}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tags as $tag)
                <tr data-id="{{ $tag->id }}">
                    <td class="details-col"><i class="mdi mdi-plus-circle details-control"
                            data-title="{{ $tag->name }}"></i>
                    </td>
                    <td class="text-start">{!! $loop->iteration !!}</td>
                    <td class="text-start fw-bold text-dark">
                        {{ $tag->name }}
                    </td>
                    <td class="text-start d-none d-xl-table-cell text-muted">
                        {{ $tag->slug }}
                    </td>
                    <td class="text-center d-none d-xl-table-cell td-fit td-center-content">
                        @include('dashboard.tags.parts.status', ['tag' => $tag])
                    </td>
                    <td class="text-center d-none d-xl-table-cell td-fit td-center-content">
                        @include('dashboard.tags.parts.manage-status', ['tag' => $tag])
                    </td>
                    <td class="text-end td-fit">
                        @include('dashboard.tags.parts.actions', ['tag' => $tag])
                    </td>

                    {{-- Hidden content for Details Modal --}}
                    <td class="d-none row-details">
                        <div class="px-2 py-3">
                            <div class="d-flex align-items-center mb-4 p-3 bg-light rounded-3 border">
                                <div>
                                    <h5 class="mb-1 text-dark fw-bold" style="font-size: 1.1rem;">
                                        {{ $tag->name }}
                                    </h5>
                                    <div class="d-flex align-items-center text-muted small">
                                        <i class="mdi mdi-link-variant me-1"></i>
                                        <span>{{ $tag->slug }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6 ">
                                    <div class="p-3 border rounded-3 bg-white h-100 shadow-sm">
                                        <label class="small text-muted d-block text-uppercase fw-bold mb-2"
                                            style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                            <i
                                                class="mdi mdi-toggle-switch-outline me-1"></i>{{ __('general.status') }}
                                        </label>
                                        <div>
                                            @include('dashboard.tags.parts.status', [
                                                'tag' => $tag,
                                            ])
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-3">
                                    <div
                                        class="p-3 border rounded-3 bg-light shadow-sm d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-white d-flex align-items-center justify-content-center me-3 border shadow-sm"
                                                style="width: 36px; height: 36px;">
                                                <i class="mdi mdi-calendar-clock text-primary fs-5"></i>
                                            </div>
                                            <div>
                                                <label class="small text-muted d-block text-uppercase fw-bold mb-0"
                                                    style="font-size: 0.7rem;">{{ __('general.created_at') }}</label>
                                                <span class="fw-medium text-dark">{{ $tag->created_at }}</span>
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
                    <td colspan="7">
                        <x-dashboard.empty-state icon="mdi-tag-outline" :message="__('tags.no_tags_found')" />
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4 pagination-wrapper d-flex justify-content-end">
    {!! $tags->withQueryString()->links() !!}
</div>
