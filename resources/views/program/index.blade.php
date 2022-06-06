@extends('layouts.app-coreui') 

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header content-center">
      <h2 class="mt-2"><strong>{{ __('program.title_index') }}</strong></h2>
    </div>
    <div class="card-body">
    <ul style="list-style-type:none">
      @foreach ($section as $s)
      <li>
        <a href="#" style="font-size: 15pt" class="show-section">{{ $s->name }}</a>   
        <div style="display: none; background: white; padding: 10px" class="show-table mb-3 px3 py3">
          <h5 class="mb-2 mt-2">Zloženie komisie:</h5>
          <ol>
          @foreach ($committee as $c)
          @if ($s->id == $c->section_final_id)
            <li>{{ $c->member_name }} ({{ $c->workplace_name }}@if ($c->member_order == 0), <i>{{ __('program.chairman') }}</i>@endif)</li>         
          @endif
          @endforeach
          </ol>

          @if ($s->room) 
          <h5 class="mb-1 mt-2">Miestnosť:</h5>
          <div class="ml-4">{{ $s->room }}</div>
          @endif

          @if ($s->room_online) 
          <h5 class="mb-1 mt-2">Online miestnosť:</h5>
          <div class="ml-4"><a href="{{ $s->room_online }}" target="_blank">{{ $s->room_online }}</a></div>
          @endif
          
          @if ($s->admin_name)         
          <h5 class="mb-1 mt-2">Správca miestnosti:</h5>
          <div class="ml-4"><a href="mailto:{{ $s->admin_email }}">{{ $s->admin_name }}</a></div>
          @endif
          <h5 class="mb-2 mt-2">Program sekcie:</h5>
          <table class="table table-striped mt-2 mb-2">
            <thead>
              <tr>
                <th>#</th>
                <th>Čas</th>
                <th>Prezentujúci</th>
                <th>Názov príspevku</th>
              </tr>
            </thead>
            <tbody>
              @php $i = 0 @endphp
              @foreach ($registration as $r)
              @if ($r != null)
              @if ($s->id == $r->id)
              <tr>
                <td style="width: 5%">{{ $r->order }}{{ ($r->phd) ? '* ' : '' }}</td>
                <td style="width: 10%; white-space: nowrap;">{!! $startLectures[$i] !!}</td>
                <td style="width: 20%; white-space: nowrap;">{{ $r->surname }}</td>
                <td style="width: 65%">{{ $r->name_contribution }}</td>
              </tr>
              @php $i = $i+1 @endphp
              @endif
              @endif
              @endforeach
            </tbody>
          </table>
          <div><small class="text-secondary" style="text-decoration: overline">&nbsp; * doktorandský príspevok (nesúťažný)</small></div> 
        </div>  
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