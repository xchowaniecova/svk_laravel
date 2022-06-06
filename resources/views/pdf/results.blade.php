<html>
<head>
    <style>
        .title-page {
            text-align: center;
            margin: 10pt;
        }
        .h2 {
            text-align: center;
        }
        .tab {
            justify-content: center;
        }
        table, th, td {
            border: 1px solid;
            border-collapse: collapse;
            font-size: 11pt;
            margin-top: 20pt;
            margin-bottom: 100pt;
            text-align: center;
        }
        body { 
            font-family: DejaVu Sans; 
        }
        hr {
            border: 0;
            height: 1px;
            background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));
        }
    </style>

	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<body>


    <div class="title-page">
        <h3>Študentská vedecká konferencia pod názvom <br> „{{ $name }}“</h3><hr>
        <h1>Výsledky</h1>
    </div>

    {{-- Nova strana --}}
    <p style="page-break-after: always;">&nbsp;</p>

    @foreach ($section as $s)
    <h2 class="h2">{{ $s->fname }}</h2>
    <div class="tab">
    <table class="table table-striped mt-2 mb-2">
        <thead>
            <tr>
                <th>Por.</th>
                <th>Prezentujúci</th>
                <th>Názov príspevku</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($registration as $r)
            @if ($s->id == $r->id)
            @if ($r->placement > 0) 
            <tr>
                <td style="width: 5%">{{ $r->placement }}</td>
                <td style="width: 20%; white-space: nowrap;">{{ $r->surname }}</td>
                <td style="width: 75%">{{ $r->name_contribution }}</td>
            </tr>
            @endif
            @endif
            @endforeach
        </tbody>
    </table>
    </div>
    <p style="page-break-after: always;">&nbsp;</p>
    @endforeach    

</body>
</html>