@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Users') }}</div>                

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <main class="sm:container sm:mx-auto sm:max-w-lg sm:mt-10">
                        <div class="flex justify-center">
                            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">
                    
                                <div class="w-full p-6">
                                    <table class="table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>{{ __('Name')}}</th>
                                                <th>{{ __('Email')}}</th>         
                                            </tr>
                                        </thead>
                
                                        @foreach ($users as $emp)
                                        <tbody>
                                            <tr>
                                                <td class="border px-4 py-4">{{ $emp->name }}</td>
                                                <td class="border px-4 py-4">{{ $emp->email }}</td>
                                            </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            </section>
                        </div>
                    </main>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
