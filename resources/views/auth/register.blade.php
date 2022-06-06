@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registrácia') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- Titul 1 --}} 
                        <div class="row mb-3">
                            <label for="title1_id" class="col-md-4 col-form-label text-md-right">{{ __('Titul pred menom') }}</label>

                            <div class="col-md-6">
                                {{Form::select('title1_id', $listTitles, null, array('class' => 'form-control'))}}
                            </div>
                        </div>

                        {{-- Meno --}}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Meno') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Priezvisko --}}
                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Priezvisko') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>

                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Titul 2 --}} 
                        <div class="row mb-3">
                            <label for="title2_id" class="col-md-4 col-form-label text-md-right">{{ __('Titul za menom') }}</label>

                            <div class="col-md-6">
                                {{Form::select('title2_id', $listTitles2, null, array('class' => 'form-control'))}}
                            </div>
                        </div>

                        {{-- Mail --}}
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mailová adresa') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Heslo --}}
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Heslo') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Potvrdenie hesla --}}
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Zopakuj helo') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <hr>

                        {{-- Studentovo ID --}}
                        <div class="form-group row">
                            <label for="student_id" class="col-md-4 col-form-label text-md-right">{{ __('ID študent') }}</label>

                            <div class="col-md-6">
                                <input id="student_id" type="text" class="form-control @error('student_id') is-invalid @enderror" name="student_id" value="{{ old('student_id') }}" required autocomplete="student_id" autofocus>

                                @error('student_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Fakulta dropdown --}} 
                        <div class="row mb-3">
                            <label for="faculty_id" class="col-md-4 col-form-label text-md-right">{{ __('Škola') }}</label>
                            <div class="col-md-6">
                              <select class="form-control" name="faculty_id">
                                <option value='{{ null }}'></option>
                                @foreach ($faculties as $item)
                                  <option value="{{ $item->id }}">{{ $item->name }} [{{ $item->shortcut }}]</option>
                                @endforeach
                              </select>
                            </div>
                        </div>

                        <div class="form-group" style="padding-left:190pt">
                          {{-- <button class="btn btn-link col-md-6" id="missing-fac" onchange="valueChanged()">{{ __('V zozname sa nenachádza moja fakulta') }}</button> --}}
                          <input type="checkbox" name="missing-fac" id="missing-fac" onchange="valueChanged()">
                          <label class="form-check-label" for="missing-fac">{{ __('V zozname sa nenachádza moja fakulta') }}
                        </div>

                        {{-- New University Faculty --}}
                        <div id="fac-uni" style="display:none">
                          <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Fakulta') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="faculty">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Univerzita') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="university">
                            </div>
                          </div>
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

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
