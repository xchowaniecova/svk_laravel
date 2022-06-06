<form action="{{ route('section_start.split') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="ModalSplit_{{$s->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('section_finals.split') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                
                <div class="modal-body">
                    
                    {{-- Needitovatelna cast --}}
                    <div class="row col-xs-12 col-sm-12 col-md-12">
                        <div class="col-sm-3"  style="margin-bottom: 5pt">
                            {{ Form::label('id', __('section_finals.id')) }}:
                        </div>
                        <div class="col-sm-3"  style="margin-bottom: 5pt">
                            {{ Form::label('name', __('section_finals.sname')) }}:
                        </div>
                    </div>
                    <div class="row col-xs-12 col-sm-12 col-md-12">
                        <div class="col-sm-3"  style="margin-bottom: 10pt">
                            {{ Form::text('id', $s->id ?? '', ['class' => 'form-control','readonly']) }}
                        </div>
                        <div class="col-sm-9"  style="margin-bottom: 10pt">
                            {{ Form::text('name', $s->name ?? '', ['class' => 'form-control','readonly']) }}
                        </div>
                    </div>
                      
                    {{-- 1. Nova sekcia --}}
                    <div id="dynamicAdd">
                        <hr>
                        <div class="row col-xs-12 col-sm-12 col-md-12" style="margin-top: 10pt">
                            <div class="col-sm-12" style="margin-bottom: 5pt">
                                <input type="text" name="name[1]" class="form-control" placeholder="{{ __('section_finals.name') }}"/>
                            </div>
                            <div class="col-sm-12" style="margin-bottom: 5pt">
                                <input type="text" name="name_en[1]" class="form-control" placeholder="{{ __('section_finals.name_en') }}"/>
                            </div>
                        </div>
                        
                        <div class="row col-xs-12 col-sm-12 col-md-12">
                            <div class="col-sm-12"  style="margin-bottom: 10pt">
                                <select class="form-control" name="user_id[1]">
                                    <option value="0">{{ __('section_finals.admin_name') }}</option>
                                    @foreach ($admins as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} {{ $item->surname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- <div class="row col-xs-12 col-sm-12 col-md-12">
                            <div class="col-sm-5" style="margin-bottom: 5pt">
                                <input type="text" name="room[1]" class="form-control" placeholder="{{ __('section_finals.room') }}"/>
                            </div>
                            <div class="col-sm-6">
                                <input type="hidden" name="type[1]" value="0" />
                                <input type="checkbox" name="type[1]" value="1" />
                                <label for="type">{{  __('section_finals.type') }}</label>
                            </div>
                        </div> --}}
                    </div>

                    {{-- 2. Nova sekcia --}}
                    <div id="dynamicAdd">
                        <hr>
                        <div class="row col-xs-12 col-sm-12 col-md-12" style="margin-top: 10pt">
                            <div class="col-sm-12" style="margin-bottom: 5pt">
                                <input type="text" name="name[2]" class="form-control" placeholder="{{ __('section_finals.name') }}"/>
                            </div>
                            <div class="col-sm-12" style="margin-bottom: 5pt">
                                <input type="text" name="name_en[2]" class="form-control" placeholder="{{ __('section_finals.name_en') }}"/>
                            </div>
                        </div>
                        
                        <div class="row col-xs-12 col-sm-12 col-md-12">
                            <div class="col-sm-12"  style="margin-bottom: 10pt">
                                <select class="form-control" name="user_id[2]">
                                    <option value="0">{{ __('section_finals.admin_name') }}</option>
                                    @foreach ($admins as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} {{ $item->surname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- <div class="row col-xs-12 col-sm-12 col-md-12">
                            <div class="col-sm-5" style="margin-bottom: 5pt">
                                <input type="text" name="room[2]" class="form-control" placeholder="{{ __('section_finals.room') }}"/>
                            </div>
                            <div class="col-sm-6">
                                <input type="hidden" name="type[2]" value="0" />
                                <input type="checkbox" name="type[2]" value="1" />
                                <label for="type">{{  __('section_finals.type') }}</label>
                            </div>
                        </div> --}}
                    </div>

                    {{-- 3. Nova sekcia --}}
                    {{-- <div id="dynamicAdd">
                        <hr>
                        <div class="row col-xs-12 col-sm-12 col-md-12" style="margin-top: 10pt">
                            <div class="col-sm-12" style="margin-bottom: 5pt">
                                <input type="text" name="name[3]" class="form-control" placeholder="{{ __('section_finals.name') }}"/>
                            </div>
                            <div class="col-sm-12" style="margin-bottom: 5pt">
                                <input type="text" name="name_en[3]" class="form-control" placeholder="{{ __('section_finals.name_en') }}"/>
                            </div>
                        </div>
                        
                        <div class="row col-xs-12 col-sm-12 col-md-12">
                            <div class="col-sm-12"  style="margin-bottom: 10pt">
                                <select class="form-control" name="user_id[3]">
                                    <option value="0">{{ __('section_finals.admin_name') }}</option>
                                    @foreach ($admins as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} {{ $item->surname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row col-xs-12 col-sm-12 col-md-12">
                            <div class="col-sm-5" style="margin-bottom: 5pt">
                                <input type="text" name="room[3]" class="form-control" placeholder="{{ __('section_finals.room') }}"/>
                            </div>
                            <div class="col-sm-6">
                                <input type="hidden" name="type[3]" value="0" />
                                <input type="checkbox" name="type[3]" value="1" />
                                <label for="type">{{  __('section_finals.type') }}</label>
                            </div>
                        </div>
                    </div> --}}
                 
                    {{-- <div class="form-group">
                        <table class="table bordered-none" id="dynamicAddRemove">
                        <tbody>
                            <tr>
                                <td><input type="text" name="name[]" class="form-control" placeholder="{{ __('section_finals.name') }}"/></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="name_en[]" class="form-control" placeholder="{{ __('section_finals.name_en') }}"/></td>
                            </tr>
                            <tr>
                                <td><select class="form-control" name="user_id[]">
                                    @foreach ($admins as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} {{ $item->surname }}</option>
                                    @endforeach
                                </select></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="name[]" class="form-control" placeholder="{{ __('section_finals.name') }}"/></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="room[]" class="form-control" placeholder="{{ __('section_finals.room') }}"/></td>
                                <td>{{ Form::checkbox('type[]') }} {{  __('section_finals.type') }}</td>
                            </tr>
                            <tr><button type="button" name="add" id="add-btn" class="btn btn-secondary">Dalsia sekcia</button></tr>
                        </tbody>
                        </table>
                    </div> --}}

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