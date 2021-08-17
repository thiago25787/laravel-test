@extends('layouts.app')

@section('content')
    <form method="post" action="{{route("purchase.store", ['account' => $account->id])}}">
        @csrf
        <fieldset>
            <legend>{{ __('New purchase') }}</legend>
            <div class="form-group">
                <label for="amount">{{ __('Amount') }}</label>
                <input id="amount" class="form-control" type="number" step="0.01" name="amount" value="{{old("amount")}}" required autofocus />
            </div>
            <div class="form-group">
                <label for="description">{{ __('Description') }}</label>
                <input id="description" class="form-control" type="text" name="description" value="{{old("description")}}" required />
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
