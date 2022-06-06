<div class="form-group">
  {{ Form::label($tag, __($space.'.'.$tag)) }}:
  @if($errors->has($tag))
  {{ Form::text($tag, $$space[$tag] ?? '', ['class' => 'form-control is-invalid']) }}
  @error($tag)
  <div class="invalid-feedback">{{ $message }}</div>
  @enderror
  @else
  {{ Form::text($tag, $$space[$tag] ?? '', ['class' => 'form-control']) }}
  @endif
</div>

