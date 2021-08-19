@extends('layouts.app')

@section('content')
    <form method="post" action="{{route("deposit.store", ['account' => $account->id])}}" enctype="multipart/form-data">
        @csrf
        <fieldset>
            <legend>{{ __('New deposit') }}</legend>
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
                <label for="image">{{ __('Image') }}</label>
                <input id="image" class="form-control form-control-file @error('image') is-invalid @enderror" type="file" name="image" required />
                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">
                {{ __('Add') }}
            </button>
            <a class="btn btn-danger" href="{{route("deposit")}}">
                {{ __('Cancel') }}
            </a>
        </fieldset>
    </form>
@endsection
