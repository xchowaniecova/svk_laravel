@extends('layouts.app-coreui')

@section('content')

    <div class="card-box bg-blue">
        <div class="inner text-navbar">
            <h1>{{ $name }}</h1>
            <h5>
                Portál pre registráciu príspevkov a ubytovania na {{ $order }}. celoslovenskú študentskú vedeckú konferenciu s medzinárodnou účasťou. <br>
                Celoslovenská študentská vedecká konferencia s medzinárodnou účasťou.
            </h5>
        </div>
    </div>
    <div class="card-box1 bg-green">
        <div class="inner text-navbar">
            <h3>Otvorenie registrácie</h3>
            <h5>{{ $reg_start }}</h5>
        </div>
    </div>
    <div class="card-box1 bg-yellow">
        <div class="inner text-navbar">
            <h3>Ukončenie registrácie</h3>
            <h5>{{ $reg_end }}</h5>
        </div>
    </div>
@endsection
