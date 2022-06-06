@extends('layouts.app-coreui') 

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">

        <div class="card-header"><h4><strong>{{__('section_starts.title')}}</strong></h4>
          <div class="card-header-actions">
            @can('section_create')
                <a href="{{route('section_start.create')}}">{{__('section_starts.create')}}</a>
            @endcan
          </div>
        </div>
        
        <div class="card-body">
          <div class="row">
            <table class="table table-responsive-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>{{__('section_starts.name')}}</th>
                  <th>{{__('section_starts.name_en')}}</th>
                  <th>{{__('section_starts.admin')}}</th>
                  <th colspan="2"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($section as $s)
                  <tr>
                    <td>{{$s->id}}</td>
                    <td>{{$s->name}}</td>
                    <td>{{$s->name_en}}</td>
                    <td>{{$s->uname}} {{$s->surname}}</td>
                    <td>
                    @can('section_edit')
                      <a href="{{route('section_start.edit', $s->id)}}" class="btn btn-secondary btn-ghost-danger my-0 py-0">{{__('section_starts.edit')}}</a>
                    @endcan
                    </td>
                    <td>
                    @can('section_destroy')
                      {!! Form::open(array('route' => ['section_start.destroy', $s->id], 'method'=>'DELETE')) !!}
                      {!! Form::submit(__('section_starts.delete'), array('class' => 'btn btn-danger btn-ghost-danger my-0 py-0', 'onclick' => 'return confirm("You are about to delete the user.")' ))!!}
                      {!! Form::close() !!}         
                    @endcan
                    </td> 
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
