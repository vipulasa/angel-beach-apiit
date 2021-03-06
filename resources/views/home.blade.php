@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <ul>
                        @foreach(['breakfast', 'tea', 'test', 'dinner', 'lunch'] as $menus)
                            <li>
                                <a href="{{ route('menu', [$menus]) }}">
                                    View {{ $menus }} menu
                                </a>
                            </li>
                        @endforeach
                    </ul>


                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
