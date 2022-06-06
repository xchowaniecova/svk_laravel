<html>
<head>
    <style>
        .card-header {
            text-align: center;
            margin: 10pt;
        }
        .card-body {
            text-align: center;
            height: 300pt;
        }
        .card-footer {
            text-align: right;
            height: 20pt;
        }
        .section {
            text-align: left;
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

  <div class="card">

    <div class="card-header">
        <h3>Študentská vedecká konferencia pod názvom „{{ $name }}“</h3><hr>
    </div>

    <div class="card-body">
        <div class="section">
            <strong>Hodnotiaci harok</strong><br>
            Sekcia:<br>
            Clen komisie:
        </div>
        <table class="table" >
            <thead>
                <tr>
                    <th></th>
                    <th>Meno studenta</th>
                    <th>Forma prezentacie</th>
                    <th>Prednes</th>
                    <th>Obhajoba v diskusii</th>
                    <th>Teoreticka uroven</th>
                    <th>Experimentalna uroven</th>
                    <th style="width: 50pt"></th>
                    <th style="width: 50pt"></th>
                    <th>Pocet bodov</th>
                    <th>Poradie</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($i as $i)
                <tr>
                    <td>{{ $i }}.</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr> 
                @endforeach
                
               
            </tbody>
        </table>
    </div>

    <div class="card-footer">
        .............................<br>podpis    
    </div>
    
  </div>

</body>
</html>