@extends('layouts.app-coreui') 

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <h1 style="text-align: center"></h1>
      <div class="card">
        
        <div class="card-header content-center"><h4><strong>{{ __('section_finals.classification_title') }}</strong></h4>
          <div class="card-header-actions"></div>
        </div>
        
        <div class="card-body">
          <div class="row">
            <ul style="list-style-type:none">
              @foreach ($section as $s)
              {{-- EDITOR --}}
              @if ($role == 2)
                  @foreach ($user_section as $us)
                  @if ($s[0]->id == $us->section_start_id)
                    <li>
                      <a href="#" style="font-size: 15pt" data-toggle="modal" data-target="#ModalClassificate_{{$s[0]->id}}">{{ $s[0]->sname }} ({{ $s[1][1] }}/{{ $s[1][0] }})</a><br>
                    </li>
                    @include('section_final.modal.classificate')
                  @endif
                  @endforeach
              {{-- ADMIN --}}
              @elseif ($role == 1)
                  <li>
                    <a href="#" style="font-size: 15pt" data-toggle="modal" data-target="#ModalClassificate_{{$s[0]->id}}">{{ $s[0]->sname }} ({{ $s[1][1] }}/{{ $s[1][0] }})</a><br>
                  </li>
                  @include('section_final.modal.classificate')
              @endif
              @endforeach
            </ul>    
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
