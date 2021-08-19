@extends('layouts.app')

@section('content')
    <form method="post" action="{{route("user.store")}}">
        @csrf
        <fieldset>
            <legend>{{ __('Profile') }}</legend>
            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <input id="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{old("name", $user->name)}}" required autofocus />
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">{{ __('Email') }}</label>
                <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{old("email", $user->email)}}" required />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="current_password">{{ __('Current password') }}</label>
                <input id="current_password" class="form-control @error('current_password') is-invalid @enderror" type="password" name="current_password" />
                @error('current_password')
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div>
            <div class="col-12 alert alert-warning text-center">{{__("Fill the fields below only if you want to change your password")}}</div>
            <div class="row form-group">
                <div class="col-6">
                    <label for="new_password">{{ __('New password') }}</label>
                    <input id="new_password" class="form-control @error('new_password') is-invalid @enderror" type="password" name="new_password" />
                    @error('new_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="confirm_password">{{ __('Confirm password') }}</label>
                    <input id="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" type="password" name="confirm_password"  />
                    @error('confirm_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                {{ __('Update') }}
            </button>
        </fieldset>
    </form>
@endsection
