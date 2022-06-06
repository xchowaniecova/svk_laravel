@extends('layouts.app-coreui') 

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header content-center"><h4><strong>{{__('registrations.titlee')}}</strong></h4>
        </div>
        
        <div class="card-body">
          <div class="row">
            <table class="table table-responsive-sm">
              <thead>
                <tr>
                  <th>{{__('registrations.name_contribution')}}</th>
                  <th>{{ __('registrations.authors') }}</th>
                  <th>{{ __('registrations.section') }}</th>
                  <th>{{ __('registrations.faculty') }}</th>
                  <th>{{ __('registrations.phd') }}</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($registration as $r)
                <tr>
                  <td>{{$r->name_contribution}}</td>
                  <td>
                    @foreach ($authors as $a)
                     @if ($r->id == $a->reg_id)
                       {{$a->name}}&nbsp;{{$a->surname}}<br>
                     @endif
                    @endforeach
                  </td>
                  <td>
                    {{ ($r->fsection == null) ? $r->section : $r->fsection }}
                  </td>
                  <td>{{$r->faculty}} ({{ $r->uni }})</td>
                  <td>{!! $r->phd ? '<strong>✓</strong>' : '' !!}</td>
                  <td>
                    <strong>                       
                      @if ($r->review == 2)
                        <div style="color: green; background-color:rgba(0, 128, 0, 0.141); padding:0 5pt">✓</div>
                      @elseif ($r->review == 4)
                      <div style="color: red; background-color:rgba(255, 0, 0, 0.218); padding:0 5pt">x</div>
                      @endif
                    </strong>
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
