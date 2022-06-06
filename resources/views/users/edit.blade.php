@extends('layouts.app-coreui') 

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header content-center"><h4><strong>Upraviť užívateľa: {{ $user->name }}</strong></h4>
          <div class="card-header-actions">
          </div>
        </div>
        
        <div class="card-body">
          
          {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT']) !!}

          <div class="row">
            <div class="col-sm-3">
              {{ Form::label('title1_id', __('users.title1')) }}:
              {{ Form::select('title1_id', $listTitles, $user->title1_id ?? '', ['class' => 'form-control']) }}
            </div>
          </div>  

          <div class="row">
            <div class="col-sm-12"  style="margin-bottom: 10pt">
              {{ Form::label('name', __('users.name')) }}:
              @if($errors->has('name'))
              {{ Form::text('name', $user->name ?? '', ['class' => 'form-control is-invalid']) }}    
              @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              @else
              {{ Form::text('name', $user->name ?? '', ['class' => 'form-control']) }}  
              @endif
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12"  style="margin-bottom: 10pt">
              {{ Form::label('surname', __('users.surname')) }}:
              @if($errors->has('surname'))
              {{ Form::text('surname', $user->surname ?? '', ['class' => 'form-control is-invalid']) }}    
              @error('surname')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              @else
              {{ Form::text('surname', $user->surname ?? '', ['class' => 'form-control']) }}  
              @endif
            </div>
          </div>
          
          <div class="row">
            <div class="col-sm-3">
              {{ Form::label('title2_id', __('users.title2')) }}:
              {{ Form::select('title2_id', $listTitles2, $user->title2_id ?? '', ['class' => 'form-control']) }}
            </div>
          </div>  

          <div class="row">
            <div class="col-sm-12"  style="margin-bottom: 10pt">
              {{ Form::label('email', __('users.email')) }}:
              @if($errors->has('email'))
              {{ Form::text('email', $user->email ?? '', ['class' => 'form-control is-invalid']) }}    
              @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              @else
              {{ Form::text('email', $user->email ?? '', ['class' => 'form-control']) }}  
              @endif
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <input type="checkbox" value="1" name="role" {{ ($user->role == 1) ? 'checked' : ''}}>&nbsp;Admin
            </div>
          </div>                    
          
        </div>
        
        @can('create', \App\Models\User::class)
            <div class="card-footer content-center">
            {{ Form::submit('Upraviť', array('class' => 'btn btn-sm btn-primary')) }}
            </div>
        @endcan            
        
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection
