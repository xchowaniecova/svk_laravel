@extends('layouts.app-coreui') 

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        
        <div class="card-header"><h4><strong>{{__('registrations.titlee')}}</strong></h4>
          <div class="card-header-actions">
            <p>
              <b style="background-color: rgba(255, 255, 0, 0.264); padding:0 6pt">-</b> Príspevok nebol kontrolovaný<br>
              <b style="background-color: rgba(255, 166, 0, 0.248); padding:0 5pt">...</b> Prebieha recenzia príspevku<br>
              <b style="color: green; background-color:rgba(0, 128, 0, 0.141); padding:0 4.5pt">✓</b> Príspevok OK<br>
              <b style="color: red; background-color:rgba(255, 0, 0, 0.218); padding:0 5.5pt">x</b> Zamietnutý príspevok
            </p>
          </div>    
        </div>
        
        <div class="card-body">
          <div class="row">
            <table class="table table-responsive-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>{{__('registrations.name_contribution')}}</th>
                  <th>Autori</th>
                  <th>Pôvodná sekcia</th>
                  <th>Finálna sekcia</th>
                  <th>Email</th>
                  <th>PhD</th>
                  <th></th>
                  <th colspan="2"></th>
                </tr>
              </thead>
              <tbody> 
                @foreach ($registration as $r)  
               
                {{-- EDITOR --}}
                @if ($role == 2)
                  @foreach ($user_section as $us)
                  @if ($r->section_start_id == $us->section_start_id)
                    <tr>
                      <td>{{$r->id}}</td>
                      <td>{{$r->name_contribution}}</td>
                      <td>
                        @foreach ($authors as $a)
                        @if ($r->id == $a->reg_id)
                          {{$a->name}}&nbsp;{{$a->surname}}<br>
                        @endif
                        @endforeach
                      </td>
                      <td>{{$r->ssection}}</td>
                      <td>
                        @if ($r->section_final_id == NULL)
                          &nbsp;
                        @else
                          {{$r->fsection}}
                        @endif
                      </td>
                      <td>{{$r->email}}</td>
                      <td>{!! $r->phd ? '<strong><i>áno</i></strong>' : '<i>nie</i>' !!}</td>
                      <td>
                        <strong>
                          @if ($r->review == 1)
                            <div style="background-color: rgba(255, 255, 0, 0.264); padding:0 5pt">-</div>                          
                          @elseif ($r->review == 2)
                            <div style="color: green; background-color:rgba(0, 128, 0, 0.141); padding:0 5pt">✓</div>
                          @elseif ($r->review == 3)
                            <div style="background-color: rgba(255, 166, 0, 0.248); padding:0 5pt">...</div>
                          @elseif ($r->review == 4)
                          <div style="color: red; background-color:rgba(255, 0, 0, 0.218); padding:0 5pt">x</div>
                          @endif
                        </strong>
                      </td>
                      <td>
                        <a href="{{route('registration.edit', $r->id)}}" class="btn btn-primary btn-ghost-danger my-0 py-0">{{__('Upraviť')}}</a>    
                      </td>
                      <td>
                        {!! Form::open(array('route' => ['registration.destroy', $r->id], 'method'=>'DELETE')) !!}
                        {!! Form::submit(__('X'), array('class' => 'btn btn-danger btn-ghost-danger my-0 py-0', 'onclick' => 'return confirm("You are about to delete the registration.")' ))!!}
                        {!! Form::close() !!}  
                      </td>
                    </tr>  
                  @endif
                  @endforeach
                
                {{-- ADMIN --}}
                @elseif ($role == 1)
                  <tr>
                    <td>{{$r->id}}</td>
                    <td>{{$r->name_contribution}}</td>
                    <td>
                      @foreach ($authors as $a)
                      @if ($r->id == $a->reg_id)
                        {{$a->name}}&nbsp;{{$a->surname}}<br>
                      @endif
                      @endforeach
                    </td>
                    <td>{{$r->ssection}}</td>
                    <td>
                      @if ($r->section_final_id == NULL)
                        &nbsp;
                      @else
                        {{$r->fsection}}
                      @endif
                    </td>
                    <td>{{$r->email}}</td>
                    <td>{!! $r->phd ? '<strong><i>áno</i></strong>' : '<i>nie</i>' !!}</td>
                    <td>
                      <strong>
                        @if ($r->review == 1)
                          <div style="background-color: rgba(255, 255, 0, 0.264); padding:0 5pt">-</div>                          
                        @elseif ($r->review == 2)
                          <div style="color: green; background-color:rgba(0, 128, 0, 0.141); padding:0 5pt">✓</div>
                        @elseif ($r->review == 3)
                          <div style="background-color: rgba(255, 166, 0, 0.248); padding:0 5pt">...</div>
                        @elseif ($r->review == 4)
                        <div style="color: red; background-color:rgba(255, 0, 0, 0.218); padding:0 5pt">x</div>
                        @endif
                      </strong>
                    </td>
                    <td>
                      <a href="{{route('registration.edit', $r->id)}}" class="btn btn-primary btn-ghost-danger my-0 py-0">{{__('Upraviť')}}</a>    
                    </td>
                    <td>
                      {!! Form::open(array('route' => ['registration.destroy', $r->id], 'method'=>'DELETE')) !!}
                      {!! Form::submit(__('X'), array('class' => 'btn btn-danger btn-ghost-danger my-0 py-0', 'onclick' => 'return confirm("You are about to delete the registration.")' ))!!}
                      {!! Form::close() !!}  
                    </td>
                  </tr>  

                @endif
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
