@extends('emails.layout')

@section('content')
<span class="preheader">
  Email Preview
</span>
<table role="presentation" cellpadding="0" cellspacing="0" class="body">
  <tr>
    <td>&nbsp;</td>
    <td class="container">
      <div class="content">
        
        <!-- START CENTERED WHITE CONTAINER -->
        <table role="presentation" class="main">
          
          <!-- START MAIN CONTENT AREA -->
          <tr>
            <td class="wrapper">
              <table role="presentation" cellpadding="0" cellspacing="0">
                <tr>
                  <td>
                    <p>Dobrý deň {{$data['aname']}}, </p>
                      <p>
                        @if($data['review'] == 2)
                            Váš príspevok na ŠVK bol schválený.
                        @elseif ($data['review'] == 3)
                            {!! $data['text'] !!}
                            Údaje o príspevku je možné upraviť do {{ $data['rev_stop'] }}.
                        @else
                            Mrzí nás, ale Váš príspevok na ŠVK nebol schválený.
                        @endif
                      </p>
                      <p>S pozdravom</p>
                      <p>{{ $data['uname'] }} {{ $data['usurname'] }}</p>
                    </td>
                  </tr>
              </table>
            </td>
          </tr>
          
          <!-- END MAIN CONTENT AREA -->
        </table>
        <!-- END CENTERED WHITE CONTAINER -->
        
        <!-- START FOOTER -->
        <div class="footer">
          <table role="presentation" cellpadding="0" cellspacing="0">
            <tr>
              <td class="content-block">
                <span class="apple-link">ŠVK</span>
              </td>
            </tr>
            <tr>
              <td class="content-block powered-by">
                Powered by <a href="http://uiam.sk">Študentská Vedecká Konferencia FCHPT</a>.
              </td>
            </tr>
          </table>
        </div>
        <!-- END FOOTER -->
        
      </div>
    </td>
    <td>&nbsp;</td>
  </tr>
</table>
@endsection