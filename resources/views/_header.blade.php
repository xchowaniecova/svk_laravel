<nav class="navbar navbar-expand-md navbar-light bg-navbar shadow-sm">
  <div class="container">
   

      <a class="navbar-brand text-white c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
        <i class="fas fa-bars"></i>
      </a>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">

              @auth

                @can('user_access')             
                @php
                $user_id = Auth::user()->id;
                $paper = App\Models\Registration::where('user_id', $user_id)->first();
                $paper_id = isset($paper) ? $paper->id : 0;
                $accommodation = App\Models\Accommodation::where('user_id', $user_id)->first();
                $accommodation_id = isset($accommodation) ? $accommodation->id : 0;
                @endphp

                @if($paper_id && Auth::user()->role == 3)
                <li>
                    <a class="nav-link text-white" href="{{route('registration.edit', $paper_id)}}">{{ __('header.reg_edit_single') }}</a>
                </li>                
                @elseif(Auth::user()->role == 3)
                <li>
                    <a class="nav-link text-white" href="{{route('registration.create')}}">{{ __('header.reg') }}</a>
                </li>
                @endif
                @if($accommodation_id && Auth::user()->role == 3)
                <li>
                    <a class="nav-link text-white" href="{{route('accommodation.edit', $accommodation_id)}}">{{ __('header.acc_edit_single') }}</a>
                </li>
                @elseif(Auth::user()->role == 3)
                <li>
                    <a class="nav-link text-white" href="{{route('accommodation.create')}}">{{ __('header.acc') }}</a>
                </li>
                @endif
                @endcan

                {{-- Editor --}}
                @can('editor_access')
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ __('header.editor') }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <small class="row justify-content-center">Prva fáza</small>
                        @can('registration_edit')
                            <a class="dropdown-item text-navbar" href="{{route('registration.indexEdit')}}"><i class="fa fa-edit"></i> {{ __('header.reg_edit') }} </a>   
                        @endcan  
                        @can('registration_index')
                            <a class="dropdown-item text-navbar" href="{{route('registration.index')}}"><i class="fa fa-bars"></i> {{ __('header.registration') }} </a> 
                        @endcan                       
                        <hr>

                        <small class="row justify-content-center">Druha fáza</small>
                        @can('section_classification')
                             <a class="dropdown-item text-navbar" href="{{route('section_final.classification')}}"><i class="fa fa-edit"></i> {{ __('header.classification') }} </a>
                        @endcan
                        @can('section_index')
                            <a class="dropdown-item text-navbar" href="{{route('section_final.indexEditor')}}"><i class="fa fa-bars"></i>  {{ __('header.fsection') }} </a>
                        @endcan
                        @can('program_create')
                            <a class="dropdown-item text-navbar" href="{{route('program.create')}}"><i class="fa fa-edit"></i> {{ __('header.program') }} </a>
                        @endcan
                        <a class="dropdown-item text-navbar" href="{{route('doc.index')}}"><i class="fa fa-bars"></i> Prezenčné listiny a protokoly</a>
                        <hr>

                        <small class="row justify-content-center">Finálna fáza</small>
                        @can('program_index')
                            <a class="dropdown-item text-navbar" href="{{route('program.index')}}"><i class="fa fa-bars text-success"></i> {{ __('header.fprogram') }} </a>
                        @endcan
                        @can('results_edit')
                            <a class="dropdown-item text-navbar" href="{{route('results.create')}}"><i class="fa fa-edit"></i> {{ __('header.results') }} </a>
                        @endcan
                        <hr>

                        <small class="row justify-content-center">PDF na stiahnutie</small>
                        <a class="dropdown-item text-navbar" href="https://www.uiam.sk/~oravec/svk/editor/svk_instrukcie.pdf" target="_blank"><i class="fa fa-file-pdf"></i> Inštrukcie k ŠVK</a>
                        <a class="dropdown-item text-navbar" href="{{route('evaluation.simplePDF')}}" target="_blank"><i class="fa fa-file-pdf"></i> Hodnotiaci hárok</a>
                        <hr>

                        @can('user_index')
                            <a class="dropdown-item text-navbar" href="{{route('users.index')}}"><i class="fa fa-bars"></i> {{ __('header.users') }} </a> 
                            <a class="dropdown-item text-navbar" href="{{ route('download.doc_editor') }}" target="_blank"><i class="fa fa-file-pdf"></i> Dokumentácia Editor</a>   
                        @endcan

                    </div>
                </li>
                @endcan
                
                {{-- Admin --}}
                @can('admin_access')
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ __('header.admin') }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item text-navbar" href="{{route('section_start.index')}}"><i class="fa fa-edit"></i> {{ __('header.ssection') }} </a>
                        <a class="dropdown-item text-navbar" href="{{route('section_final.index')}}"><i class="fa fa-edit"></i> {{ __('header.cfsection') }} </a>
                        <a class="dropdown-item text-navbar" href="{{route('conference.index')}}"><i class="fa fa-edit"></i> {{ __('header.conferencies') }} </a>
                        @can('faculty_access')
                        <a class="dropdown-item text-navbar" href="{{route('faculties.index')}}"><i class="fa fa-edit"></i> {{ __('header.faculties') }} </a>
                        <a class="dropdown-item text-navbar" href="{{route('universities.index')}}"><i class="fa fa-edit"></i> {{ __('header.universities') }} </a>
                        @endcan
                        <hr>

                        <a class="dropdown-item text-navbar" href="{{ route('results.report.simplePDF') }}" target="_blank"><i class="fa fa-file-pdf"></i> Prezentácia - výsledky [PDF]</a>
                        <hr>

                        <small class="row justify-content-center">Exporty XLS</small>
                        <a class="dropdown-item text-navbar" href="{{ route('users.export') }}"><i class="fa fa-file-excel"></i> Zoznam editorov/adminov</a>
                        <a class="dropdown-item text-navbar" href="{{ route('admins.export') }}"><i class="fa fa-file-excel"></i> Zoznam správcov</a>
                        <a class="dropdown-item text-navbar" href="{{ route('presenters.export') }}"><i class="fa fa-file-excel"></i> Zoznam prezentujúcich</a>
                        <a class="dropdown-item text-navbar" href="{{ route('rooms.export') }}"><i class="fa fa-file-excel"></i> Export rokovacích miestností</a>
                        <a class="dropdown-item text-navbar" href="{{ route('banks.export') }}"><i class="fa fa-file-excel"></i> Export IBAN</a>
                        <a class="dropdown-item text-navbar" href="{{ route('statistics.export') }}"><i class="fa fa-file-excel"></i> Export štatistiky</a>
                        <hr>

                        <a class="dropdown-item text-navbar" href="{{ route('users.emails') }}"><i class="fa fa-bars"></i> Zoznam emailov</a>
                        <a class="dropdown-item text-navbar" href="{{ route('download.doc_admin') }}" target="_blank"><i class="fa fa-file-pdf"></i> Dokumentácia Admin</a>
                        
                    </div>
                </li>  
                
                {{-- CMS --}}
                <li>
                    <a class="nav-link text-white" href="{{route('cms-pages.index')}}">{{ __('header.cms') }}</a>
                </li> 
                @endcan   
              @endauth                       
          </ul>



          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
              <!-- Authentication Links -->
              @guest
                  @if (Route::has('login'))
                      <li class="nav-item">
                          <a class="nav-link text-white" href="{{ route('login') }}">{{ __('header.login') }}</a>
                      </li>
                  @endif

                  @if (Route::has('register'))
                      <li class="nav-item">
                          <a class="nav-link text-white" href="{{ route('register') }}">{{ __('header.register') }}</a>
                      </li>
                  @endif
              @else
                  <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          {{ Auth::user()->name }}
                      </a>

                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item text-navbar" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('header.logout') }}
                        </a>

                        {{-- Odhlasenie --}}
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        {{-- Zmena hesla --}}
                        <a class="dropdown-item text-navbar" href="{{route('change-password')}}">Zmena hesla</a>
                        {{-- Osobne udaje --}}
                        <a class="dropdown-item text-navbar" href="{{route('users.edit_user')}}">Osobné údaje</a>
                      </div>
                  </li>
              @endguest
          </ul>
      </div>
  </div>
</nav>