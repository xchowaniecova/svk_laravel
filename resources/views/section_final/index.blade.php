@extends('layouts.app-coreui') 

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">

        <div class="card-header content-center">
          <h4><strong>{{__('section_starts.title')}}</strong></h4> <br>
          @if($errors->any())
            {!! implode('', $errors->all('<div style="color:red"><strong>:message</strong></div>')) !!}
          @endif
        </div>
        
        <div class="card-body">
          <div class="row">
            <table class="table table-responsive-sm">
              <thead>
                <tr>
                  <th>{{ __('section_starts.name') }}</th>
                  <th>{{ __('section_starts.keep') }}</th>
                  <th>{{ __('section_starts.split') }}</th>
                  <th>{{ __('section_starts.combine') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($section as $s)
                  <tr>
                    <td>{{$s[0]->name}}  ({{ $s[1] }})</td>
                    <td><a href="#" class="btn btn-sm btn-primary open-modal section-keep" data-id="{{ $s[0]->id }}">{{ __('section_finals.k') }}</a></td>
                    <td><a href="#" class="btn btn-sm btn-success open-modal section-split" data-id="{{ $s[0]->id }}">{{ __('section_finals.s') }}</a></td>
                    <td><a href="#" class="btn btn-sm btn-secondary open-modal section-combine" data-id="{{ $s[0]->id }}">{{ __('section_finals.c') }}</a></td>
                  </tr>  
                @endforeach
              </tbody>
            </table>                   
            @include('section_final.modal.keep')
            @include('section_final.modal.split')
            @include('section_final.modal.combine')

            <script>
            $('.section-keep').on('click', function () {
              const loader = '<div class="d-flex justify-content-center">\n' +
                  '   <div class="spinner-border" role="status">\n' +
                  '   </div>\n' +
                  '       </div>';
              $('#sectionKeep .modal-body').html(loader);
              $('#sectionKeep').modal('show');
              var section = $(this).data('id');
              $.get("/section-keep/" + section, function (data) {
                console.log('data', data)
                var title = " {{ __('section_finals.keep') }}";
                $('#modal-title-section-keep').html(title + ': ' + data.title.name);
                $('#modal-body-section-keep').slideUp(300).html(data.body).fadeIn(300);
              });
            });
            </script>
            <script>
            $('.section-split').on('click', function () {
              const loader = '<div class="d-flex justify-content-center">\n' +
                  '   <div class="spinner-border" role="status">\n' +
                  '   </div>\n' +
                  '       </div>';
              $('#sectionSplit .modal-body').html(loader);
              $('#sectionSplit').modal('show');
              var section = $(this).data('id');
              $.get("/section-split/" + section, function (data) {
                var title = " {{ __('section_finals.split') }}";
                $('#modal-title-section-split').html(title + ': ' + data.title.name);
                $('#modal-body-section-split').slideUp(300).html(data.body).fadeIn(300);
              });
            });
            </script>
            <script>
            $('.section-combine').on('click', function () {
              const loader = '<div class="d-flex justify-content-center">\n' +
                  '   <div class="spinner-border" role="status">\n' +
                  '   </div>\n' +
                  '       </div>';
              $('#sectionCombine .modal-body').html(loader);
              $('#sectionCombine').modal('show');
              var section = $(this).data('id');
              $.get("/section-combine/" + section, function (data) {
                $('#modal-body-section-combine').slideUp(300).html(data.body).fadeIn(300);
              });
            });
            </script>            
          </div>
        </div>

      </div>
    </div>
  </div>

  

  {{-- Final Sections --}}
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">

        <div class="card-header content-center"><h4><strong>{{__('section_finals.title')}}</strong></h4></div>
        
        <div class="card-body">
          <div class="row">
            <table class="table table-responsive-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>{{__('section_finals.name')}}</th>
                  <th>{{__('section_finals.name_en')}}</th>
                  <th>{{ __('section_finals.sname') }}</th>
                  <th>{{ __('section_finals.admin_name') }}</th>
                  <th>{{ __('section_finals.admin_mail') }}</th>
                  <th colspan="2"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($fsection as $fs)
                <tr>
                  <td>{{ $fs->fid }}</td>
                  <td>{{ $fs->name }}</td>
                  <td>{{ $fs->name_en }}</td>
                  <td>{!! $fs->sname !!}</td>
                  <td>{{ $fs->uname }} {{  $fs->usurname }}</td>
                  <td>{{ $fs->email }}</td>
                  <td>
                    <a href="{{route('section_final.edit', $fs->fid)}}" class="btn btn-secondary btn-ghost-danger my-0 py-0">{{__('Upraviť')}}</a>
                  </td>
                  <td>
                    {!! Form::open(array('route' => ['section_final.destroy', $fs->fid], 'method'=>'DELETE')) !!}
                    {!! Form::submit(__('Odstrániť'), array('class' => 'btn btn-danger btn-ghost-danger my-0 py-0', 'onclick' => 'return confirm("You are about to delete the final section.")' ))!!}
                    {!! Form::close() !!}         
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
