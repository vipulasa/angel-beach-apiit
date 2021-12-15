@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Create new user

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
                        <form method="post" action="{{ route('admin.users.store') }}">
                            @csrf

                            {{--                            @if($errors)--}}
                            {{--                                @foreach($errors->all() as $error)--}}
                            {{--                                    <div class="alert alert-danger">{{ $error }}</div>--}}
                            {{--                                @endforeach--}}
                            {{--                            @endif--}}

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                       name="name"
                                       aria-describedby="nameHelp"
                                       value="{{ old('name') }}"/>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small id="nameHelp" class="form-text text-muted">
                                    Your full name
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input type="text" class="form-control @error('mobile') is-invalid @enderror"
                                       id="mobile"
                                       name="mobile"
                                       aria-describedby="mobileHelp"
                                       value="{{ old('mobile') }}">

                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small id="mobileHelp" class="form-text text-muted">
                                    Your personal mobile number
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                       name="email"
                                       aria-describedby="emailHelp"
                                       value="{{ old('email') }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small id="emailHelp" class="form-text text-muted">
                                    Your email
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                                       name="password" aria-describedby="passwordHelp">
                                <small id="passwordHelp" class="form-text text-muted">
                                    Enter a password only if you prefer to change the existing
                                </small>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin" value="1"
                                    {{ old('is_admin') ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="is_admin">Is Administrator</label>
                            </div>

                            <hr/>
                            <h5>Address</h5>

                            <div class="form-group">
                                <label for="street">Street</label>
                                <textarea class="form-control @error('street') is-invalid @enderror" id="street"
                                          name="street" aria-describedby="streetHelp">{{ old('street') }}</textarea>
                                @error('street')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" id="city"
                                       value="{{ old('city') }}"
                                       name="city"/>
                                @error('city')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="province">Province</label>
                                <input type="text" class="form-control @error('province') is-invalid @enderror" id="province"
                                       value="{{ old('province') }}"
                                       name="province"/>
                                @error('province')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="postal_code">Postal Code</label>
                                <input type="text" class="form-control @error('postal_code') is-invalid @enderror" id="postal_code"
                                       value="{{ old('postal_code') }}"
                                       name="postal_code"/>
                                @error('postal_code')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <hr />
                            <h5>Roles</h5>
                            @foreach($roles as $role)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="role_{{ $role->id }}"
                                           name="roles[]" value="{{ $role->id }}"
                                        {{ old('roles') && in_array($role->id, old('roles')) ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="role_{{ $role->id }}">{{ $role->name }}</label>
                                </div>
                            @endforeach

                            <button type="submit" class="btn btn-primary mt-4">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
