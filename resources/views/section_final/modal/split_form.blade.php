{{-- ID sekcie --}}
<input type="hidden" name="id" value="{{ $section->id }}">
    
{{-- 1. Nova sekcia --}}
<div id="dynamicAdd">
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
                @foreach ($listEditors as $key => $item)
                <option value="{{ $key }}">{{ $item }}</option>
                @endforeach
            </select>
        </div>
    </div>
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
                @foreach ($listEditors as $key => $item)
                <option value="{{ $key }}">{{ $item }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>