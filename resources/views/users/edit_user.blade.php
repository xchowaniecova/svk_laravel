@extends('layouts.app-coreui') 

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header content-center"><h4><strong>Osobné údaje</strong></h4>
          <div class="card-header-actions">
          </div>
        </div>
        
        <div class="card-body">
          
            {!! Form::model($user, ['route' => ['users.update_user'], 'method' => 'PUT']) !!}

            @foreach ($user as $u)

            <input type="hidden" name="id" value="{{ $u->id }}" />
            {{-- Tituly --}}
            <div class="row mb-3">
                <label for="title1_id" class="col-md-4 col-form-label text-md-right">{{ __('Titul pred menom:') }}</label>
                <div class="col-md-2">
                    {{ Form::select('title1_id', $listTitles, $u->title1_id ?? '', ['class' => 'form-control']) }}
                </div>

                <label for="title2_id" class="col-md-2 col-form-label text-md-right">{{ __('Titul za menom:') }}</label>
                <div class="col-md-2">
                    {{ Form::select('title2_id', $listTitles2, $u->title2_id ?? '', ['class' => 'form-control']) }}
                </div>
            </div>

            {{-- Meno --}}
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Meno:') }}</label>
                <div class="col-md-6">
                    <input type="text" name="name" class="form-control" value="{{ $u->name }}" />
                </div>
            </div>

            {{-- Priezvisko --}}
            <div class="form-group row">
                <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Priezvisko:') }}</label>
                <div class="col-md-6">
                    <input type="text" name="surname" class="form-control" value="{{ $u->surname }}" />
                </div>
            </div>            

            {{-- Mail --}}
            <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email:') }}</label>
                <div class="col-md-6">
                    <input type="text" name="email" class="form-control" value="{{ $u->email }}" />
                </div>
            </div> 
            
            {{-- ID studenta --}}
            <div class="row mb-3">
                <label for="student_id" class="col-md-4 col-form-label text-md-right">{{ __('ID studenta:') }}</label>
                <div class="col-md-6">
                    <input type="text" name="student_id" class="form-control" value="{{ $u->student_id }}" />
                </div>
            </div> 

            {{-- Skola --}}
            @if ($u->faculty_id == null)
            <div class="row mb-3">
                <label for="faculty_id" class="col-md-4 col-form-label text-md-right">{{ __('Skola:') }}</label>
                <div class="col-md-6">
                    <select class="form-control" name="faculty_id">
                        <option value='{{ null }}'></option>
                        @foreach ($faculties as $item)
                        <option value="{{ $item->id }}">{{ $item->name }} [{{ $item->shortcut }}]</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group content-center">
                <input type="hidden" name="missing-fac" value="0">
                <input type="checkbox" name="missing-fac" id="missing-fac" onchange="valueChanged()" value="1" checked>
                &nbsp;<label class="form-check-label" for="missing-fac">{{ __('V zozname sa nenachádza moja fakulta') }}
            </div>                        
            <div id="fac-uni">
                <div class="form-group row">
                    <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Fakulta') }}</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="faculty" value="{{ $u->faculty }}">
                    </div>
                    </div>
                    <div class="form-group row">
                    <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Univerzita') }}</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="university" value="{{ $u->university }}">
                    </div>
                </div>
            </div>

            @else
            <div class="row mb-3">
                <label for="faculty_id" class="col-md-4 col-form-label text-md-right">{{ __('Skola:') }}</label>
                <div class="col-md-6">
                    {{ Form::select('faculty_id', $listSchools, $u->faculty_id ?? '', ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="form-group content-center">
                <input type="hidden" name="missing-fac" value="0">
                <input type="checkbox" name="missing-fac" id="missing-fac" onchange="valueChanged()" value="1">
                &nbsp;<label class="form-check-label" for="missing-fac">{{ __('V zozname sa nenachádza moja fakulta') }}
            </div>                      
            <div id="fac-uni" style="display: none">
                <div class="form-group row">
                    <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Fakulta') }}</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="faculty" value="{{ $u->faculty }}">
                    </div>
                    </div>
                    <div class="form-group row">
                    <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Univerzita') }}</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="university" value="{{ $u->university }}">
                    </div>
                </div>
            </div>
            @endif

            @endforeach
          
        </div>

        <script type="text/javascript">
            function valueChanged()
              {
                if($('#missing-fac').is(":checked"))   
                    $("#fac-uni").show();
                else
                    $("#fac-uni").hide();
              }
        </script>

        <div class="card-footer content-center">
            {{ Form::submit('Upraviť', array('class' => 'btn btn-sm btn-primary')) }}
        </div>          
        
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection
