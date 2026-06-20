<div class="modal fade" id="flagsReferenceModal" tabindex="-1" role="dialog" aria-labelledby="flagsReferenceModalLabel"
    aria-hidden="true" style="z-index: 1600;">
    <div class="modal-dialog modal-dialog-centered custom-modal-md" role="document">
        <div class="modal-content shadow-premium border-0">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title d-flex align-items-center" id="flagsReferenceModalLabel">
                    <span class="card-icon-premium me-2">
                        <i class="mdi mdi-flag-variant-outline"></i>
                    </span>
                    <span class="fw-bold">{!! __('addresses.flag_codes_reference') !!}</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body pt-3">
                <!-- Search Box -->
                <div class="form-group mb-4 theme-primary px-1">
                    <div class="input-group-premium shadow-sm">
                        <span class="input-group-text"><i class="mdi mdi-magnify"></i></span>
                        <input type="text" id="flagSearchInput" class="form-control"
                            placeholder="{!! __('addresses.search_for_country') !!}">
                    </div>
                </div>

                <div class="table-responsive table-responsive-custom" style="max-height: 400px;">
                    <table class="table table-hover align-middle mb-0" id="flagsRefTable">
                        <thead>
                            <tr>
                                <th class="text-start" style="width: 50px;">#</th>
                                <th class="text-start" style="width: 60px;">{!! __('general.flag') !!}</th>
                                <th class="text-start">{!! __('addresses.country_name') !!}</th>
                                <th class="text-center" style="width: 100px;">{!! __('addresses.flag_code') !!}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Table rows will be populated by JS -->
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer border-top-0 pt-0">
                <button type="button" class="btn btn-sm btn-light text-muted fw-bold px-3" data-bs-dismiss="modal">
                    {!! __('general.close') !!}
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            const tbody = $('#flagsRefTable tbody');
            const searchInput = $('#flagSearchInput');
            let targetInputId = '';
            const currentLocale = "{!! app()->getLocale() !!}";

            // Function to render table
            function renderFlagsTable(filter = '') {
                tbody.empty();
                const filtered = window.CountriesISOData.filter(item => {
                    const searchStr = (item.name_en + item.name_ar + item.code).toLowerCase();
                    return searchStr.includes(filter.toLowerCase());
                });

                if (filtered.length === 0) {
                    tbody.append(
                        `<tr><td colspan="4" class="text-center py-5 text-muted small">
                            <i class="mdi mdi-alert-circle-outline d-block mb-2 font-24"></i>
                            {!! __('general.no_record_found') !!}
                        </td></tr>`
                    );
                    return;
                }

                filtered.forEach((item, index) => {
                    const countryName = currentLocale === 'ar' ? item.name_ar : item.name_en;
                    const subName = currentLocale === 'ar' ? item.name_en : item.name_ar;
                    const row = `
                <tr class="select-flag-row" data-code="${item.code}" style="cursor: pointer;">
                    <td class="text-start py-3">${index + 1}</td>
                    <td class="text-start py-3">
                        <span class="flag-icon flag-icon-${item.code.toLowerCase()} shadow-sm rounded-1" style="width: 24px; height: 16px;"></span>
                    </td>
                    <td class="text-start py-3">
                        <div class="d-flex flex-column">
                            <span class="text-dark fw-bold mb-0" style="font-size: 0.95rem;">${countryName}</span>
                            <span class="text-muted" style="font-size: 0.75rem; letter-spacing: 0.2px;">${subName}</span>
                        </div>
                    </td>
                    <td class="text-center py-3">
                        <span class="badge badge-light-premium px-3 py-2 text-primary font-monospace" style="font-size: 0.8rem; border: 1px dashed #dee2e6;">${item.code}</span>
                    </td>
                </tr>
            `;
                    tbody.append(row);
                });
            }

            // Initial render
            renderFlagsTable();

            // Search event
            searchInput.on('input', function() {
                renderFlagsTable($(this).val());
            });

            // Handle Open Modal from button
            $(document).on('click', '.open-flags-reference', function() {
                targetInputId = $(this).data('target-input');
                $('#flagsReferenceModal').modal('show');
            });

            // Z-index fix for stacked modals backdrop
            $('#flagsReferenceModal').on('show.bs.modal', function() {
                setTimeout(function() {
                    $('.modal-backdrop').last().css('z-index', 1590);
                }, 0);
            });

            // Handle Selection
            $(document).on('click', '.select-flag-row', function() {
                const code = $(this).data('code');
                $(`#${targetInputId}`).val(code.toLowerCase()).trigger('change');
                $('#flagsReferenceModal').modal('hide');
            });
        });
    </script>
@endpush
