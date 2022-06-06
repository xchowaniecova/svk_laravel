@extends('layouts.app-coreui') 

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        
        <div class="card-header content-center"><h4><strong>Pridať univerzitu</strong></h4>
          <div class="card-header-actions">
          </div>
        </div>
        
        <div class="card-body">
          
          {!! Form::open(array('route' => 'universities.store')) !!}
          
          <div class="row" style="margin-bottom: 10pt">
            <div class="col-sm-12">
              {{ Form::label('name', __('Názov univerzity')) }}:
              @if($errors->has('name'))
              {{ Form::text('name', '', ['class' => 'form-control is-invalid']) }}    
              @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              @else
              {{ Form::text('name', '', ['class' => 'form-control']) }}  
              @endif
            </div>
          </div>
          
          <div class="row" style="margin-bottom: 10pt">
            <div class="col-sm-12">
              {{ Form::label('name_en', __('faculties.name_en')) }}:
              @if($errors->has('name_en'))
              {{ Form::text('name_en', '', ['class' => 'form-control is-invalid']) }}    
              @error('name_en')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              @else
              {{ Form::text('name_en', '', ['class' => 'form-control']) }}  
              @endif
            </div>
          </div>            
          
          <div class="row" style="margin-bottom: 10pt">
            <div class="col-sm-12">
              {{ Form::label('shortcut', __('Skratka')) }}:
              @if($errors->has('shortcut'))
              {{ Form::text('shortcut', '', ['class' => 'form-control is-invalid']) }}    
              @error('shortcut')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              @else
              {{ Form::text('shortcut', '', ['class' => 'form-control']) }}  
              @endif
            </div>
          </div>  

          <div class="row">
            <div class="col-sm-12">
              @include('templates.form-select', ['space' => 'universities', 'tag' => 'country_id', 'list' => $listCountries])
            </div>
          </div>             
          
          
        </div>
        
        @can('create', \App\Models\Faculty::class)
            <div class="card-footer content-center">
            {{ Form::submit('Uložiť', array('class' => 'btn btn-sm btn-primary')) }}
            </div>
        @endcan            
        
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection
