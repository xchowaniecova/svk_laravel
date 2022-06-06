@extends('layouts.app-cms')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">

      {{-- Review card --}}
      @if ($role <= 2)
        @include('registration.review.review')
      @elseif($role == 3)
      <h5 class="content-center" style="margin-bottom:20pt"><strong>
        @if ($registration->review == 1)
          <div style="color: rgb(137, 134, 0)">Príspevok zatiaľ nebol kontrolovaný.</div>                          
        @elseif ($registration->review == 2)
          <div style="color: rgb(0, 116, 0)">Príspevok bol schválený.</div>
        @elseif ($registration->review == 3)
          <div style="color: rgb(177, 86, 0)">!!! Príspevok je potrebné upraviť podľa zadaných kritérií !!!</div>
        @elseif ($registration->review == 4)
          <div style="color: rgb(171, 2, 2)">Príspevok nebol schválený.</div>
        @endif
      </strong></h5>
      @endif  
      
      {{-- Post edit card --}}
      <div class="card">

        <div class="card-header content-center">
        @if ($role <= 2)
          <h4>{{__('registrations.update')}}:<strong> {{$registration->name_contribution}} #{{$registration->id}}</strong></h4><hr>
        @else
          <h4>{{__('registrations.update')}}:<strong> {{$registration->name_contribution}}</h4><hr>
        @endif
        </div>
        
        <div class="card-body">
          
            {!! Form::model($registration, ['route' => ['registration.update', $registration->id], 'files' => true, 'enctype' => 'multipart/form-data', 'method' => 'PUT']) !!}
            
            {{-- Contribution name and section --}}
            <div class="row">
                <div class="col-sm-6">
                  <strong>{{ Form::label('name_contribution', __('registrations.name_contribution')) }}:</strong>
                </div>
                <div class="col-sm-6">
                  <strong>{{ Form::label('section_start_id', __('registrations.section')) }}:</strong>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                  @if($errors->has('name_contribution'))
                    {{ Form::text('name_contribution', $registration->name_contribution ?? '', ['class' => 'form-control is-invalid']) }}
                    @error('name_contribution')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @else
                    {{ Form::text('name_contribution', $registration->name_contribution ?? '', ['class' => 'form-control']) }}
                    @endif
                </div>
                <div class="col-sm-6">
                  {{ Form::select('section_start_id', $listSectionStart, $registration->section_start_id ?? '', ['class' => 'form-control']) }}
                </div>
            </div>

            {{-- PhD (checkbox) --}}
            <div class="row" style="margin-top:10pt; margin-bottom:10pt">
                <div class="col-sm-12">
                  <strong>{{ Form::checkbox('phd') }} {{  __('registrations.phd') }}</strong>
                </div>
            </div>

            {{-- Authors --}}
            <div class="row justify-content-center text-dark" style="background: #eeeded">
                <div style="margin:10pt 0pt"><h3>{{ __('registrations.authors') }}</h3></div>
    
                <table class="table bordered-none" id="dynamicAddRemove">
                  <tr>
                    <th colspan="2">{{ __('registrations.t1') }}</th>
                    <th>{{ __('users.name') }}</th>
                    <th>{{ __('users.surname') }}</th>
                    <th colspan="2">{{ __('registrations.t2') }}</th>
                  </tr> 
                  @php $order = 0; @endphp
                  @foreach ($authors as $key=>$a)
                  <tr>  
                    <td> 
                      {{ Form::select('title1_id[]', $listTitles, $a->title1_id ?? '', ['class' => 'form-control']) }}
                    </td>
                    <td><input type="text" name="title1[]" class="form-control" value="{{ $a->title1 }}" /></td>  
                    <td><input type="text" name="name[]" class="form-control" value="{{ $a->name }}" /></td>  
                    <td><input type="text" name="surname[]" class="form-control" value="{{ $a->surname }}" /></td>  
                    <td>
                      {{ Form::select('title2_id[]', $listTitles2, $a->title2_id ?? '', ['class' => 'form-control']) }}
                    </td>
                    <td><input type="text" name="title2[]" class="form-control" value="{{ $a->title2 }}"/></td>
                    <td><input type="radio" id="option2" name="status" value="0" {{ ($a->presentation=="1")? "checked" : "" }} /></td>
                    <td>
                        @if($order)
                        <button type="button" class="btn btn-sm btn-danger remove-tr">x</button>
                        @endif
                    </td>
                  </tr>
                  @php $order++; @endphp
                  @endforeach 
                </table> 
                <div class="mt-0 mb-3">
                  <button type="button" name="add" id="add-btn" class="btn btn-sm btn-success">{{  __('registrations.add_author') }}</button>
                </div>
            </div>

    <script type="text/javascript">
        var i = 0;
        $("#add-btn").click(function(){
            ++i;
            $("#dynamicAddRemove").append(
            '<tr> <td><select class="form-control" name="title1_id[]"> \
                    <option value="0"></option> \
                    @foreach ($title1 as $item) \
                    <option value="{{ $item->id }}">{{ $item->title }}</option> \
                    @endforeach \
                </select></td>\
                <td><input type="text" name="title1[]" class="form-control" /></td> \
                <td><input type="text" name="name[]" class="form-control" /></td> \
                <td><input type="text" name="surname[]" class="form-control" /></td> \
                <td><select class="form-control" name="title2_id[]"> \
                    <option value="0"></option> \
                    @foreach ($title2 as $item) \
                    <option value="{{ $item->id }}">{{ $item->title }}</option> \
                    @endforeach \
                </select></td> \
                <td><input type="text" name="title2[]" class="form-control" /></td> \
                <td><input type="radio" name="presentation" value="'+i+'" /></td> \
                <td><button type="button" class="btn btn-danger remove-tr">x</button></td></tr> ');
        });
        $(document).on('click', '.remove-tr', function(){  
            $(this).parents('tr').remove();
        });  
    </script> 

            {{-- Abstract pdf --}}
            <div class="row" style="margin-top: 20pt">
                <div class="col-sm-12">
                  <div class="form-group" id="upload-file">
                    <label name="abstract_file"><strong>{{ __('registrations.abstract_file') }}:</strong></label>
                    <input type="file" name="abstract_file" id="abstract_file">
                    <br>
                    <a href="/download/{{ $registration->id }}/{{ $registration->abstract_storage_file }}" target="_blank">{{ $registration->abstract_original_file }}</a>
                    @error('file')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
            </div>

             {{-- Personal info --}} 
          <div class="text-dark" style="background: #eeeded"> <hr>
            <div class="row justify-content-center">
              <h3>{{ __('registrations.personal') }}</h3>
            </div>
            <hr>
            
            {{-- IBAN a SWIFT --}}
            <div class="row">
              <div class="col-sm-6">
                  <div class="form-group">
                      <strong>{{ Form::label('iban', __('registrations.iban')) }}:</strong>
                      @if($errors->has('iban'))
                      {{ Form::text('iban', $registration->iban ?? '', ['class' => 'form-control is-invalid']) }}
                      @error('iban')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                      @else
                      {{ Form::text('iban', $registration->iban ?? '', ['class' => 'form-control']) }}
                      @endif
                  </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                    <strong>{{ Form::label('swift', __('registrations.swift')) }}:</strong>
                    @if($errors->has('swift'))
                    {{ Form::text('swift', $registration->swift ?? '', ['class' => 'form-control is-invalid']) }}
                    @error('swift')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @else
                    {{ Form::text('swift', $registration->swift ?? '', ['class' => 'form-control']) }}
                    @endif
                </div>
              </div>
            </div>

            <hr>
          </div>            
        </div>

        <div class="card-footer content-center">
          @if ($role <= 2)
            {{ Form::submit(__('registrations.update'), array('class' => 'btn btn-sm btn-primary')) }}
          @elseif ($role == 3)
            @if ($registration->review == 1)
              {{ Form::submit(__('registrations.update'), array('class' => 'btn btn-sm btn-primary')) }}             
            @elseif ($registration->review == 2)
            @elseif ($registration->review == 3)
              {{ Form::submit(__('registrations.update'), array('class' => 'btn btn-sm btn-primary')) }}
            @elseif ($registration->review == 4)
            @endif            
          @endif
          
        </div>
        
        {!! Form::close() !!}

      </div>

    </div>
  </div>
</div>
@endsection