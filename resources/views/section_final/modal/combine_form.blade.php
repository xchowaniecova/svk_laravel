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
            @foreach ($listEditors as $key => $item)
                <option value="{{ $key }}">{{ $item }}</option>
            @endforeach
        </select>
    </div>
</div>

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