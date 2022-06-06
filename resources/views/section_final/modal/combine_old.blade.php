<form action="{{ route('section_start.combine') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="ModalCombine_{{$s->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('section_finals.combine') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                
                <div class="modal-body">
                    
                    {{-- Nazov SK a EN --}}
                    <div class="row col-xs-12 col-sm-12 col-md-12" style="margin-top: 10pt">
                        <div class="col-sm-12" style="margin-bottom: 5pt">
                            <input type="text" name="name" class="form-control" placeholder="{{ __('section_finals.name') }}"/>
                        </div>
                        <div class="col-sm-12" style="margin-bottom: 5pt">
                            <input type="text" name="name_en" class="form-control" placeholder="{{ __('section_finals.name_en') }}"/>
                        </div>
                    </div>
                    
                    {{-- Admin sekcie --}}
                    <div class="row col-xs-12 col-sm-12 col-md-12">
                        <div class="col-sm-12"  style="margin-bottom: 10pt">
                            <select class="form-control" name="user_id">
                                <option value="0">{{ __('section_finals.admin_name') }}</option>
                                @foreach ($admins as $item)
                                <option value="{{ $item->id }}">{{ $item->name }} {{ $item->surname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Miestnost --}}
                    {{-- <div class="row col-xs-12 col-sm-12 col-md-12">
                        <div class="col-sm-5" style="margin-bottom: 5pt">
                            <input type="text" name="room" class="form-control" placeholder="{{ __('section_finals.room') }}"/>
                        </div>
                        <div class="col-sm-6">
                            <input type="hidden" name="type" value="0" />
                            <input type="checkbox" name="type" value="1" />
                            <label for="type">{{  __('section_finals.type') }}</label>
                        </div>
                    </div> --}}

                    {{-- Zoznam sekcii na spojenie --}}
                    <div class="row col-xs-12 col-sm-12 col-md-12">
                        <div class="col-sm-12">
                            <div style="margin-top:10pt; margin-bottom:10pt;">
                                <strong>{{ __('section_finals.sections_to_combine') }}</strong>
                            </div>
                            @foreach ($section as $s)
                                <input type="checkbox" name="section_start_id[]" value="{{ $s->id }}" />
                                <label for="type">{{ $s->name }}</label> <br>
                            @endforeach
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