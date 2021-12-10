@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Profile : {{ $user->name }}

                        <a href="{{ route('admin.users.index') }}" class="text-decoration-none float-right">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"></path>
                            </svg>
                            Back to list
                        </a>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="py-2">
                                <strong class="mr-4">Name:</strong> {{ $user->name }}
                            </li>
                            <li class="py-2">
                                <strong class="mr-4">Email:</strong> {{ $user->email }}
                            </li>
                            <li class="py-2">
                                <strong class="mr-4">Mobile:</strong> {{ $user->mobile }}
                            </li>
                            <li class="py-2">
                                <strong class="mr-4">Created At:</strong> {{ $user->created_at }}
                            </li>
                        </ul>

                        @can('access-administration')
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                               class="btn btn-primary">{{ __('Edit') }}</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
