@extends('layouts.app-coreui') 

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">      
      <div class="card">
        <div class="card-header"><h4><strong>{{__('conference.title')}}</strong></h4>
          <div class="card-header-actions">
            @can('create', \App\Models\Conference::class)
                <a href="{{route('conference.create')}}">{{__('conference.create')}}</a>
            @endcan
          </div>
        </div>
        
        <div class="card-body">

          <div class="row justify-content-center"><h3>{{ $order }}. {{ __('conference.year') }} - {{ $name }}</h3></div>
          <hr>
          <div class="row justify-content-center"><b>{{__('conference.date')}}:</b> &nbsp {{Carbon\Carbon::parse($conf_date)->tz('Europe/Berlin')->format('d.m.Y')}}</div>
          <hr>
          <div class="row justify-content-center"><b>{{__('conference.date_start')}}:</b> &nbsp {{Carbon\Carbon::parse($conf1)->tz('Europe/Berlin')->format('d.m.Y')}}</div><br>
          <div class="row justify-content-center" style="margin-bottom: 20px;"><b>{{__('conference.date_end')}}:</b> &nbsp {{Carbon\Carbon::parse($conf2)->tz('Europe/Berlin')->format('d.m.Y')}}</div>
          <hr>
          <div class="row justify-content-center"><b>{{__('conference.reg_start')}}:</b> &nbsp {{Carbon\Carbon::parse($reg1)->tz('Europe/Berlin')->format('d.m.Y')}}</div><br>
          <div class="row justify-content-center" style="margin-bottom: 20px;"><b>{{__('conference.reg_end')}}:</b> &nbsp {{Carbon\Carbon::parse($reg2)->tz('Europe/Berlin')->format('d.m.Y')}}</div>

          <div class="row justify-content-center" style="margin-bottom: 20px;">
            @can('update', $actualConf)                  
              <a href="{{route('conference.edit', $actualConf->id)}}" class="btn btn-primary btn-ghost-primary my-0 py-0">{{__('edit')}}</a>
              &nbsp&nbsp
              {!! Form::open(array('route' => ['conference.destroy', $actualConf->id], 'method'=>'DELETE')) !!}
              {!! Form::submit(__('delete'), array('class' => 'btn btn-danger btn-ghost-danger my-0 py-0', 'onclick' => 'return confirm("You are about to delete the faculty.")' ))!!}
              {!! Form::close() !!}
            @endcan
          </div>

          <div class="row">
            <table class="table table-responsive-sm">
              <thead>
                <tr>
                  <th>{{ __('conference.order') }}</th>
                  <th>{{ __('conference.name') }}</th>
                  <th>{{ __('conference.date_start') }}</th>
                  <th>{{ __('conference.date_end') }}</th>
                  <th>{{ __('conference.reg_start') }}</th>
                  <th>{{ __('conference.reg_end') }}</th>
                  <th>{{ __('conference.date') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($conferences as $c)
                <tr>
                  <td>{{ $c->order }}.</td>
                  <td>{{ $c->name }}</td>
                  <td>{{Carbon\Carbon::parse($c->date_start)->tz('Europe/Berlin')->format('d.m.Y')}}</td>
                  <td>{{Carbon\Carbon::parse($c->date_end)->tz('Europe/Berlin')->format('d.m.Y')}}</td>
                  <td>{{Carbon\Carbon::parse($c->reg_start)->tz('Europe/Berlin')->format('d.m.Y')}}</td>
                  <td>{{Carbon\Carbon::parse($c->reg_end)->tz('Europe/Berlin')->format('d.m.Y')}}</td>
                  <td>
                    @if ($loop->last)
                      <b>{{Carbon\Carbon::parse($c->conf_date)->tz('Europe/Berlin')->format('d.m.Y')}}</b>
                    @else
                      {{Carbon\Carbon::parse($c->conf_date)->tz('Europe/Berlin')->format('d.m.Y')}}
                    @endif
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
