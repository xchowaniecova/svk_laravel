@extends('layouts.app-coreui')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        
        {!! Form::open(array('route' => 'section_start.store')) !!}
       
        
        <div class="card-header content-center">
          <h4><strong>        
          {{ __('section_starts.create') }}
        </strong></h4>
        </div>
        
        <div class="card-body">
          
          <div class="row">
            <div class="col-sm-12">
              @include('templates.form-text', ['space' => 'section_starts', 'tag' => 'name'])
            </div>
          </div>
          
          <div class="row">
            <div class="col-sm-12">
              @include('templates.form-text', ['space' => 'section_starts', 'tag' => 'name_en'])
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              @include('templates.form-select', ['space' => 'section_starts', 'tag' => 'admin', 'list' => $listEditors])
            </div>
          </div>  
          
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col-sm-12 content-center">
              {{ Form::submit('Uložiť', array('class' => 'btn btn-sm btn-primary')) }}
            </div>
          </div>
        </div>
        
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection
