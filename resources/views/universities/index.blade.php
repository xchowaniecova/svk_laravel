@extends('layouts.app-coreui') 

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header"><h4><strong>{{__('Univerzity')}}</strong></h4>
          &nbsp&nbsp
        
          <div class="card-header-actions">
            @can('create', \App\Models\University::class)
                <a href="{{route('universities.create')}}">{{__('Vytvoriť novú univerzitu')}}</a>
            @endcan
          </div>
          
        </div>
        
        <div class="card-body">
          <div class="row">
            <table class="table table-responsive-sm yajra-datatable">
              <thead>
                <tr>
                    <th>{{__('Názov univerzity')}}</th>
                    <th>{{__('Názov v angličtine')}}</th>
                    <th>{{__('Skratka')}}</th>
                    <th>{{__('Štát')}}</th>
                  @can('create', \App\Models\Faculty::class)
                    <th colspan="2"></th>
                  @endcan                     
                </tr>
              </thead>
              <tbody>
                @foreach ($universities as $u)
                <tr>
                  <td>{{$u->name}}</td>
                  <td>{{$u->name_en}}</td>
                  <td>{{$u->shortcut}}</td>
                  <td>{{$u->country}}</td>
                  <td>
                  @can('update', $u)
                      <a href="{{route('universities.edit', $u->id)}}" class="btn btn-primary btn-ghost-danger my-0 py-0">{{__('Upraviť')}}</a>
                  @endcan                 
                  </td>
                  <td>
                  @can('update', $u)
                    @if($u->deleted_at == null)
                    {!! Form::open(array('route' => ['universities.destroy', $u->id], 'method'=>'DELETE')) !!}
                    {!! Form::submit(__('Odstrániť'), array('class' => 'btn btn-danger btn-ghost-danger my-0 py-0', 'onclick' => 'return confirm("You are about to delete the faculty.")' ))!!}
                    {!! Form::close() !!}     
                    @endif 
                  @endcan        
                  </td>
                </tr>                  
                @endforeach
              </tbody>
            </table>  
            
            {{ $universities->links('vendor.pagination.bootstrap-4') }}
            
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
