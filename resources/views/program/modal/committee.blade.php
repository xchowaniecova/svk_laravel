<div class="modal fade" id="programCommittee" tabindex="-1" role="dialog" aria-hidden="true">
    <form action="{{ route('program.committee') }}" method="post">
    {{ csrf_field() }}
        <div class="modal-dialog" style="max-width: 1500px"  role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title-program-committee"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body-program-committee">
                </div>
                <div class="modal-footer" id="modal-footer-program-committee">
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