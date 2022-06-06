<div class="modal fade text-left" id="ModalProgram_{{$s->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 1500px"  role="document">
        <div class="modal-content">
            
            <div class="modal-header">
                <h4 class="modal-title">{{ __('program.program') }} pre <b>{{ $s->name }}</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>                    
            </div>

            <div class="modal-body">

                {{-- Tabulka s prispevkami --}}
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Por.</th>
                            <th>Čas</th>
                            <th>Prezentujúci</th>
                            <th>Názov príspevku</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($registration as $r)
                        @if ($s->id == $r->id)
                        <tr>
                            <td>{{ $r->order }}</td>
                            <td></td>
                            <td>{{ $r->surname }}{{ ($r->phd == 1) ? '* ' : ''}}</td>
                            <td>{{ $r->name_contribution }}</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>   
                                        
            <div class="modal-footer">
                <label class="mr-auto"><i>* Doktorandský príspevok (nesúťažný)</i></label>
            </div>
        </div>
    </div>
</div>