{{-- ID sekcie --}}
<input type="hidden" name="id" value="{{ $section->id }}">

{{-- Nazov sekcie --}}
<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="col-sm-12"  style="margin-bottom: 10pt">
        {{ Form::label('name', __('section_finals.name')) }}:
        @if($errors->has('name'))
        {{ Form::text('name', $section->name ?? '', ['class' => 'form-control is-invalid']) }}    
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        @else
        {{ Form::text('name', $section->name ?? '', ['class' => 'form-control']) }}  
        @endif
    </div>
</div>
    
{{-- EN nazov sekcie --}}
<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="col-sm-12"  style="margin-bottom: 10pt">
        {{ Form::label('name_en', __('section_finals.name_en')) }}:
        @if($errors->has('name_en'))
        {{ Form::text('name_en', $section->name_en ?? '', ['class' => 'form-control is-invalid']) }}    
        @error('name_en')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        @else
        {{ Form::text('name_en', $section->name_en ?? '', ['class' => 'form-control']) }}  
        @endif
    </div>
</div>    

{{-- Admin sekcie --}}
<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="col-sm-12"  style="margin-bottom: 10pt">
        <div class="form-group">
            {{ Form::label('user_id', __('section_finals.admin_name')) }}:
            @if($errors->has('user_id'))
            {{ Form::select('user_id', $listEditors, $section->user_id ?? '', ['class' => 'form-control is-invalid']) }}
            @error('user_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            @else
            {{ Form::select('user_id', $listEditors, $section->user_id ?? '', ['class' => 'form-control']) }}
            @endif
        </div>
    </div>
</div> 