@extends('layouts.app-coreui') 

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">

        <div class="card-header"><h4><strong>{{__('faculties.title')}}</strong></h4>
          &nbsp&nbsp        
          <div class="card-header-actions">
            @can('create', \App\Models\Faculty::class)
                <a href="{{route('faculties.create')}}">{{__('faculties.create')}}</a>
            @endcan
          </div>          
        </div>
        
        <div class="card-body">
          <div class="row">
            <table class="table table-responsive-sm yajra-datatable">
              <thead>
                <tr>
                    <th>{{__('faculties.name')}}</th>
                    <th>{{__('faculties.name_en')}}</th>
                    <th>{{__('faculties.university')}}</th>
                  @can('create', \App\Models\Faculty::class)
                    <th colspan="2"></th>
                  @endcan                     
                </tr>
              </thead>
              <tbody>
                @foreach ($faculties as $f)
                <tr>
                  <td>{{$f->name}}</td>
                  <td>{{$f->name_en}}</td>
                  <td>{{$f->university}}</td>
                  <td>
                  @can('update', $f)
                      <a href="{{route('faculties.edit', $f->id)}}" class="btn btn-primary btn-ghost-danger my-0 py-0">{{__('Upraviť')}}</a>
                  @endcan                 
                  </td>
                  <td>
                  @can('update', $f)
                    @if($f->deleted_at == null)
                    {!! Form::open(array('route' => ['faculties.destroy', $f->id], 'method'=>'DELETE')) !!}
                    {!! Form::submit(__('Odstrániť'), array('class' => 'btn btn-danger btn-ghost-danger my-0 py-0', 'onclick' => 'return confirm("You are about to delete the faculty.")' ))!!}
                    {!! Form::close() !!}     
                    @endif 
                  @endcan        
                  </td>
                </tr>                  
                @endforeach
              </tbody>
            </table>  
            
            {{ $faculties->links('vendor.pagination.bootstrap-4') }}
            
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

@endsection
