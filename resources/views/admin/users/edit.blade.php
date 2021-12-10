@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Edit Profile : {{ $user->name }}

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
                        <form method="post" action="{{ route('admin.users.update', $user->id) }}">
                            @method('PATCH')
                            @csrf

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name"
                                       name="name"
                                       aria-describedby="nameHelp" value="{{ $user->name }}" />
                                <small id="nameHelp" class="form-text text-muted">
                                    Your full name
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input type="text" class="form-control" id="mobile"
                                       name="mobile"
                                       aria-describedby="mobileHelp" value="{{ $user->mobile }}">
                                <small id="mobileHelp" class="form-text text-muted">
                                    Your personal mobile number
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email"
                                       name="mobile"
                                       aria-describedby="emailHelp" value="{{ $user->email }}">
                                <small id="emailHelp" class="form-text text-muted">
                                    Your email
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password"
                                       name="password" aria-describedby="passwordHelp">
                                <small id="passwordHelp" class="form-text text-muted">
                                    Enter a password only if you prefer to change the existing
                                </small>
                            </div>

                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin" value="1"
                                {{ $user->is_admin ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_admin">Is Administrator</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
