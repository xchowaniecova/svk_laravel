@extends('layouts.app-coreui') 

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">

        <div class="card-header content-center"><h4><strong>{{__('results.title')}}</strong></h4></div>
        
        <div class="card-body">
          <div class="row">

            <ul style="list-style-type:none">
              @foreach ($section as $s)
              {{-- EDITOR --}}
              @if ($role == 2)
                @foreach ($user_section as $us)
                @if ($s->id == $us->section_final_id)
                  <li>
                    <a href="#" style="font-size: 15pt" data-toggle="modal" data-target="#ModalResult_{{$s->id}}">{{ $s->fname }}</a><br>
                  </li>
                  @include('results.modal.results')
                @endif
                @endforeach
              @elseif ($role == 1)
                <li>
                  <a href="#" style="font-size: 15pt" data-toggle="modal" data-target="#ModalResult_{{$s->id}}">{{ $s->fname }}</a><br>
                </li>
                @include('results.modal.results')
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
