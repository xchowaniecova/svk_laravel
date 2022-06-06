@extends('layouts.app-coreui') 

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">

        <div class="card-header"><strong>{{ __('registrations.title') }}</strong>
            @if($errors->any())
              {!! implode('', $errors->all('<div style="color:red"><strong>:message</strong></div>')) !!}
            @endif          
        </div>

        <div class="card-body">
          
          {!! Form::open(array('route' => 'registration.store', 'files' => true, 'enctype' => 'multipart/form-data', 'method' => 'POST')) !!}
         
          {{-- Contribution name and Section --}}
          <div class="row">
            <div class="col-sm-6">
              @include('templates.form-text', ['space' => 'registrations', 'tag' => 'name_contribution'])
            </div>
            <div class="col-sm-6">
              @include('templates.form-select', ['space' => 'registrations', 'tag' => 'section', 'list' => $listSectionStart])
            </div>
          </div>

          {{-- PhD (checkbox) --}}
          <div class="row">
            <div class="col-sm-12">
              {{ Form::checkbox('phd') }} {{  __('registrations.phd') }}  
            </div>
          </div>

          {{-- Authors --}}
          <div class="row justify-content-center bg-light text-dark">
            <h3>Autor</h3>

            <table class="table bordered-none" id="dynamicAddRemove">
              <tr>
                <td colspan="2">Tituly pred</td>
                <td>Meno</td>
                <td>Priezvisko</td>
                <td colspan="2">Tituly za</td>
              </tr>  
              <tr>  
                <td><select class="form-control" name="title1_id[]">
                  <option value="0"></option>
                  @foreach ($title1 as $item)
                  <option value="{{ $item->id }}">{{ $item->title }}</option>
                  @endforeach
                </select></td>
                <td><input type="text" name="title1[]" class="form-control" /></td>  
                <td><input type="text" name="name[]" class="form-control" /></td>  
                <td><input type="text" name="surname[]" class="form-control" /></td>  
                <td><select class="form-control" name="title2_id[]">
                  <option value="0"></option>
                  @foreach ($title2 as $item)
                  <option value="{{ $item->id }}">{{ $item->title }}</option>
                  @endforeach
                </select></td>
                <td><input type="text" name="title2[]" class="form-control" /></td>
                <td><input type="radio" name="presentation" value="0" checked /></td>
              </tr>
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
            <td><button type="button" class="btn btn-sm btn-danger remove-tr">x</button></td></tr> ');
      });
      $(document).on('click', '.remove-tr', function(){  
        $(this).parents('tr').remove();
      });  
    </script>
             

          {{-- Abstract --> insert pdf --}}
          <div class="row">
            <div class="col-sm-12">
                  <div class="form-group" id="upload-file">
                    Abstrakt: <input type="file" name="abstract_file" id="abstract_file">
                      @error('abstract_file')
                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                      @enderror
                  </div>
            </div>
          </div>
                      
          {{-- Personal info --}} 
          <div class="bg-light text-dark"> <hr>
            <div class="row justify-content-center">
              <h3>{{ __('registrations.personal') }}</h3>
            </div>

            {{-- IBAN --}}
            <div class="row">
              <div class="col-sm-12">
                @include('templates.form-text', ['space' => 'registrations', 'tag' => 'iban'])
              </div>
            </div>

            {{-- SWIFT --}}
            <div class="row">
              <div class="col-sm-12">
                @include('templates.form-text', ['space' => 'registrations', 'tag' => 'swift'])
              </div>
            </div>
            
            <hr></div> 

          {{-- Agree bank account --}}
          <div class="row">
            <div class="col-sm-12">
              {{ Form::checkbox('agree_bank_account') }} {{  __('registrations.agree_bank_account') }}
            </div>
          </div>          
          
          <div style="margin-top:20px;">
            <p>
              Pri organizácií na ŠVK je potrebné narábať s Vašimi osobnými údajmi, konkrétne:
              <ul>
                <li>Vaše meno a priezvisko,</li>
                <li>Škola, ktorú navštevujete,</li>
                <li>IBAN a SWIFT, aby sme Vám mohli zaslať finančnú odmenu v prípade výhry,</li>
                <li>Vaša eventuálna podobizeň, pretože na akciu bude prizvaný fotograf, a tak vzniknú fotky aj videozáznam z celej konferencie, ktoré poslúžia na propagačné účely.</li>
                <li>Vaša prezentácia, v prípade online formy konferencie.</li>
              </ul>
              V prípade, že sa chcete registrovať a zúčastniť konferencie, Vás preto prosíme o súhlas so spracovaním Vašich osobných údajov.
              Viac informácií o spracovaní osobných údajov nájdete na stránke <a href="https://www.stuba.sk/sk/pracoviska/centrum-vypoctovej-techniky/podmienky-ochrany-sukromia-na-stu.html?page_id=12121">Podmienky ochrany súkromia na STU</a>.
            </p>
          </div>

          {{-- Agree GDPR --}}
          <div class="row">
            <div class="col-sm-12">
              {{ Form::checkbox('agree_gdpr') }} {{  __('registrations.agree_gdpr') }}
            </div>
          </div>

          {{-- Agree citation --}}
          <div class="row">
            <div class="col-sm-12">
              {{ Form::checkbox('agree_citate') }} {{  __('registrations.agree_citation') }}
            </div>
          </div>

          {{-- Agree video --}}
          <div class="row">
            <div class="col-sm-12">
              {{ Form::checkbox('agree_video') }} {{  __('registrations.agree_video') }}
            </div>
          </div>

        </div>
        
        
        <div class="card-footer">
          {{ Form::submit(__('registrations.submit'), array('class' => 'btn btn-sm btn-primary')) }}
        </div>
            
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection
