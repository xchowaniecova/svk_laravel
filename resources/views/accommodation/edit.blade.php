@extends('layouts.app-coreui') 

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header content-center"><h4><strong>{{ __('accommodation.upd_acc') }}</strong></h4>
          <div class="card-header-actions">
          </div>
        </div>
        
        <div class="card-body">
          
          {!! Form::model($accommodation, ['route' => ['accommodation.update', $accommodation->id], 'method' => 'PUT']) !!}
          
          <div class="row">
            <div class="col-sm-12">
              <label class="radio-inline"><strong>{{ __('accommodation.nights') }}:</strong></label>&nbsp;&nbsp;&nbsp;&nbsp;
              <label class="radio-inline"><input type="checkbox" name="acc1" value="1"{{ ($accommodation->accommodation1) ? ' checked' : '' }} /> {{ $date1 }} - {{ $date2 }} &nbsp;&nbsp;&nbsp;&nbsp;</label>
              <label class="radio-inline"><input type="checkbox" name="acc2" value="1"{{ ($accommodation->accommodation2) ? ' checked' : '' }} /> {{ $date2 }} - {{ $date3 }} </label>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <label class="radio-inline"><strong>{{ __('accommodation.position') }}:</strong></label>&nbsp;&nbsp;&nbsp;&nbsp;
              <label class="radio-inline"><input type="radio" name="position" value="0"{{ ($accommodation->position == 0) ? ' checked' : '' }} /> {{ __('accommodation.student') }} &nbsp;&nbsp;&nbsp;&nbsp;</label>
              <label class="radio-inline"><input type="radio" name="position" value="1"{{ ($accommodation->position == 1) ? ' checked' : '' }} /> {{ __('accommodation.graduant') }} &nbsp;&nbsp;&nbsp;&nbsp;</label>
              <label class="radio-inline"><input type="radio" name="position" value="2"{{ ($accommodation->position == 2) ? ' checked' : '' }} /> {{ __('accommodation.teacher') }} </label>
            </div>
          </div>                    
          
        </div>
        
        <div class="card-footer content-center">
          {{ Form::submit(__('accommodation.update'), array('class' => 'btn btn-sm btn-primary')) }}
        </div>
    
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection