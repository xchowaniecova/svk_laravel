@extends('layouts.app-coreui') 

@section('content')
<div class="container">
<div class="card">
    <div class="card-header content-center">
        <h2 class="mt-2"><strong>{{ $title }}</strong></h2>
    </div>
    <div class="card-body">
        <div class="text-justify">
            {!! $content1 !!}
        </div>
    </div>
</div>
</div>
@endsection