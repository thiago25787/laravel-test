@extends('layouts.app')

@section('content')
    <h2>
        {{__("Purchases")}}
    </h2>
    <div>
        <div class="text-right mb-3">
            <a class="btn btn-primary" href="{{route("purchase.create")}}">
            {{__("New purchase")}}
            </a>
        </div>
        @if($purchases && $purchases->count() > 0)
            <div>
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>{{_("Description")}}</th>
                            <th>{{__("Amount")}}</th>
                            <th>{{__("Date")}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($purchases as $purchase)
                            <tr>
                                <td>{{ $purchase->description }}</td>
                                <td>{{ $purchase->amount }}</td>
                                <td>{{ $purchase->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $purchases->links() }}
            </div>
        @else
            <section class="alert alert-warning text-center">
                {{ __('No itens found') }}
            </section>
        @endif
    </div>
@endsection
