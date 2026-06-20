<div class="table-responsive table-responsive-custom">
    <table class="table table-hover" id="responsiveTable">
        <thead>
            <tr>
                <th class="details-col"></th>
                <th class="text-start">#</th>
                <th class="text-center d-none d-xl-table-cell">{!! __('categories.icon') !!}</th>
                <th class="text-start">{!! __('categories.name') !!}</th>
                <th class="text-center d-none d-xl-table-cell">{!! __('categories.parent') !!}</th>
                <th class="text-center d-none d-xl-table-cell">{!! __('categories.status') !!}</th>
                <th class="text-center d-none d-xl-table-cell">{!! __('categories.manage_status') !!}</th>
                <th class="text-center">{!! __('general.actions') !!}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr data-id="{{ $category->id }}">


                    <td class="details-col"><i class="mdi mdi-plus-circle details-control"
                            data-title="{{ $category->name }}"></i>
                    </td>
                    <td class="text-start">{!! $loop->iteration !!}</td>
                    <td class="text-center d-none d-xl-table-cell td-fit td-center-content">
                        <div class="d-flex justify-content-center align-items-center w-100 h-100">
                            @include('dashboard.categories.parts.photo', ['category' => $category])
                        </div>
                    </td>
                    <td class="text-start fw-bold text-dark">
                        {{ $category->name }}
                        <div class="d-lg-none small text-muted">
                            {{ $category->parentRelation ? $category->parentRelation->name : __('categories.main_category') }}
                        </div>
                    </td>
                    <td class="text-center d-none d-xl-table-cell">
                        @if ($category->parentRelation)
                            <span
                                class="badge badge-opacity-primary rounded-pill px-3 py-2 fw-bold d-inline-flex align-items-center"
                                style="font-size: 0.8rem; letter-spacing: 0.3px;">
                                <i class="mdi mdi-subdirectory-arrow-right fs-6 me-1 text-primary"></i>
                                {{ $category->parentRelation->name }}
                            </span>
                        @else
                            <span
                                class="badge border border-secondary rounded-pill px-3 py-2 fw-medium d-inline-flex align-items-center text-muted"
                                style="background-color: #fafafa; font-size: 0.8rem; letter-spacing: 0.3px;">
                                <i class="mdi mdi-star-circle fs-6 me-1 text-warning"></i>
                                {{ __('categories.main_category') }}
                            </span>
                        @endif
                    </td>
                    <td class="text-center d-none d-xl-table-cell td-fit td-center-content">
                        @include('dashboard.categories.parts.status', ['category' => $category])
                    </td>

                    <td class="text-center d-none d-xl-table-cell td-fit td-center-content">
                        @include('dashboard.categories.parts.manage-status', ['category' => $category])
                    </td>
                    <td class="text-end td-fit">
                        @include('dashboard.categories.parts.actions', ['category' => $category])
                    </td>

                    {{-- Hidden content for Details Modal --}}
                    <td class="d-none row-details">
                        <div class="px-2 py-3">
                            <div class="d-flex align-items-center mb-4 p-3 bg-light rounded-3 border">
                                <div class="me-3 flex-shrink-0">
                                    @include('dashboard.categories.parts.photo', ['category' => $category])
                                </div>
                                <div>
                                    <h5 class="mb-1 text-dark fw-bold" style="font-size: 1.1rem;">
                                        {{ $category->name }}
                                    </h5>
                                    <div class="d-flex align-items-center text-muted small">
                                        <i class="mdi mdi-link-variant me-1"></i>
                                        <span>{{ $category->slug }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="p-3 border rounded-3 bg-white h-100 shadow-sm">
                                        <label class="small text-muted d-block text-uppercase fw-bold mb-2"
                                            style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                            <i class="mdi mdi-file-tree me-1"></i>{{ __('categories.parent') }}
                                        </label>
                                        @if ($category->parentRelation)
                                            <span
                                                class="badge badge-opacity-primary rounded-pill px-3 py-2 fw-bold d-inline-flex align-items-center"
                                                style="font-size: 0.85rem;">
                                                <i class="mdi mdi-subdirectory-arrow-right fs-6 me-1 text-primary"></i>
                                                {{ $category->parentRelation->name }}
                                            </span>
                                        @else
                                            <span
                                                class="badge border border-secondary rounded-pill px-3 py-2 fw-medium d-inline-flex align-items-center text-muted"
                                                style="background-color: #fafafa; font-size: 0.85rem;">
                                                <i class="mdi mdi-star-circle fs-6 me-1 text-warning"></i>
                                                {{ __('categories.main_category') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6 ">
                                    <div class="p-3 border rounded-3 bg-white h-100 shadow-sm">
                                        <label class="small text-muted d-block text-uppercase fw-bold mb-2"
                                            style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                            <i
                                                class="mdi mdi-toggle-switch-outline me-1"></i>{{ __('categories.status') }}
                                        </label>
                                        <div>
                                            @include('dashboard.categories.parts.status', [
                                                'category' => $category,
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
                                                    style="font-size: 0.7rem;">{{ __('categories.created_at') }}</label>
                                                <span class="fw-medium text-dark">{{ $category->created_at }}</span>
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
                    <td colspan="8" class="text-center p-4">
                        <p class="text-muted">{{ __('categories.no_categories_found') }}</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4 pagination-wrapper d-flex justify-content-end">
    {!! $categories->withQueryString()->links() !!}
</div>
