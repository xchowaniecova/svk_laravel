@extends('layouts.app-coreui')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">

        <div class="card-header"><strong>{{__('section_finals.update')}}: {{$section->name}}</strong></div>
        
        <div class="card-body">
          
            {!! Form::model($section, ['route' => ['section_final.update', $section->id], 'method' => 'PUT']) !!}
            
            <div class="row">
              <div class="col-sm-12"  style="margin-bottom: 10pt">
                {{ Form::label('name', __('section_starts.name')) }}:
                {{ Form::text('name', $section->name ?? '', ['class' => 'form-control']) }}  
              </div>
            </div>
            
            <div class="row">
              <div class="col-sm-12"  style="margin-bottom: 10pt">
                {{ Form::label('name_en', __('section_starts.name_en')) }}:
                {{ Form::text('name_en', $section->name_en ?? '', ['class' => 'form-control']) }} 
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                  <div class="form-group">
                    {{ Form::label('admin', __('section_starts.admin')) }}:
                    {{ Form::select('admin', $listEditors, $admin->user_id ?? '', ['class' => 'form-control']) }}
                  </div>
              </div>
            </div> 
            
          </div>
          
        <div class="card-footer">
          {{ Form::submit(__('section_finals.update'), array('class' => 'btn btn-sm btn-primary')) }}
        </div>
        
        {!! Form::close() !!}

      </div>
    </div>
  </div>
</div>
@endsection