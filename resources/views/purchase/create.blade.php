@extends('layouts.app')

@section('content')
    <form method="post" action="{{route("purchase.store", ['account' => $account->id])}}">
        @csrf
        <fieldset>
            <legend>{{ __('New purchase') }}</legend>
            <div class="form-group">
                <label for="amount">{{ __('Amount') }}</label>
                <input id="amount" class="form-control @error('amount') is-invalid @enderror" type="number" step="0.01" name="amount" value="{{old("amount")}}" required autofocus />
                @error('amount')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">{{ __('Description') }}</label>
                <input id="description" class="form-control @error('description') is-invalid @enderror" type="text" name="description" value="{{old("description")}}" required />
                @error('description')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">
                {{ __('Add') }}
            </button>
            <a class="btn btn-danger" href="{{route("purchase")}}">
                {{ __('Cancel') }}
            </a>
        </fieldset>
    </form>
@endsection
