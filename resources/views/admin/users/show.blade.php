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

                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif

                        @can('access-administration')
                            <div>
                                <form method="post" action="{{ route('admin.users.destroy', $user->id) }}"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger float-right btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                             fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd"
                                                  d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @endcan

                        <h5>Profile</h5>

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
                                <strong class="mr-4">Administrator:</strong> {{ $user->is_admin ? 'Yes' : 'No' }}
                            </li>
                            <li class="py-2">
                                <strong class="mr-4">Created At:</strong> {{ $user->created_at }}
                            </li>
                        </ul>

                        <h5 class="mt-4">Address</h5>
                        <ul class="list-unstyled">
                            <li class="py-2">
                                <strong class="mr-4">Street:</strong> {{ $user->address->street }}
                            </li>
                            <li class="py-2">
                                <strong class="mr-4">City:</strong> {{ $user->address->city }}
                            </li>
                            <li class="py-2">
                                <strong class="mr-4">Province:</strong> {{ $user->address->province }}
                            </li>
                            <li class="py-2">
                                <strong class="mr-4">Postal Code:</strong> {{ $user->address->postal_code }}
                            </li>
                        </ul>

                        <h5>Roles</h5>
                        @if($user->roles && $user->roles->count())
                            <ul class="list-unstyled">
                                @foreach($user->roles as $role)
                                    <li class="py-2">
                                        <strong class="mr-4">{{ $role->name }}</strong>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <small>No roles allocated to this user</small>
                        @endif

                        @can('access-administration')
                            <div class="mt-4">
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                   class="btn btn-primary">{{ __('Edit') }}</a>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
