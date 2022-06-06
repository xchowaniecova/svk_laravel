@extends('layouts.app-coreui')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">

        @if($create == true)
          {!! Form::open(array('route' => 'conference.store')) !!}
        @else
          {!! Form::model($conference, ['route' => ['conference.update', $conference->id], 'method' => 'PUT']) !!}
        @endif

        <div class="card-header">
          @if($create == true)
            {{ __('conference.create') }}
          @else
            {{ __('conference.update') }}
          @endif
        </div>
        
        <div class="card-body">
          
          <div class="row col-sm-8 mx-auto justify-content-center" style="margin-bottom:20pt">
            @if($create == true)
              <input type="text" class="form-control" name="name" placeholder="{{ __('conference.name') }}">
            @else
              <input type="text" class="form-control" name="name" value="{{ $name }}">
            @endif
          </div>

          <div class="row">
            <div class="col-sm-4 mx-auto justify-content-center">
              @include('templates.form-date', ['space' => 'conference', 'tag' => 'conf_date'])
            </div>
          </div> 

          <div class="row">
            <div class="col-sm-4 mx-auto">
              @include('templates.form-date', ['space' => 'conference', 'tag' => 'date_start'])
            </div>

            <div class="col-sm-4 mx-auto">
              @include('templates.form-date', ['space' => 'conference', 'tag' => 'date_end'])
            </div>
          </div>     
          
          <div class="row">
            <div class="col-sm-4 mx-auto">
              @include('templates.form-date', ['space' => 'conference', 'tag' => 'reg_start'])
            </div>

            <div class="col-sm-4 mx-auto">
              @include('templates.form-date', ['space' => 'conference', 'tag' => 'reg_end'])
            </div>
          </div>   
          
        </div>
        
        @can('create', \App\Models\Conference::class)
            <div class="card-footer">
            {{ Form::submit('Submit', array('class' => 'btn btn-sm btn-primary')) }}
            </div>
        @endcan            
        
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection
