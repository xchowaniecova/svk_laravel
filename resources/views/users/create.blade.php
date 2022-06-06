@extends('layouts.app-coreui') 

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header content-center"><h4><strong>{{ __('users.create') }}</strong></h4>
          <div class="card-header-actions">
          </div>
        </div>
        
        <div class="card-body">
          
          {!! Form::open(array('route' => 'users.store')) !!}

          <div class="row">
            <div class="col-sm-3">
              @include('templates.form-select', ['space' => 'titles', 'tag' => 'title1', 'list' => $listTitles])
            </div>
          </div>  
          
          <div class="row">
            <div class="col-sm-12">
              @include('templates.form-text', ['space' => 'users', 'tag' => 'name'])
            </div>
          </div>
          
          <div class="row">
            <div class="col-sm-12">
              @include('templates.form-text', ['space' => 'users', 'tag' => 'surname'])
            </div>
          </div> 
          
          <div class="row">
            <div class="col-sm-3">
              @include('templates.form-select', ['space' => 'titles', 'tag' => 'title2', 'list' => $listTitles2])
            </div>
          </div>  
          
          <div class="row">
            <div class="col-sm-6">
              @include('templates.form-text', ['space' => 'users', 'tag' => 'email'])
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <input type="hidden" value="0" name="role" />
              <input type="checkbox" value="1" name="role" />
              <label name="role">{{ _('users.admin') }}</label>
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
