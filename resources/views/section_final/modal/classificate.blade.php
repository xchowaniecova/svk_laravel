<form action="{{ route('section_start.classificate') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="ModalClassificate_{{$s[0]->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 1500px"  role="document">
            <div class="modal-content">
               
                <div class="modal-header">
                    <div class="modal-title"><h4>{{ __('section_finals.sname') }}: <strong>{{ $s[0]->sname }} ({{ $s[1][1] }}/{{ $s[1][0] }})</strong></h4></div>
                </div>
               
                <div class="modal-body">
                    
                    @foreach ($registration as $r)
                        @if ($s[0]->id == $r->id)
                        <div class="row" style="margin-bottom:10pt">
                            <div class="col-sm-6">                                
                                <input type="hidden" value="{{ $r->reg_id }}" name="reg_id[]" />
                                <h5>[{{ $r->reg_id }}] <strong>{{ $r->name_contribution }}</strong></h5>
                                {{ $r->surname }}
                            </div>  
                            <div class="col-sm-6">
                                @if($r->section_final_id == null)
                                    {{ Form::label('fsection[]', __('section_finals.fsection')) }}:
                                    <select class="form-control" name="fsection[]" style="border:solid">
                                        <option></option>
                                        @foreach ($fsection as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    {{ Form::label('fsection[]', __('section_finals.fsection')) }}:
                                    {{ Form::select('fsection[]', $listSectionFinal, $r->section_final_id ?? '', ['class' => 'form-control']) }}
                                @endif
                            </div>
                        </div>
                        @endif
                    @endforeach

                </div> 
                
                <div class="modal-footer">
                    <div class="col-xs-12 col-sm-12 col-md-12 content-center">
                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">{{ __('Späť') }}</button>
                        &nbsp;
                        <button type="submit" class="btn btn-success">{{ __('Uložiť') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>