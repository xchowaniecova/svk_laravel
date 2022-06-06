<form action="{{ route('program.committee') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="ModalCommittee_{{$s->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
               
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('program.committee') }} pre <strong>{{ $s->name }}</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>

    <style>
        .noborder td, .noborder th {
            border: none !important;
        }
    </style>
               
                <div class="modal-body" style="padding-bottom: 20pt">
                    <input type="hidden" name="section_final_id" value="{{ $s->id }}" />
                    <table class="table noborder">
                        <tr>
                            <th></th> {{-- Clenovia --}}
                            <th>{{ __('program.members') }}</th>
                            <th>{{ __('program.workplaces') }}</th>
                            <th></th> {{-- Miesto pracoviska --}}
                        </tr>

                        @php $key = 0; @endphp
                        @foreach ($committee as $c)
                        @if ($s->id == $c->section_final_id)
                            <tr>
                                @if ($key)
                                    <td>{{ $key }}. {{ __('program.member') }}:</td>
                                @else
                                    <td>{{ __('program.chairman') }}:</td>
                                @endif
                                <td><input type="text" name="name[{{ $key }}]" class="form-control" value="{{ $c->member_name ?? $c->member_name }}"/></td>
                                <td><input type="text" name="workplace[{{ $key }}]" class="form-control" value="{{ $c->workplace_name ?? $c->workplace_name }}" /></td>
                                <td>
                                    <input type="hidden" name="member_order[{{ $key }}]" value="{{ $key }}" />
                                    <label class="radio-inline"><input type="radio" name="state[{{ $key }}]" value="0" {{ ($c->workplace_state == 0) ? 'checked' : '' }} /> FCHPT &nbsp;&nbsp;</label>
                                    <label class="radio-inline"><input type="radio" name="state[{{ $key }}]" value="1" {{ ($c->workplace_state == 1) ? 'checked' : '' }} /> SR &nbsp;&nbsp;</label>
                                    <label class="radio-inline"><input type="radio" name="state[{{ $key }}]" value="2" {{ ($c->workplace_state == 2) ? 'checked' : '' }} /> ČR &nbsp;&nbsp;</label>
                                </td>
                            </tr>
                            @php $key++; @endphp
                        @endif
                        @endforeach
                            @for ($i = $key; $i <= 7; $i++)
                            {{-- x.clen --}}
                            <tr>
                                @if ($i == 0)
                                    <td>{{ __('program.chairman') }}:</td>
                                @else
                                    <td>{{ $i }}. {{ __('program.member') }}:</td>
                                @endif
                                <td><input type="text" name="name[{{ $i }}]" class="form-control" /></td>
                                <td><input type="text" name="workplace[{{ $i }}]" class="form-control" /></td>
                                <td>
                                    <input type="hidden" name="member_order[{{ $i }}]" value="{{ $i+1 }}" />
                                    <label class="radio-inline"><input type="radio" name="state[{{ $i }}]" value="0" checked /> FCHPT &nbsp;&nbsp;</label>
                                    <label class="radio-inline"><input type="radio" name="state[{{ $i }}]" value="1" /> SR &nbsp;&nbsp;</label>
                                    <label class="radio-inline"><input type="radio" name="state[{{ $i }}]" value="2" /> ČR &nbsp;&nbsp;</label>
                                </td>
                            </tr>
                            @endfor
                    </table>  
                    
                    <hr>

                    {{-- Spravca miestnosti --}}
                    <div class="row" style="padding-left: 15pt; padding-top: 20pt">
                        <label class="col-sm-2.5"><strong>Spravca miestnosti:</strong></label>
                        <div class="col-sm-5">
                            <input class="form-control" type="text" name="admin_name" placeholder="Meno a priezvisko" value="{{ ($s->admin_name == null) ? '' : $s->admin_name }}"/>
                        </div>
                        <div class="col-sm-5">
                            <input class="form-control" type="text" name="admin_email" placeholder="Email" value="{{ ($s->admin_email == null) ? '' : $s->admin_email }}"/>
                        </div>
                    </div>
                    {{-- Miestnost --}}
                    <div class="row" style="padding-left: 15pt; margin-top:20pt">
                        <label class="radio-inline"><strong>Typ prezentovania:</strong></label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <label class="radio-inline"><input type="radio" id="type0" name="type" value="0" onchange="valueChanged()" {{ ($s->type == 0) ? 'checked' : '' }}/> Prezenčne &nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <label class="radio-inline"><input type="radio" id="type1" name="type" value="1" onchange="valueChanged()" {{ ($s->type == 1) ? 'checked' : '' }}/> Online &nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <label class="radio-inline"><input type="radio" id="type2" name="type" value="2" onchange="valueChanged()" {{ ($s->type == 2) ? 'checked' : '' }}/> Hybridná forma</label>
                    </div>
                    <div class="row justify-content-center mt-3">
                        {{-- Miestnost --}}
                        <div id="t0" class="row"> 
                            <label class="col-sm-2.5"><strong>Miestnost:</strong></label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="room" id="room" value="{{ ($s->room == null) ? '' : $s->room }}" />
                            </div>
                        </div>
                        {{-- Online miesnost --}}
                        <div id="t1" class="row"> 
                            <label class="col-sm-2.5"><strong>Online miestnost:</strong></label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="room_online" id="room_online" placeholder="url adresa" value="{{ ($s->room_online == null) ? '' : $s->room_online }}" />
                            </div>
                        </div>
                    </div>                      
                </div>

    <script type="text/javascript">
        valueChanged()
        function valueChanged()
        {
            if($('#type0').is(":checked"))   
                $("#t0").show();
            else
                $("#t0").hide();

            if($('#type1').is(":checked"))   
                $("#t1").show();
            else
                $("#t1").hide();

            if($('#type2').is(":checked")) {
                $("#t0").show();
                $("#t1").show();
            }
        }
    </script>
                                        
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