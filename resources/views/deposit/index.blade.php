@extends('layouts.app')

@section('content')
    <h2>
        {{__("Deposits")}}
    </h2>
    <div>
        <div class="text-right mb-3">
            <a class="btn btn-primary" href="{{route('deposit.create')}}">
                {{__("New deposit")}}
            </a>
        </div>
        @if($deposits && $deposits->count() > 0)
            <div>
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{_("Amount")}}</th>
                            <th>{{__("Date")}}</th>
                            <th>{{__("Approved?")}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($deposits as $deposit)
                        <tr>
                            <td>{{ $deposit->amount }}</td>
                            <td>{{ $deposit->created_at }}</td>
                            <td>{{ $deposit->status }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $deposits->links() }}
            </div>
        @else
            <section class="alert alert-warning text-center">
                {{ __('No itens found') }}
            </section>
        @endif
    </div>
@endsection
