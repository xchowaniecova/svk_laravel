<form action="{{ route('program.sort') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="ModalSort_{{$s->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
               
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('program.sort') }} pre {{ $s->name }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                
                <div class="modal-body">
                    <ol class="sortable ui-sortable">
                        @foreach ($registration as $r)
                        @if ($s->id == $r->id)
                            <li class="ui-state-default col-sm-12 ui-sortable-handle col-sm-12" style="margin-bottom:20pt; margin-top:20pt; cursor:move">
                                <input type="hidden" name="reg_id[]" value="{{ $r->reg_id }}">
                                <strong>{{ $r->name_contribution }}</strong><br>
                                {{ $r->surname }}
                            </li>
                        @endif
                        @endforeach
                    </ol>
                </div>   
                
    <script>
        $('.sortable').sortable({
            revert: true,
            cursor: 'move',
            opacity: 0.7,
        });
        $('ol, li').disableSelection();
    </script>    
    <style>
        ol {counter-reset: item;}
        ol li {display: block;}
        ol li:before {content: counter(item) ". "; counter-increment: item; font-weight: bold;}
    </style>
                                        
                <div class="modal-footer">

                    <div class="col-xs-12 col-sm-12 col-md-12 content-center">
                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">{{ __('Back') }}</button>
                        &nbsp;
                        <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>
