{{-- @extends('layouts.app-coreui') --}}

<style>
    .review_notification {
        display: none;
        padding: 10pt;
        text-align: center;
        position: relative;
        padding: 70px 0px;
        font-size: 13pt;
        font-weight: bold;
    }
    .options {
        margin-left: 20pt;
    }
    #txt-mail {
        display: none;
        background: rgba(0, 136, 255, 0.165);
        margin-top: 20pt;
        padding: 20pt
    }
    #rn1 {
        background: rgba(255, 255, 0, 0.319);
    }
    #rn2 {
        background: rgba(0, 128, 0, 0.276);
    }
    #rn3 {
        background: rgba(255, 166, 0, 0.296);
    }
    #rn4 {
        background: rgba(255, 0, 0, 0.227);
    }
</style>

    {{-- Card with reviews --}}
<div class="card">

    <div class="card-header content-center">
        <h4><strong>{{__('registrations.review')}}</strong></h4>
    </div>
    
    <div class="card-body">
        
        {!! Form::model($registration, ['route' => ['registration.review', $registration->id], 'method' => 'PUT']) !!}

        <div class="row">
            <div class="col-sm-5 options">
                <label class="control-label" for="recenzia"><b>{{ __('registrations.review_status') }}:</b></label><br>
                <input type="radio" class="recenzia" name="recenzia" value="1" {{ ($registration->review=="1")? "checked" : "" }} id="r1" onchange="valueChanged()"> <label for="r1">{{ __('registrations.uncontrolled') }}</label><br>
                <input type="radio" class="recenzia" name="recenzia" value="2" {{ ($registration->review=="2")? "checked" : "" }} id="r2" onchange="valueChanged()"> <label for="r2">{{ __('registrations.review_ok') }}</label><br>
                <input type="radio" class="recenzia" name="recenzia" value="3" {{ ($registration->review=="3")? "checked" : "" }} id="r3" onchange="valueChanged()"> <label for="r3">{{ __('registrations.review_edit') }}</label><br>
                <input type="radio" class="recenzia" name="recenzia" value="4" {{ ($registration->review=="4")? "checked" : "" }} id="r4" onchange="valueChanged()"> <label for="r4">{{ __('registrations.review_nok') }}</label><br>
            </div>

            <div class="col-sm-6 review_notification" id="rn1">
                <p>{{ __('registrations.rn1') }}</p>
            </div>
            <div class="col-sm-6 review_notification" id="rn2">
                <p>{{ __('registrations.rn2') }}</p>
            </div>
            <div class="col-sm-6 review_notification" id="rn3">
                <p>{{ __('registrations.rn3') }}</p>
            </div>
            <div class="col-sm-6 review_notification" id="rn4">
                <p>{{ __('registrations.rn4') }}</p>
            </div>
        </div>

        <div class="row" id="txt-mail">
            <input type="hidden" name="reg_id" value="{{ $registration->id }}" />
            <p class="p-mail">Dobrý deň,</p>
            <textarea class="form-control" name="text_spravy" id="summernote" rows="10" placeholder="Sem vložte text emailu" style="margin-bottom:10pt"></textarea>
            <p class="p-mail">
                S pozdravom,<br>{{ $uname }} {{ $usurname }}<br><br>
                ===========================================<br><br>
                {{ __('review.rev_stop') }} 
                <div class="col-sm-3 mr-auto">
                    <input type="date" name="rev_stop" id="txtDate" class="form-control">
                </div>
            </p>
        </div>

    </div>
        
<script type="text/javascript">

    $('#summernote').summernote({
        placeholder: 'Vložte obsah stránky..',
        tabsize: 2,
        height: 400,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture']],
        ],
    });
    
    $(function(){
        var dtToday = new Date();
        
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();
        
        var maxDate = year + '-' + month + '-' + day;
        $('#txtDate').attr('min', maxDate);
    });

    valueChanged()
    function valueChanged()
    {
        if($('#r1').is(":checked"))   
            $("#rn1").show();
        else
            $("#rn1").hide();

        if($('#r2').is(":checked"))   
            $("#rn2").show();
        else
            $("#rn2").hide();

        if($('#r3').is(":checked"))   
            $("#rn3").show();
        else
            $("#rn3").hide();

        if($('#r3').is(":checked"))   
            $("#txt-mail").show();
        else
            $("#txt-mail").hide();

        if($('#r4').is(":checked"))   
            $("#rn4").show();
        else
            $("#rn4").hide();
    }
</script>

    <div class="card-footer content-center">
        {{ Form::submit(__('registrations.add_review'), array('class' => 'btn btn-sm btn-primary')) }}
    </div>
    
    {!! Form::close() !!}

</div>