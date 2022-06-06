@extends('layouts.app-coreui') 

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header content-center"><h4><strong>{{__('program.title_create')}}</strong></h4></div>
        <div class="card-body">
          <div class="row">
            <ul style="list-style-type:none">
            @foreach ($section as $s)
              @if (($role == 2 && in_array($s->id, $user_section)) || $role == 1)
              <li style="margin-bottom: 15pt">
                <h5>{{ $s->name }}</h5>
                <ul style="list-style-type:none">
                  <li><a href="#" class="open-modal program-sort" data-id="{{ $s->id }}">{{ __('program.sort') }}</a></li>
                  <li><a href="#" class="open-modal program-committee" data-id="{{ $s->id }}">{{ __('program.committee') }}</a></li>               
                </ul>
              </li>
              @endif
            @endforeach
            </ul>  
          </div>
          @include('program.modal.sort')
          @include('program.modal.committee')

          <script>
          $('.program-sort').on('click', function () {
            const loader = '<div class="d-flex justify-content-center">\n' +
                '   <div class="spinner-border" role="status">\n' +
                '   </div>\n' +
                '       </div>';
            $('#programSort .modal-body').html(loader);
            $('#programSort').modal('show');
            var program = $(this).data('id');
            $.get("/program-sort/" + program, function (data) {
              $('#modal-title-program-sort').html(data.title[0].name);
              $('#modal-body-program-sort').slideUp(300).html(data.body).fadeIn(300);
            });
          });
          </script>
          <script>
          $('.program-committee').on('click', function () {
            const loader = '<div class="d-flex justify-content-center">\n' +
                '   <div class="spinner-border" role="status">\n' +
                '   </div>\n' +
                '       </div>';
            $('#programCommittee .modal-body').html(loader);
            $('#programCommittee').modal('show');
            var program = $(this).data('id');
            $.get("/program-committee/" + program, function (data) {
              $('#modal-title-program-committee').html(data.title[0].name);
              $('#modal-body-program-committee').slideUp(300).html(data.body).fadeIn(300);
            });
          });
          </script>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
