@extends('layouts.app-coreui')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">

        <div class="card-header content-center"><h4>{{__('Upraviť')}}: <strong>{{$universities->name}}</strong></h4>
          <div class="card-header-actions">
          </div>
        </div>
        
        <div class="card-body">
          
            {!! Form::model($universities, ['route' => ['universities.update', $universities->id], 'method' => 'PUT']) !!}
            
            <div class="row" style="margin-bottom: 10pt">
              <div class="col-sm-12">
                {{ Form::label('name', __('Názov univerzity')) }}:
                @if($errors->has('name'))
                {{ Form::text('name', $universities->name ?? '', ['class' => 'form-control is-invalid']) }}    
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @else
                {{ Form::text('name', $universities->name ?? '', ['class' => 'form-control']) }}  
                @endif
              </div>
            </div>
            
            <div class="row" style="margin-bottom: 10pt">
              <div class="col-sm-12">
                {{ Form::label('name_en', __('faculties.name_en')) }}:
                @if($errors->has('name_en'))
                {{ Form::text('name_en', $universities->name_en ?? '', ['class' => 'form-control is-invalid']) }}    
                @error('name_en')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @else
                {{ Form::text('name_en', $universities->name_en ?? '', ['class' => 'form-control']) }}  
                @endif
              </div>
            </div>  
            
            <div class="row" style="margin-bottom: 10pt">
              <div class="col-sm-12">
                {{ Form::label('shortcut', __('Skratka')) }}:
                @if($errors->has('shortcut'))
                {{ Form::text('shortcut', $universities->shortcut ?? '', ['class' => 'form-control is-invalid']) }}    
                @error('shortcut')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @else
                {{ Form::text('shortcut', $universities->shortcut ?? '', ['class' => 'form-control']) }}  
                @endif
              </div>
            </div>  

            <div class="row">
              <div class="col-sm-12">
                {{ Form::label('country_id', __('faculties.country_id')) }}:
                @if($errors->has('country_id'))
                {{ Form::select('country_id', $listCountries, $universities->country_id ?? '', ['class' => 'form-control is-invalid']) }}
                @error('country_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @else
                {{ Form::select('country_id', $listCountries, $universities->country_id ?? '', ['class' => 'form-control']) }}
                @endif
              </div>
            </div>    
                          
            
          </div>
          
        <div class="card-footer content-center">
          {{ Form::submit(__('faculties.update'), array('class' => 'btn btn-sm btn-primary')) }}
        </div>
        
        {!! Form::close() !!}

      </div>
    </div>
  </div>
</div>
@endsection