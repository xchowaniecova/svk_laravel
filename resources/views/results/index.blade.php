@extends('layouts.app-coreui') 

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header content-center">
      <h2 class="mt-2"><strong>{{ __('results.title') }}</strong></h2>
    </div>
    <div class="card-body">
      <ul style="list-style-type:none">
        @foreach ($section as $s)
        <li>
          <a href="#" style="font-size: 15pt" class="show-section">{{ $s->fname }}</a>
          <div style="display: none; background: white; padding: 10px" class="show-table mb-3 px3 py3">
          <table class="table table-striped mt-2 mb-2">
            <thead>
                <tr>
                    <th>Por.</th>
                    <th>Prezentujúci</th>
                    <th>Názov príspevku</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($registration as $r)
                @if ($s->id == $r->id)
                @if ($r->placement > 0) 
                <tr>
                    <td style="width: 5%">{{ $r->placement }}</td>
                    <td style="width: 20%; white-space: nowrap;">{{ $r->surname }}</td>
                    <td style="width: 75%">{{ $r->name_contribution }}</td>
                </tr>
                @endif
                @endif
                @endforeach
            </tbody>
          </table>
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