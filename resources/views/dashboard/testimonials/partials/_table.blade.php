<div class="table-responsive table-responsive-custom">
    <table class="table table-hover" id="responsiveTable">
        <thead>
            <tr>
                <th class="details-col"></th>
                <th class="text-start">#</th>
                <th class="text-center d-none d-xl-table-cell">{!! __('testimonials.image') !!}</th>
                <th class="text-start">{!! __('testimonials.name') !!}</th>
                <th class="text-center d-none d-xl-table-cell">{!! __('testimonials.rating') !!}</th>
                <th class="text-center d-none d-xl-table-cell">{!! __('testimonials.status') !!}</th>
                <th class="text-center d-none d-xl-table-cell">{!! __('testimonials.manage_status') !!}</th>
                <th class="text-center">{!! __('general.actions') !!}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($testimonials as $testimonial)
                <tr data-id="{{ $testimonial->id }}">

                    <td class="details-col"><i class="mdi mdi-plus-circle details-control"
                            data-title="{{ $testimonial->name }}"></i>
                    </td>
                    <td class="text-start">{!! $loop->iteration !!}</td>
                    <td class="text-center d-none d-xl-table-cell td-fit td-center-content">
                        <div class="d-flex justify-content-center align-items-center w-100 h-100">
                            @include('dashboard.testimonials.parts.photo', ['testimonial' => $testimonial])
                        </div>
                    </td>
                    <td class="text-start fw-bold text-dark">
                        {{ $testimonial->name }}
                        <br>
                        <small class="text-muted">{{ $testimonial->title }}</small>
                    </td>
                    
                    <td class="text-center d-none d-xl-table-cell text-nowrap td-center-content">
                        @for($i=1; $i<=5; $i++)
                            <i class="mdi mdi-star {{ $i <= $testimonial->rating ? 'text-warning' : 'text-muted' }}"></i>
                        @endfor
                    </td>

                    <td class="text-center d-none d-xl-table-cell td-fit td-center-content">
                        @include('dashboard.testimonials.parts.status', ['testimonial' => $testimonial])
                    </td>

                    <td class="text-center d-none d-xl-table-cell td-fit td-center-content">
                        @include('dashboard.testimonials.parts.manage-status', ['testimonial' => $testimonial])
                    </td>
                    <td class="text-end td-fit">
                        @include('dashboard.testimonials.parts.actions', ['testimonial' => $testimonial])
                    </td>

                    {{-- Hidden content for Details Modal --}}
                    <td class="d-none row-details">
                        <div class="px-2 py-3">
                            <div class="d-flex align-items-center mb-4 p-3 bg-light rounded-3 border">
                                <div class="me-3 flex-shrink-0">
                                    @include('dashboard.testimonials.parts.photo', ['testimonial' => $testimonial])
                                </div>
                                <div>
                                    <h5 class="mb-1 text-dark fw-bold" style="font-size: 1.1rem;">
                                        {{ $testimonial->name }}
                                    </h5>
                                    <div class="d-flex align-items-center text-muted small">
                                        <i class="mdi mdi-text-short me-1"></i>
                                        <span>{{ $testimonial->title }}</span>
                                    </div>
                                    <div class="mt-2 text-dark">
                                        {{ $testimonial->content }}
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6 ">
                                    <div class="p-3 border rounded-3 bg-white h-100 shadow-sm">
                                        <label class="small text-muted d-block text-uppercase fw-bold mb-2"
                                            style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                            <i class="mdi mdi-toggle-switch-outline me-1"></i>{{ __('testimonials.status') }}
                                        </label>
                                        <div>
                                            @include('dashboard.testimonials.parts.status', [
                                                'testimonial' => $testimonial,
                                            ])
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-3">
                                    <div class="p-3 border rounded-3 bg-light shadow-sm d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-white d-flex align-items-center justify-content-center me-3 border shadow-sm"
                                                style="width: 36px; height: 36px;">
                                                <i class="mdi mdi-calendar-clock text-primary fs-5"></i>
                                            </div>
                                            <div>
                                                <label class="small text-muted d-block text-uppercase fw-bold mb-0"
                                                    style="font-size: 0.7rem;">{{ __('testimonials.created_at') }}</label>
                                                <span class="fw-medium text-dark">{{ $testimonial->created_at }}</span>
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
                        <p class="text-muted">{{ __('testimonials.no_testimonials_found') ?? __('general.no_record_found') }}</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4 pagination-wrapper d-flex justify-content-end">
    {!! $testimonials->withQueryString()->links() !!}
</div>
