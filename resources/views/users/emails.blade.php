@extends('layouts.app-coreui') 

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header content-center">
      <h4><strong>{{ __('users.emails') }}</strong></h4>
    </div>
    <div class="card-body">
      <ul style="list-style-type:none">
        @foreach ($section as $s)
        <li>
          <a href="#" style="font-size: 15pt" class="show-section">{{ $s->name }}</a>
          <div style="display: none; background: white; padding: 10px" class="show-table mb-3 px3 py3">
              {!! $s->email !!}
        </li>
        @endforeach
      </ul>  
    </div>
  </div>
</div>

<script>
$(function() {
  $('.show-section').on('click', function() {
    $(this).siblings('.show-table').toggle();
  });
});
</script>
@endsection