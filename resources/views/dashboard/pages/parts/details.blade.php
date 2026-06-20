<button type="button" class="btn btn-outline-info btn-sm btn-icon-text" data-bs-toggle="modal"
    data-bs-target="#fullScreenModal_{!! $page->id !!}">
    <i class="ti-fullscreen btn-icon-prepend"></i> {!! __('general.details') !!}
</button>

<!-- Modal -->
<div class="modal fade" id="fullScreenModal_{!! $page->id !!}" tabindex="-1" aria-labelledby="fullScreenModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fullScreenModalLabel"><i
                        class="ti-info-alt me-2"></i>{!! $page->title !!}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-2 border rounded bg-light">
                    {!! $page->getTranslation('details', Lang()) !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">{!! __('general.close') !!}</button>
            </div>
        </div>
    </div>
</div>
