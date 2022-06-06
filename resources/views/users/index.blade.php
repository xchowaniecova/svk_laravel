@extends('layouts.app-coreui') 

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">

        {{-- Table of editors --}}
        <div class="card-header"><h4><strong>{{__('users.users')}}</strong></h4>
          <div class="card-header-actions">
            @can('create', \App\Models\User::class)
                <a href="{{route('users.create')}}">{{__('users.create')}}</a>
            @endcan
          </div>
        </div>
        
        <div class="card-body">
          <div class="row">
            <table class="table table-responsive-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>{{__('users.title1')}}</th>
                  <th>{{__('users.name')}}</th>
                  <th>{{__('users.surname')}}</th>
                  <th>{{__('users.title2')}}</th>
                  <th>{{__('users.email')}}</th> 
                  <th>{{__('users.role')}}</th> 
                  @can('create', \App\Models\User::class)             
                    <th colspan="2"></th>
                  @endcan
                </tr>
              </thead>
              <tbody>
                @foreach ($user as $u)
                  <tr>
                    <td>{{$u->id}}</td>
                    <td>{{$u->title1}}</td>
                    <td>{{$u->name}}</td>
                    <td>{{$u->surname}}</td>
                    <td>{{$u->title2}}</td>
                    <td>{{$u->email}}</td>
                    <td>{!! $u->role == 1 ? '<span>Admin</span>' : '<span>Editor</span>' !!}</td>
                                        
                    @can('user_edit')
                    <td>
                        <a href="{{route('users.edit', $u->id)}}" class="btn btn-primary btn-ghost-danger my-0 py-0">{{__('Upraviť')}}</a>
                    </td>
                    @endcan
                    
                    @can('user_delete')
                    <td>
                      {!! Form::open(array('route' => ['users.destroy', $u->id], 'method'=>'DELETE')) !!}
                      {!! Form::submit(__('Odstrániť'), array('class' => 'btn btn-danger btn-ghost-danger my-0 py-0', 'onclick' => 'return confirm("You are about to delete the user.")' ))!!}
                      {!! Form::close() !!}    
                    </td>
                    @endcan        
                     
                  </tr>                  
                @endforeach
              </tbody>

              
            </table>            
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
