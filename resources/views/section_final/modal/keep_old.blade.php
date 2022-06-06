<form action="{{ route('section_start.keep') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="ModalKeep_{{$s[0]->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
               
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('section_finals.keep') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
               
                <div class="modal-body">
                    
                    {{-- ID sekcie --}}
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="col-sm-3"  style="margin-bottom: 10pt">
                          {{ Form::label('id', __('section_finals.id')) }}:
                          {{ Form::text('id', $s[0]->id ?? '', ['class' => 'form-control','readonly']) }}
                        </div>
                    </div>

                    {{-- Nazov sekcie --}}
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="col-sm-12"  style="margin-bottom: 10pt">
                          {{ Form::label('name', __('section_finals.name')) }}:
                          @if($errors->has('name'))
                          {{ Form::text('name', $s[0]->name ?? '', ['class' => 'form-control is-invalid']) }}    
                          @error('name')
                          <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                          @else
                          {{ Form::text('name', $s[0]->name ?? '', ['class' => 'form-control']) }}  
                          @endif
                        </div>
                    </div>
                      
                    {{-- EN nazov sekcie --}}
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="col-sm-12"  style="margin-bottom: 10pt">
                          {{ Form::label('name_en', __('section_finals.name_en')) }}:
                          @if($errors->has('name_en'))
                          {{ Form::text('name_en', $s[0]->name_en ?? '', ['class' => 'form-control is-invalid']) }}    
                          @error('name_en')
                          <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                          @else
                          {{ Form::text('name_en', $s[0]->name_en ?? '', ['class' => 'form-control']) }}  
                          @endif
                        </div>
                    </div>    
                    
                    {{-- Admin sekcie --}}
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="col-sm-12"  style="margin-bottom: 10pt">
                            <div class="form-group">
                                {{ Form::label('user_id', __('section_finals.admin_name')) }}:
                                @if($errors->has('user_id'))
                                {{ Form::select('user_id', $listEditors, $s[0]->user_id ?? '', ['class' => 'form-control is-invalid']) }}
                                @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @else
                                {{ Form::select('user_id', $listEditors, $s[0]->user_id ?? '', ['class' => 'form-control']) }}
                                @endif
                            </div>
                        </div>
                    </div> 

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