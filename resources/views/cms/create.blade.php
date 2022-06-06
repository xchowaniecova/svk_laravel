@extends('layouts.app-cms')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        
        {!! Form::open(array('route' => 'cms-pages.store')) !!}
       
        
        <div class="card-header">  
          <a class="bi bi-backspace-fill" href="{{ url()->previous() }}"> Späť</a>    
        </div>
        
        <div class="card-body">
          
          <div class="row">
            <div class="col-sm-12">
              @include('templates.form-text', ['space' => 'cms', 'tag' => 'title'])
            </div>
            <div class="col-sm-12">
              @include('templates.form-text', ['space' => 'cms', 'tag' => 'title_nav'])
            </div>
          </div>
          
          <div class="row">
            <div class="col-sm-12">
              @include('templates.form-text', ['space' => 'cms', 'tag' => 'slug'])
            </div>
          </div>

          <div class="form-group">
            <label for="content1">{{ __('cms.content1') }}</label>
            <textarea class="form-control" name="content1" id="summernote"></textarea>
          </div>
          
        </div>
        <div class="card-footer content-center">
          <div class="row">
            <div class="col-sm-6">
              {{ Form::submit('Vytvoriť', array('class' => 'btn btn-sm btn-primary')) }}
            </div>
          </div>
        </div>
        
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

<script>
  $('#summernote').summernote({
    placeholder: 'Vložte obsah stránky..',
    tabsize: 2,
    height: 400
  });
</script>

@endsection


