<div class="c-sidebar-brand d-lg-down-none bg-navbar">
  <a class="c-sidebar-nav-link" href="/">Študentská vedecká konferencia</a>
</div>

<ul class="c-sidebar-nav ps bg-navbar">

  @php
  use App\Models\CmsPage;
  $pages = CmsPage::where('status',1)->orderBy('order')->get();
  @endphp

  @foreach ($pages as $p)
  <li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link" href="/{{ $p->slug }}">
      {{ $p->title_nav }}
    </a>
  </li>
  @endforeach

  <li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link" href="{{ route('download.doc_student') }}" target="_blank">
      Dokumentácia pre študenta&nbsp;&nbsp;<i class="fa fa-file-pdf"></i>
    </a>
  </li>
  
  <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;">
    </div>
  </div>
  <div class="ps__rail-y" style="top: 0px; right: 0px;">
    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;">
    </div>
  </div>
  
</ul>

</div>