<input type="hidden" name="section_final_id" value="{{ $section[0]->id }}" />
<table class="table noborder">
    <thead>
        <tr>
            <th></th>
            <th>{{ __('program.members') }}</th>
            <th>{{ __('program.workplaces') }}</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @for ($i = 0; $i <= 7; $i++)
        <tr>
            @if ($i)
            <td>{{ $i }}. {{ __('program.member') }}:</td>
            @else
            <td>{{ __('program.chairman') }}:</td>
            @endif

            @if(isset($committee[$i]->id))
            <td><input type="text" name="name[{{ $i }}]" class="form-control" value="{{ $committee[$i]->member_name ?? $committee[$i]->member_name }}"/></td>
            <td><input type="text" name="workplace[{{ $i }}]" class="form-control" value="{{ $committee[$i]->workplace_name ?? $committee[$i]->workplace_name }}" /></td>
            <td>
                <input type="hidden" name="member_order[{{ $i }}]" value="{{ $i }}" />
                <label class="radio-inline"><input type="radio" name="state[{{ $i }}]" value="0" {{ ($committee[$i]->workplace_state == 0) ? 'checked' : '' }} /> FCHPT &nbsp;&nbsp;</label>
                <label class="radio-inline"><input type="radio" name="state[{{ $i }}]" value="1" {{ ($committee[$i]->workplace_state == 1) ? 'checked' : '' }} /> SR &nbsp;&nbsp;</label>
                <label class="radio-inline"><input type="radio" name="state[{{ $i }}]" value="2" {{ ($committee[$i]->workplace_state == 2) ? 'checked' : '' }} /> ČR &nbsp;&nbsp;</label>
            </td>
            @else
            <td><input type="text" name="name[{{ $i }}]" class="form-control" /></td>
            <td><input type="text" name="workplace[{{ $i }}]" class="form-control" /></td>
            <td>
                <input type="hidden" name="member_order[{{ $i }}]" value="{{ $i+1 }}" />
                <label class="radio-inline"><input type="radio" name="state[{{ $i }}]" value="0" checked /> FCHPT &nbsp;&nbsp;</label>
                <label class="radio-inline"><input type="radio" name="state[{{ $i }}]" value="1" /> SR &nbsp;&nbsp;</label>
                <label class="radio-inline"><input type="radio" name="state[{{ $i }}]" value="2" /> ČR &nbsp;&nbsp;</label>
            </td>
            @endif    

        </tr>
        @endfor
    <tbody>
</table>

{{-- Spravca miestnosti --}}
<div class="row" style="padding-left: 15pt; padding-top: 20pt">
    <label class="col-sm-2.5"><strong>Správca miestnosti:</strong></label>
    <div class="col-sm-5">
        <input class="form-control" type="text" name="admin_name" placeholder="Meno a priezvisko" value="{{ ($section[0]->admin_name == null) ? '' : $section[0]->admin_name }}"/>
    </div>
    <div class="col-sm-5">
        <input class="form-control" type="text" name="admin_email" placeholder="Email" value="{{ ($section[0]->admin_email == null) ? '' : $section[0]->admin_email }}"/>
    </div>
</div>
{{-- Miestnost --}}
<div class="row" style="padding-left: 15pt; margin-top:20pt">
    <label class="radio-inline"><strong>Typ prezentovania:</strong></label>&nbsp;&nbsp;&nbsp;&nbsp;
    <label class="radio-inline"><input type="radio" id="type0" name="type" value="0" onchange="valueChanged()" {{ ($section[0]->type == 0) ? 'checked' : '' }}/> Prezenčne &nbsp;&nbsp;&nbsp;&nbsp;</label>
    <label class="radio-inline"><input type="radio" id="type1" name="type" value="1" onchange="valueChanged()" {{ ($section[0]->type == 1) ? 'checked' : '' }}/> Online &nbsp;&nbsp;&nbsp;&nbsp;</label>
    <label class="radio-inline"><input type="radio" id="type2" name="type" value="2" onchange="valueChanged()" {{ ($section[0]->type == 2) ? 'checked' : '' }}/> Hybridná forma</label>
</div>
<div class="row justify-content-center mt-3">
    {{-- Miestnost --}}
    <div id="t0" class="row"> 
        <label class="col-sm-2.5"><strong>Miestnosť:</strong></label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="room" id="room" value="{{ ($section[0]->room == null) ? '' : $section[0]->room }}" />
        </div>
    </div>
    {{-- Online miesnost --}}
    <div id="t1" class="row"> 
        <label class="col-sm-2.5"><strong>Online miestnosť:</strong></label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="room_online" id="room_online" placeholder="url adresa" value="{{ ($section[0]->room_online == null) ? '' : $section[0]->room_online }}" />
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