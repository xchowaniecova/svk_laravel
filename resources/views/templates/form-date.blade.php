@php
  $v = Carbon\Carbon::parse($$space[$tag] ?? now())->toDate();;
@endphp
<div class="form-group">
  {{ Form::label($tag, __($space.'.'.$tag)) }}:
  @if($errors->has($tag))
  {{ Form::date($tag,$v,['class' => 'form-control is-invalid']) }}
  @error($tag)
  <div class="invalid-feedback">{{ $message }}</div>
  @enderror
  @else
  {{ Form::date($tag,$v,['class' => 'form-control']) }}
  @endif
</div>


