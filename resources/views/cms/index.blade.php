@extends('layouts.app-coreui') 

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
       
        <div class="card-header">
          <div class="card-header-actions">
            <a href="{{ route('cms-pages.create') }}">{{__('cms.create')}}</a>
          </div>
        </div>

        {!! Form::open(array('route' => 'cms-pages.sort')) !!}

        <div class="card-body">
          
            <table class="table table-responsive-sm">
              <thead>
                <tr>
                    <th>{{__('cms.order')}}</th>
                    <th>{{__('cms.title')}}</th>
                    <th>{{__('cms.slug')}}</th>
                    <th colspan="2">{{__('cms.status')}}</th>
                    <th></th>
                </tr>
              </thead>

              <tbody class="sortable ui-sortable">
                @php $i=1; @endphp
                @foreach ($pages as $p)
                  <tr class="ui-state-default ui-sortable-handle"  style="cursor:move" >
                    <input type="hidden" name="page_id[{{ $i }}]" value="{{ $p->id }}" /> 
                    <td><strong>{{$p->order}}.</strong></td>
                    <td>{{$p->title}}</td>
                    <td><a href="{{ $p->slug }}">{{ $p->slug }}</a></td>
                    <td>
                      @if ($p->status == 1)
                        <strong style="color: green">zverejnené</strong> 
                      @else
                        <strong style="color: red">skryté</strong> 
                      @endif
                    </td>
                    <td>
                      <input type="hidden" name="status[{{ $i }}]" value="0">
                      <input type="checkbox" name="status[{{ $i }}]" value="1" {{ ($p->status == 1) ? 'checked' : null}} />
                    </td>
                    <td>
                      @if ($p->editable == 1)
                        <a href="{{ route('cms-pages.edit', $p->id) }}" class="btn btn-secondary btn-ghost-danger my-0 py-0"><i class="bi bi-pencil"></i></a>
                      @endif
                    </td>
                  </tr>  
                  @php $i++; @endphp
                @endforeach
              </tbody>
            </table>   

          <script>
            $('.sortable').sortable({
                revert: true,
                cursor: 'move',
                opacity: 0.7,
            });
            $('tbody, tr').disableSelection();
          </script>    
          <style>
              tbody {counter-reset: item;}
          </style>
                      
        </div>

        <div class="card-footer content-center">          
          {{ Form::submit('Uložiť poradie a stav', array('class' => 'btn btn-sm btn-primary')) }}
          {!! Form::close() !!}      
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
