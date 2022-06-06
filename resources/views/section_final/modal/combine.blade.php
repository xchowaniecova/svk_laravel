<div class="modal fade" id="sectionCombine" tabindex="-1" role="dialog" aria-hidden="true">
    <form action="{{ route('section_start.combine') }}" method="post">
    {{ csrf_field() }}
        <div class="modal-dialog" style="max-width: 1500px"  role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title-section-combine">{{ __('section_finals.combine') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body-section-combine">
                </div>
                <div class="modal-footer" id="modal-footer-section-combine">
                    <div class="col-xs-12 col-sm-12 col-md-12 content-center">
                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">{{ __('Späť') }}</button>
                        &nbsp;
                        <button type="submit" class="btn btn-success">{{ __('Uložiť') }}</button>
                    </div>
                </div>            
            </div>
        </div>
    </form>
</div>