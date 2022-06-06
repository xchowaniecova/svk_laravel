<form action="{{ route('results.store') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="ModalResult_{{$s->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 1500px"  role="document">
            <div class="modal-content">
               
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('results.title') }} pre <b>{{ $s->fname }}</b></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>

                <div class="modal-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Por.</th>
                                <th>Prezentujuci</th>
                                <th>Nazov prispevku</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($registration as $r)
                            @if ($s->id == $r->id)
                            @if ($r->phd == 0) 
                            <tr>
                                <td>{{ $r->placement }}</td>
                                <td>{{ $r->surname }}</td>
                                <td>{{ $r->name_contribution }}</td>
                            </tr>
                            @endif
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>   
                                           
                <div class="modal-footer">
                    <div class="col-xs-12 col-sm-12 col-md-12 content-center">
                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">{{ __('Back') }}</button>
                        &nbsp;
                        <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>
