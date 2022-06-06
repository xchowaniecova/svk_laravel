@extends('layouts.app-coreui') 

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">

          <div class="card-header content-center"><h4><strong>Prezenčné listiny a protokoly na stiahnutie</strong></h4></div>
          
          <div class="card-body">
            <div class="row">
  
                <ul style="list-style-type:none">
                    @foreach ($section as $s)
                      <li style="margin-bottom: 15pt">
                        <h5>{{ $s->name }}</h5>
                        <ul style="list-style-type:none">
                          <li><a href='{{url("doc.store1/{$s->id}")}}'>Prezenčná listina</a></li>
                          <li><a href='{{url("doc.store2/{$s->id}")}}'>Protokol</a></li>
                        </ul>
                      </li>
                    @endforeach
                </ul>  
  
            </div>
          </div>
  
      </div>
    </div>
  </div>
</div>
@endsection
