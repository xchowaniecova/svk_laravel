@extends('layouts.app-coreui') 

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        
        <div class="card-header"><strong>Classificate posts to the final sections</strong>
          <div class="card-header-actions"></div>
        </div>

        <div class="card-body">

            {!! Form::model($section, ['route' => ['section_final.store', $section->id], 'method' => 'PUT']) !!}

            <div class="row">
              <ul style="list-style-type:none">
                @foreach ($section as $s)
                  <li>
                      {{ $s->cname }}
                  </li>
                @endforeach
              </ul>    
            </div>

            {!! Form::close() !!}
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
