<form action="" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="ModalViewFinal_{{$s[0]->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 1500px"  role="document">
            <div class="modal-content">
               
                <div class="modal-header">
                    <div class="modal-title"><h4>{{ __('section_finals.fname') }}: <strong>{{ $s[0]->fname }} ({{ $s[1] }})</strong></h4></div>
                </div>
               
                <div class="modal-body">
                    @if ($s[1] == 0)
                    @else
                        @foreach ($registration as $r)
                        @if ($s[0]->id == $r->id)
                        <div class="pointer" style="margin-bottom:20pt; margin-top:20pt">
                            <div class="col-sm-12">                                
                                <h5>[{{ $r->reg_id }}] <strong>{{ $r->name_contribution }}</strong></h5>
                                {{ $r->surname }}<br>
                                <a href="mailto:{{ $r->email }}">{{ $r->email }}</a><br>
                                @if($r->faculty == NULL)
                                    {{-- <strong>{{ $r->umi }}</strong> - {{ $r->fac }} --}}
                                @else
                                    <strong>{{ $r->university }}</strong> - {{ $r->faculty }}
                                @endif
                            </div>  
                        </div>
                        @endif
                        @endforeach
                    @endif
                </div> 
                
                <div class="modal-footer">
                    <div class="col-xs-12 col-sm-12 col-md-12 content-center">
                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">{{ __('Späť') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>