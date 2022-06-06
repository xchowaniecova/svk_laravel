@extends('layouts.app-coreui') 

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">

        <div class="card-header content-center"><h4><strong>{{__('section_finals.title')}}</strong></h4></div>
        
        <div class="card-body">
          <div class="row">

            <ul style="list-style-type:none">
              @foreach ($section as $s)
                <li>
                  @if ($s[1] == null)
                    <a style="font-size: 15pt; color: #2589cb">{{ $s[0]->fname }} ({{ $s[1] }})</a><br>
                  @else
                    <a href="#" style="font-size: 15pt" data-toggle="modal" data-target="#ModalViewFinal_{{$s[0]->id}}">{{ $s[0]->fname }} ({{ $s[1] }})</a><br>
                  @endif                   
                </li>
                @include('section_final.modal.view_final')
              @endforeach
            </ul>  
          </div>
        </div>

        <script type="text/javascript"> 
          $(function() {

            
              $('.detail').click(function() {

                hrefId = $(this).data('href');

                $('.detail_box').slideUp();
                
                if($(hrefId).is(':visible')){
                  $(hrefId).slideUp();
                }else{
                  $('.detail_box').show();
                    $(hrefId).slideDown();
                }  
              });        
          });
       </script>

      </div>
    </div>
  </div>
</div>
@endsection
